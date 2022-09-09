#!/bin/sh

# You can add there your script to execute before codeception
# Can be useful for check if MySql is running as example

UP=$(sudo service mysql status | grep -c "stopped\|dead\|failed");
if [ "$UP" -eq 2 ]; then
	echo " - Mysql is not running, launched right now"
	sudo service mysql start
fi

/opt/chromedriver --url-base=wd/hub --port=4444 &
