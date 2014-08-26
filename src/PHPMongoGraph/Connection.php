<?php
namespace PHPMongoGraph;

class Connection{
	const DIRECTION_OUT = 'out';
	const DIRECTION_IN = 'in';
	
	private $_data;
	private $_mongoId;
	
	public function setType($type){
		$this->_data['type'] = $type;
		return $this;
	}
	
	public function setStartNode(Node $object){
		$this->_data['start'] = $object->getId();
		return $this;
	}
	
	public function setEndNode(Node $object){
		$this->_data['end'] = $object->getId();
		return $this;
	}
	
	public function getProperties(){
		return $this->_data['props'];
	}
	
	public function setProperty($property, $value){
		$this->_data['props'][$property] = $value;
		return $this;
	}
	
	public function save(){
		$this->_data['uts'] = new \MongoDate(time());
		return MClient::getDb()->update(
				Graph::$_relscoll,
				array('hash' => md5($this->_data['start'] . $this->_data['end'] . $this->_data['type'])),
				array('$set' => $this->_data),
				array('upsert' => true)
		);
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
			$this->_data = array('cts' => new \MongoDate(time()));
			$this->_data['props'] = array();
		}
	}
}
?>