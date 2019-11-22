<?php
require_once("../common/bootstrap.php");

$page = new controller($_SERVER['REQUEST_URI']);

if($page->redirect_to !== NULL) {
	header("Location: ".$page->redirect_to);
} else {
	echo $page->content;
}
?>
