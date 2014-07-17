<?php
namespace PHPMongoGraph;

class Relationships{
	private $_nodes = array();
	private $_ids = array();
	private $_direction;
	private $_types;
	private $_subject;
	
	public function __construct($subject, $cur, $direction, $types){
		foreach ($cur as $n) {
			array_push($this->_nodes, new Node($n));
			if($direction == Connection::DIRECTION_IN){
				array_push($this->_ids, $n['start']);
			}
			else if($direction == Connection::DIRECTION_IN){
				array_push($this->_ids, $n['end']);
			}
		}
		$this->_types = $types;
		$this->_direction = $direction;
		$this->_subject = $subject;
	}

	public function getSubject(){
		return $this->_subject;
	}
	
	public function getType(){
		return $this->_types;
	}
	
	public function getCount(){
		return count($this->getIds());
	}
	
	public function getIds(){
		return $this->_ids;
	}
	
	public function getNodes(){
		return $this->_nodes;
	}
}