<?php
namespace PHPMongoGraph;

Class Node{
	private $_data;
	private $_mongoId;
	
	public function getConnections($types, $direction){
		$d = ($direction == Connection::DIRECTION_IN) ? 'end' : 'start';
		$q = array($d => $this->_mongoId, 'type' => array('$in' => $types));
		$cur = MClient::getDb()->find(Graph::$_relscoll, $q, array('hash' => false));
		
		return new Relationships($this->getId(), $cur, $direction, $types);
	}
	
	public function getId(){
		return $this->_mongoId;
	}
	
	public function getProperty($property){
		if(isset($this->_data['props'][$property])){
			return $this->_data['props'][$property];
		}
		return null;
	}
	
	public function getProperties(){
		return $this->_data['props'];
	}
	
	public function setProperty($property, $value){
		$this->_data['props'][$property] = $value;
		return $this;
	}
	
	public function save(){
		MClient::getDb()->update(
				Graph::$_nodescoll,
				array('_id' => $this->_mongoId),
				array('$set' => $this->_data),
				array('upsert' => true)
		);		
		return $this;
	}
	
	public function __construct(){
		if(func_num_args() == 1){
			$doc = func_get_arg(0);
			$this->_mongoId = new \MongoId($doc['_id']);
			unset($doc['_id']);
			$this->_data = $doc;
		}
		else{
			$this->_mongoId = new \MongoId();
			$this->_data = array();
			$this->_data['props'] = array();
		}		
	}
	
	public static function getNode($id){
		$doc = MClient::getDb()->findOne(
				Graph::$_nodescoll,
				array('_id' => new \MongoId($id))
			);
		if(is_array($doc)){
			return new self($doc);
		}
		return null;
	}
}
?>