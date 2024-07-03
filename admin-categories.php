<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;

$app->get("/admin/categories", function(){

	User::verifyLogin();

	$categories = Category::listAll();

	$page = new PageAdmin();

	$page->setTpl("categories",[
		'categories'=>$categories
	]);

});

$app->get("/admin/categories/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("categories-create");

});

$app->post("/admin/categories/create", function(){

	User::verifyLogin();

	$Category = new Category();

	$Category->setData($_POST);

	$Category->save();

	header('Location: /admin/categories');
	exit;
});

$app->get("/admin/categories/:idcategory/delete",function($idcategory){

	User::verifyLogin();

	$Category = new Category();

	$Category->get((int)$idcategory);

	$Category->delete();

	header('Location: /admin/categories');
	exit;
});

$app->get("/admin/categories/:idcategory",function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$categorY->get((int)$idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-update",[
		'category'=>$category->getValues()
	]);
});

$app->post("/admin/categories/:idcategory",function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$categorY->get((int)$idcategory);

	$category->setData($_POST);

	$categorY->save();

	header('Location: /admin/categories');
	exit;

});

$app->get("/categories/:idcategory", function($idcategory){

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new page();

	$page->setTpl("category",[
		'category'=>$category->getValues()
		'products'=>[]
	]);
}); 




 ?>