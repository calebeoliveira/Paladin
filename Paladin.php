<?php
namespace Util;

require_once 'DatabaseException.php';

/**
 * Paladin class for database connection.
 */
class Paladin {
	protected $pdo;

	public function __construct() {
		
		# Database enviroment config.
		$host   = 'localhost';
		$dbname = 'database';
		$user   = 'root';
		$pass   = '';


		try {
			$this->pdo = new \PDO('mysql:dbname='.$dbname.';host='.$host.';charset=utf8', $user, $pass);
		} catch(\PDOException $e) {
			throw new DatabaseException($e->getMessage());
		}
	}

	public function query($sql, Array $params = []) {
		$result = $this->pdo->prepare($sql);

		foreach ($params as $key => $value) {
			$result->bindParam(":{$key}", ltrim($value, ':'));
		}

		$result->execute();

		$err = $result->errorInfo();
		if(!is_null($err[1])) {
			$this->error($err[2], $err[1]);
		}
		
		return $result->fetchAll(\PDO::FETCH_ASSOC);
	}

	protected function error($name, $code) {
		# Send a email? ...
		throw new DatabaseException($name, $code);
	}
}
