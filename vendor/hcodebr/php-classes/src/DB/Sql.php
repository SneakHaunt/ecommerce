<?php 
/*

Namespace Global
Quando estiver usando namespaces você pode reparar que funções internas ficam escondidas por funções que você mesmo escreveu. Para corrigir isso refira a funções globais através do uso de uma contra-barra antes do nome da função.

<?php
namespace phptherightway;

function fopen()
{
    $file = \fopen();    // O nome da nossa função é igual a de uma função interna.
                         // Execute a função global através da inclusão de '\'.
}

function array()
{
    $iterator = new \ArrayIterator();    
    // ArrayIterator é uma classe interna. Usar seu nome sem uma contra-barra
    // tentará localizar essa função dentro do namespace
}

*/
namespace Hcode\DB;

class Sql {

	const HOSTNAME = "127.0.0.1";
	const USERNAME = "root";
	const PASSWORD = "";
	const DBNAME = "db_ecommerce";

	private $conn;

	public function __construct()
	{

		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
			Sql::USERNAME,
			Sql::PASSWORD
		);

	}

	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>