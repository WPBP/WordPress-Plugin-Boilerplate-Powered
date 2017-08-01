#!/bin/bash
set -e

echo "WP Boilerplate Version Changer 1.1.1 by Mte90 & deshack"

if [ "$1" == "-h" ] || [ $# -eq 0 ]; then
	echo "Change the version in a wordpress plugin (plugin-name.php and README.txt), tested on WP Boilerplate and derivates"
	echo "by Mte90 - http://www.mte90.net"
	echo "Usage: [version]"
	echo "-h: this help"
	exit 0
fi

cd `pwd`

if [ -f 'README.txt' ]; then
	LINE=`sed -n '/Stable tag: /{=}' README.txt`
	sed -i "${LINE}s/.*/Stable tag: ${1}/" README.txt
else
	echo "Missing README.txt"
fi

if [ -f 'plugin-name.php' ]; then
	LINE=`sed -n '/PN_VERSION/{=}' plugin-name.php`
	sed -i "${LINE}s/.*/define( 'PN_VERSION', '${1}' );/" plugin-name.php
	LINE=`sed -n '/ * Version:/{=}' plugin-name.php`
	sed -i "${LINE}s/.*/ * Version:           ${1}/" plugin-name.php
else
	echo "Missing plugin-name.php"
fi

echo "Done! YOORAH!"
