<?php

/**
*
*    Classe que que engloba todas as funcionalidades do sistema
*
*/
class Core {

	public $page;

	public $data;

	/**
	*    Inicia objeto definindo qual página está sendo acessada.
	*    Encaminha as requisições POST para o metódo específico de cada página
	*/
	public function __construct()
	{

		if (!empty($_SERVER['PATH_INFO'])) {

			$this->page = substr($_SERVER['PATH_INFO'], 1);

		}

		if (isset($_POST) && !empty($_POST)) {

			$this->data = $_POST;

			if (method_exists($this, $this->page)) {

				$this->{$this->page}();

			} else {

				$this->renderPage("<h1>Essa ação não está disponível</h1>");

			}

		}

	}

	/**
	*    Renderiza a view da página.
	*
	*    @param string $error resposta caso a página não exista
	*/
	public function renderPage($error = false)
	{

		if ($error) {

			echo $error;

		} else {

			if ($this->page) {

				$page_path = dirname(dirname(__FILE__)) . '/pages/' . $this->page . '.php';

				if (is_readable($page_path)) {

					require_once $page_path;

				} else {

					echo "<h1>Essa página não existe!</h1>";

				}

			}

		}

	}

	/**
	*    Insere um novo cliente
	*/
	public function add()
	{

		$result = $this->insert();

		$this->redirect('/list');

	}

	/**
	*    Lista todos os clientes
	*/
	public function llist()
	{

		$clientes = array();

		$clientes = $this->select();

		return $clientes;

	}

	/**
	*    Edita os dados de um cliente
	*/
	public function edit()
	{

		if (!empty($_GET['id'])) {

			$cliente = $this->execute("SELECT * FROM cliente WHERE idCliente = " . $_GET['id']);

			$m_cliente = array(
				'nome'			=> null,
				'idade'			=> null,
				'rg'			=> null,
				'endereco'		=> null,
				'cep'			=> null,
			);

			$cliente = array_merge($m_cliente, $cliente[0]);

			if (!$this->data)
				return $cliente;

		} else {

			$this->redirect('/list');

		}

		if ($this->data) {

			$this->data = array_diff($this->data, $cliente);

			if (!empty($this->data)) {

				$result = $this->update($_GET['id']);

			}

			$this->redirect('/list');

		}

	}

	/**
	*    Exclui um cliente
	*/
	public function del()
	{

		if (empty($_GET['id'])) {

			$this->redirect('/list');

		} else {

			$result = $this->delete($_GET['id']);

			$this->redirect('/list');

		}

	}

	/**
	*    Prepara os dados para serem inseridos no banco de dados
	*
	*    @return array com os campos e os valores
	*/
	public function prepareData()
	{

		foreach ($this->data as $key => $val)
			if (is_null($val) || empty($val) || $val == '')
				unset($this->key);

		$fields = array_keys($this->data);

		$values = array_values($this->data);

		foreach ($values as $key => $val) {

			if (is_string($val)) {

				$values[$key] = '"' . $val . '"';

			}

		}

		if ($this->page == 'add') {

			$fields[] = 'criacao';
			$values[] = 'NOW()';

			$fields[] = 'ultima_alteracao';
			$values[] = 'NOW()';

			$fields = '(' . implode(', ', $fields) . ')';

			$values = '(' . implode(', ', $values) . ')';

		}

		if ($this->page == 'edit') {

			$fields[] = 'ultima_alteracao';
			$values[] = 'NOW()';

		}

		return array('fields' => $fields, 'values' => $values);

	}

	/**
	*    Gera a srting query à ser executa pelo banco de dados
	*
	*    @param array $fields campos que compõem a query
	*    @param array $values valores que compõem a query
	*    @param string|integer $id identificador de um registro específico
	*    @return string query SQL à ser executada
	*/
	public function buildQuery($fields, $values, $id = null)
	{

		if ($this->page == 'add') {

			$queryArray = array('INSERT INTO', 'cliente', $fields, 'VALUES', $values);

			$query = implode(' ', $queryArray);

		}

		if ($this->page == 'edit') {

			array_walk($fields, function(&$item, $key, $values) {

				$item = $item . ' = ' . $values[$key];

			}, $values);

			$updates = implode(', ', $fields);

			$where = 'idCliente = ' . $id;

			$queryArray = array('UPDATE', 'cliente', 'SET', $updates, 'WHERE', $where);

			$query = implode(' ', $queryArray);

		}

		return $query;

	}

	/**
	*    Inicia objeto responsável pela interação com o banco de dados, passa a query à ser executada e retorna o resultado
	*
	*    @param string $query string query SQL à ser executada
	*    @return array de resultados|boolean (true or false)
	*/
	public function execute($query)
	{

		require_once 'Db.php';

		$db = new db();

		return $db->_execute($query);

	}

	/**
	*    Redireciona para uma URL especifícada
	*
	*    @param string $url url para qual será redirecionado
	*/
	public function redirect($url)
	{

		header('Location: ' . $url);

	}

	/**
	*    Seleciona todos os registros de uma tabela ou um específico
	*
	*    @param string|integer $id identificador de um registro específico
	*    @return array de resultados|boolean (true or false)
	*/
	public function select($id = null)
	{

		if (!empty($id)) {

			$where = ' WHERE idCliente = ' . $id;

		} else {

			$where = null;

		}

		return $this->execute("SELECT * FROM cliente" . $where);

	}

	/**
	*    Insere dados em uma tabela
	*/
	public function insert()
	{

		extract($this->prepareData());

		$query = $this->buildQuery($fields, $values);

		return $this->execute($query);

	}

	/**
	*    Atualiza registros em uma tabela
	*
	*    @param string|integer $id identificador do registro
	*    @return boolean (true or false)
	*/
	public function update($id = null)
	{

		extract($this->prepareData());

		$query = $this->buildQuery($fields, $values, $id);

		return $this->execute($query);

	}

	/**
	*    Remove um registro de uma tabela
	*
	*    @param string|integer $id identificados do registro
	*    @return boolean (true or false)
	*/
	public function delete($id = null)
	{

		$query = "DELETE FROM cliente WHERE idCliente = " . $id;

		return $this->execute($query);

	}

}
