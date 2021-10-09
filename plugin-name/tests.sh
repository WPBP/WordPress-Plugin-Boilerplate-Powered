#!/bin/sh

#
# This file is part of WordPress Plugin Boilerplate Powered.
#
# WordPress Plugin Boilerplate Powered is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# WordPress Plugin Boilerplate Powered is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with Foobar.  If not, see <https://www.gnu.org/licenses/>.

# Do you want to execute a specific test suites? this script accept as first paramete the suite name!

if ! lsof -Pi :4444 -sTCP:LISTEN -t >/dev/null; then
	echo " - Run Selenium"
	java -jar -Dwebdriver.chrome.driver=/opt/selenium/chromedriver /opt/selenium/selenium-server.jar 2> /dev/null &
fi

echo " - Run Codeception"

./tests/custom.sh

codecept run "$1"
