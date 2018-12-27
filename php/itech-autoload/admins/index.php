<?php

define('ABSPATH', dirname(__FILE__) . '/../');
require_once ABSPATH .'autoloader.php';

//configs("umer");

 $mysqlidb = new MysqliDB();
 //$mysqldb = new MysqlDB();
 $helper = new Helper();
 $admin = new Admin();


$oh = new OtherTwoHelper();
$oh = new OtherHelper();

load("root" , ['old']   );
load("parent" , ['old'],'','include');
load('templates','header');

if (PRODUCTION_MODE) {
	echo 'Production';
}
else {
	echo "Development Mode";
}

/*
root/a/b/c.php
root/a/b/abc/xyz

cd == B

root/a/b/c/d/x.php
load("cd","abc/xyz","c2"); //root/a/b/c2.php
load("root","r"); //root/r.php
load("parent","","p");//root/a/p.php


//load("sibling","abc/xyz","asdfas.asdf.asdfas");
load("parent-sibling","xyz","a,b,c,d");
load("child","abc","a.b.xc.");

root/a/ b/bb.php
root/a/b/ c.php 

root/a/d/aa

root/r.php
*/