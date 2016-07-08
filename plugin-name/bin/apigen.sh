#!/bin/bash
set -e

slug="plugin-name"

if [ -d "./docs" ]; then
	rm -r ../docs
fi

apigen generate --source=$slug/ --exclude=public/includes/lib,admin/includes/lib,includes/lib,/vendor --destination=docs --title="Wordpress Plugin Boilerplate Powered"

echo "#menu > span:first-child, #menu > a:first-child span {background: url('../../$slug/assets/icon-256x256.png');content: '';height: 256px;width: 240px;display:block;margin: 0 auto;}" >> ./docs/resources/style.css
echo "#menu > span:first-child, #menu > a:first-child, #menu > a:first-child:hover {background-color:transparent;color: transparent;}" >> ./docs/resources/style.css
