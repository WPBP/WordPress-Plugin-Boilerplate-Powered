#!/bin/bash
set -e

if [ -d "./docs" ]; then
	rm -r ./docs
fi

apigen --source plugin-name/ --exclude=*CMB*,*WP-Admin-Notice*,*WP-Contextual-Help*,*CPT_Core*,*Taxonomy_Core*,*Widget-Boilerplate* --destination docs --title "Wordpress Plugin Boilerplate Powered"
