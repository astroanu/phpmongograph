<?php
namespace PHPMongoGraph;

class MClient{
	private static $instance;
	private static $_client;
	private static $_db; 
	
	final public static function getInstance($dsn, $db = 'test'){ 
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class($dsn, $db);
        }
        return self::getDb();
    }
     
    final public static function getClient(){     	
       	return self::$_client;
    } 
    
    final public static function getDb(){
    	if(is_null(self::$instance)){
    		throw new \Exception(__METHOD__.' could not get instance');
    	}
    	return self::$instance;
    }
    
    public function __construct($dsn, $db){
    	self::$_client = new \MongoClient($dsn);
    	self::$_db = $db;
    }
    
    public function insert($collection, $data){
    	$db = self::$_db;
    	self::$_client->$db->$collection->insert($data);
    	return $data;
    }
	
	public function aggregate($collection, $aggregation){
		$db = self::$_db;
		$result = self::$_client->$db->$collection->aggregate($aggregation);	
		return $result;
	}
	
	public function update($collection, $where, $update, $options){
		$db = self::$_db;
		$result = self::$_client->$db->$collection->update($where, $update, $options);
		return $result;
	}
	
	public function find($collection, $where, $return = array()){
		$db = self::$_db;
		$result = self::$_client->$db->$collection->find($where, $return);
		return $result;
	}
	
	public function findOne($collection, $where, $return = array()){
		$db = self::$_db;
		$result = self::$_client->$db->$collection->findOne($where, $return);
		return $result;
	}
}
?>