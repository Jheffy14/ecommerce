<?php

use \Hcode\Page;
use \Hcode\Model\Produtc;
use \Hcode\Model\Category;
use \Hcode\Model\Cart;

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

$app->get("/cart", function () {

	$cart = Cart::getFromSession();

	$page = new Page();

	$page->setTpl("cart", [
		'cart' => $cart->getValues(),
		'products' => $cart->getProducts(),
		'error' => Cart::getMsgError()
	]);
});

$app->get("/cart/:idproduct/add", function ($idproduct) {

	$product = new Product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();

	$qtd = (isset($_GET['qtd'])) ? (int)$_GET['qtd'] : 1;

	for ($i = 0; $i < $qtd; $i++) {

		$cart->addProduct($product);
	}

	header("Location: /cart");
	exit;
});

$app->get("/cart/:idproduct/minus", function ($idproduct) {

	$product = new Product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();

	$cart->removeProduct($product);

	header("Location: /cart");
	exit;
});

$app->get("/cart/:idproduct/remove", function ($idproduct) {

	$product = new Product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();

	$cart->removeProduct($product, true);

	header("Location: /cart");
	exit;
});

$app->post("/cart/freight", function () {

	$cart = Cart::getFromSession();

	$cart->setFreight($_POST['zipcode']);

	header("Location: /cart");
	exit;
});

 ?>