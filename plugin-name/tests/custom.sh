#!/bin/sh

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

# You can add there your script to execeute before codeception
# Can be useful for check if MySql is running as example

UP=$(sudo service mysql status | grep -c "stopped\|dead\|failed");
if [ "$UP" -eq 2 ]; then
	echo " - Mysql is not running, launched right now"
	sudo service mysql start
fi
