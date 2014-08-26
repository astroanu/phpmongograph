<?php
namespace PHPMongoGraph;

class Relationships{
	private $_ids = array();
	private $_direction;
	private $_types;
	private $_subject;
	
	public function __construct($subject, $cur, $direction, $types){
		foreach ($cur as $n) {
			if(!isset($this->_ids[$n['type']])){
				$this->_ids[$n['type']] = array();
			}
			
			if($direction == Connection::DIRECTION_IN){
				array_push($this->_ids[$n['type']], $n['start']);
			}
			else if($direction == Connection::DIRECTION_OUT){
				array_push($this->_ids[$n['type']], $n['end']);
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
}