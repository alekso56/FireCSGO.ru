<?php
$sitename = "http://firecsgo.ru/";
$link = mysql_connect("localhost", "vh81062_firecsgo", "151200");
$db_selected = mysql_select_db('vh81062_firecsgo', $link);
mysql_query("SET NAMES utf8");

function fetchinfo($rowname,$tablename,$finder,$findervalue) {
	if($finder == "1") $result = mysql_query("SELECT $rowname FROM $tablename");
	else $result = mysql_query("SELECT $rowname FROM $tablename WHERE `$finder`='$findervalue'");
	$row = mysql_fetch_assoc($result);
	return $row[$rowname];
}
?>