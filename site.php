<?php

use \Hcode\Page;
use \Hcode\Model\produtc;

$app->get('/', function() {

	$produtcs = produtc::listAll();
    
	$page = new Hcode\Page();

	$page->setTpl("index",[
		'produtcs'=>produtc::checkList($produtcs)
	]);
});



 ?>