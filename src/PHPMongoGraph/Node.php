<?php
namespace PHPMongoGraph;
Class Node{
	private $_data;
	private $_mongoId;
	private static $_prefix = '__';
	
	public function __construct($id){
		if(is_array($id)){
			$this->_mongoId = new \MongoId($id['_id']);
			unset($id['_id']);
			$this->_data = $id;
		}
		else{
			$this->_mongoId = new \MongoId();
			$this->_data = array('id' => $id);
		}		
	}
	
	public static function getNode($id){
		$doc = MClient::getDb()->findOne(
				self::$_prefix . 'nodes',
				array('id' => $id)
			);
		if(is_array($doc)){
			return new self($doc);
		}
		return null;
	}
	
	public function save(){
		return MClient::getDb()->update(
				self::_prefix . 'nodes',
				array('_id' => $this->_mongoId), 
				array('$set' => $this->_data), 
				array('upsert' => true)
			);
	}
}
?>