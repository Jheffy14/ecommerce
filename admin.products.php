<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;

$app->get("/admin/products", function  (){

	User::verifyLogin();

	$products = Product::listAll();

	$page = new PageAdmin();

	$page->setTpl("products",[
		"products"=>$products
	]);

});


$app->get("/admin/products/create", function  (){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("products-create");

});

$app->post("/admin/products/create", function  (){

	User::verifyLogin();

	$products = new Product();

	$products->setData($_POST);

	$products->save();

	header("Location: /admin/products");
	exit;
});

$app->get("/admin/products/:idproduct", function ($idproduct){

	User::verifyLogin();

	$Product = new Product();

	$Product->get((int)$idproduct);

	$page = new PageAdmin();

	$page->setTpl("products-update",[
		'products'=>$product->getValues()
	]);

});

$app->post("/admin/products/:idproduct", function ($idproduct){

	User::verifyLogin();

	$Product = new Product();

	$Product->get((int)$idproduct);

	$Product->setData($_POST);

	$Product->save();

	$Product->setPhoto($_FILES["file"]);

	header('Location: /admin/products');
	exit;
});

$app->get("/admin/products/:idproduct/delete", function ($idproduct){

	User::verifyLogin();

	$Product = new Product();

	$Product->get((int)$idproduct);

	$Product->delete();

	header('Location: /admin/products');
	exit;

});
 ?>