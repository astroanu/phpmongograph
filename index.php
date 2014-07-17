<?php
use PHPMongoGraph\Connection;

require('vendor/autoload.php');

use PHPMongoGraph\Graph;

$graph = new Graph('mongodb://127.0.0.1', 'graph');

//$node = $graph->makeNode();
//$node->setProperty('name', 'indika');
//$node->save();

$a = $graph->getNode('53c7c840295e8815378b4568');
$v = $graph->getNode('53c7cd8b295e8858078b456b');
$t = $graph->getNode('53c7d643295e8858078b456c');
$i = $graph->getNode('53c7d656295e885a078b456d');

$graph->makeConnection()->setStartNode($v)->setEndNode($a)->setType('LIKES')->save();
$graph->makeConnection()->setStartNode($v)->setEndNode($t)->setType('LIKES')->save();
$graph->makeConnection()->setStartNode($i)->setEndNode($t)->setType('LIKES')->save();
$graph->makeConnection()->setStartNode($a)->setEndNode($t)->setType('LIKES')->save();
$graph->makeConnection()->setStartNode($t)->setEndNode($a)->setType('LIKES')->save();

$connections = $a->getConnections(array('LIKES'), Connection::DIRECTION_IN);

echo $connections->getCount().' people ' . implode(', ', $connections->getType()) . ' ' . $connections->getSubject();

?>