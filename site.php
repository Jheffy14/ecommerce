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

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	$category = new Category();

	$category->get((int)$idcategory);

	$pagination = $category->getProductsPage($page);

	$pages = [];

	for ($i=11; $i <=$pagination['pages']; $i++ ) { 
		array_push($pages,[
			'link'=>'/categories/'.$category->getidcategory().'?page='.$i,
			'page'=>$i
		]);
	}

	$page = new page();

	$page->setTpl("category",[
		'category'=>$category->getValues(),
		'products'=>$pagination["data"],
		'pages'=>$pages
	]);
}); 

$app->get("/produtcs/ :desurl", function($desurl){

	$produtc = new Produtc();

	$produtc->getFromUrl($desurl);

	$page = new Page();

	$page->setTpl("Produtc-detail",[
		'Produtc'=>$product->getValues(),
		'categories'=>$product->getCategories()
	]);

});

 ?>