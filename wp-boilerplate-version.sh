#!/bin/bash
set -e

echo "WP Boilerplate Version Changer 1.0 by Mte90"

if [ "$1" == "-h" ] || [ $# -eq 0 ]; then
	echo "Change the version in a wordpress plugin (plugin.php, public class and README.txt), tested on WP Boilerplate and derivates"
	echo "by Mte90 - http://www.mte90.net"
	echo "Usage: [path] [version]"
	echo "-h: this help"
	exit 0
fi
slug=`basename $1`

LINE=`sed -n '/Stable tag: /{=}' README.txt`
sed -i "${LINE}s/.*/Stable tag: ${2}/" README.txt

LINE=`sed -n '/    const VERSION = /{=}' public/class-${slug}.php`
sed -i "${LINE}s/.*/    const VERSION = '${2}';/" public/class-${slug}.php

LINE=`sed -n '/ * Version:/{=}' ${slug}.php`
sed -i "${LINE}s/.*/ * Version:           ${2}/" ${slug}.php

echo "Super Fast! YOORAH!"