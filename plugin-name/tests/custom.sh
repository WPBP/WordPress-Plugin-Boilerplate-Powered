#!/bin/sh

UP=$(sudo service mysql status | grep -c "stopped\|dead\|failed");
if [ "$UP" -eq 2 ]; then
	echo " - Mysql is not running, launched right now"
	sudo service mysql start
fi
