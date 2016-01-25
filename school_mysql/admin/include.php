<?php 
	header("content-type:text/html;charset=utf-8");
	date_default_timezone_set("PRC");
	define("ROOT",dirname(__FILE__));
	set_include_path(".".PATH_SEPARATOR.ROOT."/common"  .PATH_SEPARATOR.ROOT."/include"  .PATH_SEPARATOR.  get_include_path());
	require_once 'functions.php';
	require_once 'upload.class.php';
	require_once "config.php";
	require_once "mysql.func.php";
	connect();
?>