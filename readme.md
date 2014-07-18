PHPMongoGraph
=========

####creating graph object

``$graph = new Graph('mongodb://127.0.0.1', 'dbname');``

here $graph will return a graph object.

####creating a node

``
$node = $graph->makeNode();

$node->setProperty('name', 'indika');

$node->save()
``

after a creating a node
