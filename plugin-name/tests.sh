#!/bin/sh

# Do you want to execute a specific test suites? this script accept as first paramete the suite name!

if ! lsof -Pi :4444 -sTCP:LISTEN -t >/dev/null; then
	echo " - Run Chromedriver"
	# wget https://chromedriver.storage.googleapis.com/103.0.5060.53/chromedriver_linux64.zip > /dev/null 2>&1
	# unzip chromedriver_linux64.zip
    # nohup ./chromedriver --port=4444 &
	java -jar -Dwebdriver.chrome.driver=/opt/selenium/chromedriver /opt/selenium/selenium-server.jar 2> /dev/null &
fi

echo " - Run Codeception"

./tests/custom.sh

codecept run "$1"
