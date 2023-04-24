<?php

$env = parse_ini_file('tests/_envs/.env');

if ( isset($env["DB_NAME"]) ) {
	define('DB_NAME', $env["DB_NAME"]);
}

$dbuser = '';
if ( isset($env["WP_TESTS_DB_USER"]) ) {
	$dbuser = $env["WP_TESTS_DB_USER"];
}

if ( empty( $dbuser ) && isset( $env["DB_USER"] ) ) {
	$dbuser = $env["DB_USER"];
}

if ( isset($env["DB_USER"]) ) {
	define('DB_USER', $dbuser);
}

$dbpass = '';
if ( isset($env["WP_TESTS_DB_PASSWORD"]) ) {
	$dbpass = $env["WP_TESTS_DB_PASSWORD"];
}

if ( empty( $dbpass ) && isset( $env["DB_PASSWORD"] ) ) {
	$dbpass = $env["DB_PASSWORD"];
}

define('DB_PASSWORD', $dbpass);

if ( isset($env["DB_HOST"]) ) {
	define('DB_HOST', $env['DB_HOST']);
}

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

$table_prefix = 'wp_';

define( 'DOING_AJAX', false );
