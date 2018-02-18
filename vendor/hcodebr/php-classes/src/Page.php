<?php 
/*

array_merge - The array_merge() function merges one or more arrays into one array.

Definition and Usage
The array_merge() function merges one or more arrays into one array.

Tip: You can assign one array to the function, or as many as you like.

Note: If two or more array elements have the same key, the last one overrides the others.

Se executar este código:

$a1=array("a"=>"red","b"=>"green");
$a2=array("c"=>"blue","b"=>"yellow");
print_r(array_merge($a1,$a2));

O retorno será:
Array ( [a] => red [b] => yellow [c] => blue )

É sempre o valor do último array que persiste caso seja encontrado chaves iguais. O último sempre sobreescreve os anteriores.

*/


namespace Hcode;

use Rain\Tpl;

class Page{

	private $tpl;
	private $options =[];
	private $defaults = [
		"data" => []
	];

	public function __construct($opts = array(), $tpl_dir = "/views/"){

		$this->options = array_merge($this->defaults, $opts);

		$config = array(
				"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"] . $tpl_dir,
				"cache_dir"     => $_SERVER["DOCUMENT_ROOT"] . "/views-cache/",
				"debug"         => false // set to false to improve the speed
				 );

		Tpl::configure( $config );

		/*
			Usa-se this, pois, é mais interessante ele ser um atributo da classe, assim,  tenho acesso ao tpl em outros métodos.
		*/
		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header");

	}

	private function setData($data = array())
	{
		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}
	}


	public function setTpl($name, $data = array(), $returnHTML = false)
	{ //Último método a ser executado.

		$this->setData($data);

		/*
		$tpl->draw( 'demo', TRUE ); return template in string or 
		$tpl->draw( $tpl_name ); no caso quando não tem nada é FALSE...  echo the template
		*/
		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct() //Último método a ser executado.
	{	
		$this->tpl->draw("footer");
	}

}

?>