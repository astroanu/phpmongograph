<?php
namespace PHPMongoGraph;
class MClient{
	private $_client;
	private $_db; 
	
	private static $instances = array();
	public static function getInstance($class_name) {
		if(!array_key_exists($class_name, self::$instances)) {
			self::$instances[$class_name] = new $class_name();
		}
		return self::$instances[$class_name];
	}
	
	public function __construct($dsn, $db = 'test'){
		$this->_client = new \MongoClient($dsn);
		$this->_db = $db;
	}
	
	public function insert($collection, $data){
		$db = $this->_db;
		$this->_client->$db->$collection->insert($data);	
		return $data;
	}
	
	public function update($collection, $where, $update, $options){
		$db = $this->_db;
		$result = $this->_client->$db->$collection->update($where, $update, $options);
		return $result;
	}
	
	public function find($collection, $where){
		$db = $this->_db;
		$result = $this->_client->$db->$collection->find($where);
		return $result;
	}
	
	public function findOne($collection, $where){
		$db = $this->_db;
		$result = $this->_client->$db->$collection->findOne($where);
		return $result;
	}
}
?>