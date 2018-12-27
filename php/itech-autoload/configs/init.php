<?php
const DEVELOPMENT_MODE = true;
const PRODUCTION_MODE = !DEVELOPMENT_MODE;
if(DEVELOPMENT_MODE){
	error_reporting(E_ALL);
}
else {
	error_reporting(E_NOTICE);
}

const CONTROLLER_EXCLUDE_DIR = array('exclude','excluded');
const CONFIG_EXCLUDE_DIR = array('exclude','excluded');
const CONFIG_AUTO_INCLUDE = array();

const FILE_LOAD_TAGS = array(
	/*
	'views' => ROOT_DIR. DIRECTORY_SEPARATOR .'views',
	'admin' => ROOT_DIR. DIRECTORY_SEPARATOR .'admins',
	'template' => ROOT_DIR. DIRECTORY_SEPARATOR .'views/template'
	*/
);

