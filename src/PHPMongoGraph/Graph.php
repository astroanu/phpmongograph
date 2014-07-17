<?php
namespace PHPMongoGraph;
class Graph{
	public $_client;
	
	public function __construct($dsn, $db){
		$this->_client = new MClient($dsn, $db);
	}
	
	public function makeNode($id){
		return new Node($id);
	}
}
?>