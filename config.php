<?php
$ini = parse_ini_file('config.ini');

$db_name = $GLOBALS['db_name'] = $ini['db_name'];
$db_user = $GLOBALS['db_user'] = $ini['db_user'];
$db_password = $GLOBALS['db_password'] = $ini['db_password'];

$main_index_url = $GLOBALS['main_index_url'] = $ini['main_index_url'];

$root_dir = $_SERVER['DOCUMENT_ROOT'] . "/smartnote/";
$GLOBALS['root_dir'] = $root_dir;

// db-functions
function get_db_name() {
	return $GLOBALS['db_name'];
}
function get_db_user() {
	return $GLOBALS['db_user'];
}
function get_db_password() {
	return $GLOBALS['db_password'];
}

// url-functions
function get_root_url() {
	return $GLOBALS['main_index_url'];
}

function get_root_dir() {
	return $GLOBALS['root_dir'];
}