#!/bin/sh

# Do you want to execute a specific test suites? this script accept as first paramete the suite name!

if ! lsof -Pi :4444 -sTCP:LISTEN -t >/dev/null; then
    java -jar -Dwebdriver.chrome.driver=/opt/selenium/chromedriver /opt/selenium/selenium-server.jar
fi

echo " - Run Codeception"

./tests/custom.sh

codecept run "$1"
