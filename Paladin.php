<?php
namespace Util;

require_once 'DatabaseException.php';

class Paladin {

	protected $host   = 'localhost';
	protected $dbname = 'database';
	protected $user = 'root';
	protected $pass = '';

	protected $pdo;

	public function __construct($config = []) {
		
		if(!empty($config)) {
			$this->host   = $config['host'];
			$this->dbname = $config['dbname'];
			$this->user   = $config['user'];
			$this->pass   = $config['pass'];
		}

		try {
			$this->pdo = new \PDO('mysql:dbname='.$this->dbname.';host='.$this->host.';charset=utf8', $this->user, $this->pass);
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
