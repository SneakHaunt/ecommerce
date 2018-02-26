<?php 
/*
O PHP tem uma função mágica chamada __call(). Se sua classe declarar um método com este nome, ele será invocado sempre que for feita uma chamada a um método não existente naquela classe.
*/
namespace Hcode;

class Model{

	private $values = [];

	public function __call($name, $args)
	{
		 /* 
		 3 se refere a quantidade e não se refere a posição, ou seja, me traga 0, 1 e 2. Se quiser a posição 3 teria que passar 4 no parametro. 
		 */
		$method = substr($name, 0, 3); 
		$fieldName = substr($name, 3, strlen($name));

		switch ($method) {
			case "get":
				return $this->values[$fieldName];
			break;
			
			case "set":
				$this->values[$fieldName] = $args[0];
			break;
		}

	}

	public function setData($data = array()){

		foreach ($data as $key => $value) {
			$this->{"set".$key}($value); //O que é dinamico deve-se usar as chaves.
		}
	}


	public function getValues()
	{
		return $this->values;
	}


}



?>