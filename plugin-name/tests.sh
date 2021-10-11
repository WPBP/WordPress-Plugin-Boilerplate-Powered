#!/bin/sh

if ! lsof -Pi :4444 -sTCP:LISTEN -t >/dev/null; then
	echo " - Run Selenium"
	java -jar -Dwebdriver.chrome.driver=/opt/selenium/chromedriver /opt/selenium/selenium-server.jar 2> /dev/null &
fi

echo " - Run Codeception"

./tests/custom.sh

codecept run "$1"
