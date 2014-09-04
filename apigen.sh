#!/bin/bash
set -e

slug="plugin-name"

if [ -d "./docs" ]; then
	rm -r ./docs
fi

apigen --source $slug/ --exclude=*CMB*,*WP-Admin-Notice*,*WP-Contextual-Help*,*CPT_Core*,*Taxonomy_Core*,*Widget-Boilerplate* --destination docs --title "Wordpress Plugin Boilerplate Powered"

echo "#menu > span:first-child, #menu > a:first-child span {background: url('../../$slug/assets/icon-128x128.png');content: "";height: 128px;width: 128px;display:block;}" >> ./docs/resources/style.css
echo "#menu > span:first-child, #menu > a:first-child, #menu > a:first-child:hover {background-color:transparent;color: transparent;}" >> ./docs/resources/style.css