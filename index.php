<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim(); //$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
	/*
    Isso foi usado só para testar
	$sql = new Hcode\DB\Sql();
	$results = $sql->select("SELECT * FROM tb_users");
	echo json_encode($results);
	*/

	$page = new Page(); //Chama __construct que adicionara o header.

	$page->setTpl("index"); //Adiciona Conteudo.
	/*
	Termina a execução, o PHP limpa a memória do código, chamando o __destruct que irá incluir o footer.
	*/


});

$app->get('/admin', function() {

	User::verifyLogin();
	
	$page = new PageAdmin();

	$page->setTpl("index");
	
});


$app->get("/admin/login", function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");

});

$app->post("/admin/login", function(){

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");
	exit;

});

$app->get("/admin/logout", function() {
	User::logout();
	header("Location: /admin/login");
	exit;
});

$app->run();

 ?>