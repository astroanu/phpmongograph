<?php
namespace PHPMongoGraph;
class Graph{
	public static $_client;
	
	public function __construct($dsn, $db){
		$this->_client = MClient::getInstance($dsn, $db);
	}
	
	public function makeNode($refid){
		return new Node($refid);
	}
	
	public function getNode($refid){
		return Node::getNode($refid);
	}
}
?>