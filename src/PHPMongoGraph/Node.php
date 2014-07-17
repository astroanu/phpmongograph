<?php
namespace PHPMongoGraph;
Class Node{
	private $_data;
	private $_mongoId;
	
	public function __construct($x){
		if(is_array($x)){
			$this->_mongoId = new \MongoId($x['_id']);
			unset($x['_id']);
			$this->_data = $x;
		}
		else{
			$this->_mongoId = new \MongoId();
			$this->_data = array('id' => $x);
		}		
	}
	
	public function save(){
		$this->_client->update(array('_id' => $this->_mongoId), array('$set' => $this->_data), array('upsert' => true));
	}
}
?>