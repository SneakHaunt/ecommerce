<?php 
/*
password_verify — Verifica se um password corresponde com um hash
*/
namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model{

	const SESSION = "User";

	public static function login($login, $password){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));

		if(count($results) === 0)
		{
			throw new \Exception("Usuário inexistente ou senha inválida.");
			
		}

		$data = $results[0];

		if(password_verify($password, $data["despassword"]) === true)
		{	

			$user = new User();
			//$user->setiduser($data["iduser"]);
			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;

		}else{

			throw new \Exception("Usuário inexistente ou senha inválida.");

		}
	}


	public static function verifyLogin($inadmin = true)
	{
		if(
			!isset($_SESSION[User::SESSION]) //Verifica se está definida.
			||
			!$_SESSION[User::SESSION] //Pode estar definida, mas, sem valor.
			||
			//Se não for maior que 0 e for vazio ao realizar o cast para int vira 0.
			!(int)$_SESSION[User::SESSION]["iduser"] > 0
			||
			(bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin
		){
			header("Location: /admin/login");
			exit;
		}
	}


	public static function logout()
	{
		$_SESSION[User::SESSION] = NULL;
	}

}

?>