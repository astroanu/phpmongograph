<?php
namespace PHPMongoGraph;

Class Node{
	private $_data;
	private $_mongoId;
	
	public function getConnections($types, $direction, $after = null, $limit = 30){
		$d = ($direction == Connection::DIRECTION_IN) ? 'end' : 'start';
		$q = array($d => $this->_mongoId, 'type' => array('$in' => $types));
		
		if(!is_null($after)){
			$q['uts'] = array('$lt' => new \MongoDate($after));
		}
		
		$cur = MClient::getDb()->find(Graph::$_relscoll, $q, array('hash' => false))->sort(array('uts' => -1))->limit($limit);
		
		return $cur;
		
		/*$result = MClient::getDb()->aggregate(Graph::$_relscoll, array(
				array('$match' => array($d => $this->_mongoId, 'type' => array('$in' => $types))),
				array('$group' => array('_id' => '$end', 'doc' => array('$addToSet' => '$_id')))
		));
		
		print_r($result['result']);
		exit();
		
		return $result['result'];*/
		//return new Relationships($this->getId(), $cur, $direction, $types);
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
		$this->_data['uts'] = new \MongoDate(time());
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
			$this->_data = array('cts' => new \MongoDate(time()));
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