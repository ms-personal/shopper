<?php

/**
*
*    Classe que cria a conexão com o MySQL, executa as queries e retorna os resultados
*
*/
class db {

	public $config;

	public $conn;

	/**
	*    Cria conexão com o banco de dados MySQL
	*
	*/
	public function conn()
	{

		require_once dirname(dirname(__FILE__)) . '/database.php';

		$config = new config_database();

		$this->config = $config->config;

		$options = array(
			'mysql:dbname=' . $this->config['database'] . ';',
			'charset=' . $this->config['charset'],
		);

		$credentials = array(
			$this->config['user'],
			$this->config['password'],
		);

		$settings = array_merge(array(implode('', $options)), $credentials);

		try {

			$this->conn = new PDO($settings[0], $settings[1], $settings[2]);

			$this->conn->setAttribute(\PDO::ATTR_ERRMODE, TRUE);
			$this->conn->setAttribute(\PDO::ERRMODE_EXCEPTION, TRUE);
			$this->conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, FALSE);

		} catch(PDOException $e) {

			echo $e->getMessage();

		}

	}

	/**
	*    Retorna o tipo de query à ser executada.
	*
	*    @param string $sql query à ser executada
	*    @return tipo de query se for válida, se não for, retorna false
	*/
	public function queryType($sql)
	{

		if (strpos($sql, 'INSERT INTO') !== false && strpos($sql, 'VALUES') !== false)
			return 'insert';

		if (strpos($sql, 'UPDATE') !== false && strpos($sql, 'SET') !== false)
			return 'update';

		if (strpos($sql, 'DELETE FROM') !== false && strpos($sql, 'WHERE') !== false)
			return 'delete';

		if (strpos($sql, 'SELECT') !== false && strpos($sql, 'FROM') !== false)
			return 'select';

		return false;

	}

	/**
	*    Executa query SQL
	*
	*    @param string $sql query à ser executada
	*    @return resultado da execução, para select retorna array de linhas retornada,
	*            para os demais tipos retorna um boolean ( true or false )
	*/
	public function _execute($sql)
	{

		$this->conn();

		$type = $this->queryType($sql);

		try {

			$result = $this->conn->query($sql);

		} catch(PDOException $e) {

			echo $e->getMessage();

		}

		if ($type == 'select' && $result) {

			$result = $result->fetchAll(PDO::FETCH_ASSOC);

		}

		return $result;

	}

}
