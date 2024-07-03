<?php

use \Hcode\Page;
use \Hcode\Model\Produtc;
use \Hcode\Model\Category;

$app->get('/', function() {

	$produtcs = Produtc::listAll();
    
	$page = new Hcode\Page();

	$page->setTpl("index",[
		'produtcs'=>produtc::checkList($produtcs)
	]);
});

$app->get("/categories/:idcategory", function($idcategory){

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new page();

	$page->setTpl("category",[
		'category'=>$category->getValues(),
		'products'=>produtc::checkList($category->getProducts())
	]);
}); 

 ?>