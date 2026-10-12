#!/usr/bin/env bash
# wp-browser 4 connects to MySQL through PDO, but the official wordpress images
# used by wp-env ship mysqli only. Install pdo_mysql into the tests-cli container
# after every wp-env start (containers are ephemeral, so this reruns each time).
# Pattern borrowed from wp-graphql's setup-wp-env.sh.

CONTAINER_ID="$(docker ps | grep tests-cli | awk '{print $1}')"
if [ -z "$CONTAINER_ID" ]; then
	echo "install-pdo-mysql: tests-cli container not found, skipping" >&2
	exit 0
fi

if docker exec -u root "$CONTAINER_ID" php -m | grep -q pdo_mysql; then
	echo "install-pdo-mysql: already installed"
	exit 0
fi

if ! docker exec -u root "$CONTAINER_ID" docker-php-ext-install pdo_mysql > /dev/null 2>&1; then
	echo "install-pdo-mysql: installation failed (wp-unit tests will fail on DB connect)" >&2
	exit 0
fi

if docker exec -u root "$CONTAINER_ID" php -m | grep -q pdo_mysql; then
	echo "install-pdo-mysql: installed"
else
	echo "install-pdo-mysql: installed but not loaded" >&2
fi
