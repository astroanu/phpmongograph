<?php
require('vendor/autoload.php');

use PHPMongoGraph\Graph;
use PHPMongoGraph\Node;
use PHPMongoGraph\Connection;

$graph = new Graph('mongodb://127.0.0.1', 'graph');

/*$a = $graph->makeNode();
$a->setProperty('name', 'anuradha')->save();
$v = $graph->makeNode();
$v->setProperty('name', 'viraj')->save();
$t = $graph->makeNode();
$t->setProperty('name', 'trev')->save();
$i = $graph->makeNode();
$i->setProperty('name', 'indika')->save();
*/


$a = $graph->getNode('5406d31e295e880e5d8b456c');
$v = $graph->getNode('5406d31e295e880e5d8b456d');
$t = $graph->getNode('5406d31e295e880e5d8b456e');
$i = $graph->getNode('5406d31e295e880e5d8b456f');

$a->setProperty('name', 'anuradha')->save();
$v->setProperty('name', 'viraj')->save();
$t->setProperty('name', 'trev')->save();
$i->setProperty('name', 'indika')->save();

$graph->makeConnection()->setStartNode($v)->setEndNode($a)->setType('LIKES')->save();
sleep(1);
$graph->makeConnection()->setStartNode($v)->setEndNode($t)->setType('LIKES')->save();
sleep(1);
$graph->makeConnection()->setStartNode($i)->setEndNode($t)->setType('LIKES')->save();
sleep(1);
$graph->makeConnection()->setStartNode($a)->setEndNode($t)->setType('LIKES')->save();
sleep(1);
$graph->makeConnection()->setStartNode($t)->setEndNode($a)->setType('HATES')->save();

$connections = $a->getConnections(array('HATES', 'LIKES'), Connection::DIRECTION_IN);

foreach ($connections as $con) {
	print_r($con);
}

?>