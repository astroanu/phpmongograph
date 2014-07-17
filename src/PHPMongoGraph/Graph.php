<?php
namespace PHPMongoGraph;

class Graph{
	public static $_client;	
	public static $_nodescoll = '__nodes';
	public static $_relscoll = '__rels';
	
	public function __construct($dsn, $db){
		$this->_client = MClient::getInstance($dsn, $db);
	}
	
	public function makeNode(){
		return new Node();
	}
	
	public function getNode($id){
		return Node::getNode($id);
	}
	
	public function makeConnection(){
		return new Connection();
	}	
}
?>