<?php  if(!defined('_source')) die("Error");
	$d->setTable('curriculum');
	$d->select("*");
	$result = $d->fetch_array();
	$d->reset();
	// thanh tieu de
	$title_bar = _curriculum." - ";
?>