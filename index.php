<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;

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
	
	$page = new PageAdmin();

	$page->setTpl("index");
	
});






$app->run();

 ?>