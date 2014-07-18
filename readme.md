PHPMongoGraph
=========

####creating graph object

    $graph = new Graph('mongodb://127.0.0.1', 'dbname');

here $graph will return a graph object.

####creating a node

    $node = $graph->makeNode();
    $node->setProperty('name', 'tom');
    $node->save();

after a creating a node you can set properties which then later can be retrived by ``getProperties()`` or ``getProperty()`` methods. you need to call ``save()`` to save a node. use ``getId()`` to get the node id.

####getting a node 

    $a = $graph->getNode($id);
    
``getNode()`` returns a node obeject.

####making connections

    $graph->makeConnection()->setStartNode($b)->setEndNode($a)->setType('LIKES')->save();
    
the above means ``$b`` likes ``$a``

####getting connections
    $connections = $a->getConnections(array('LIKES'), Connection::DIRECTION_IN);
    
this will return nodes who like ``$a``. to get who ``$a`` likes use ``Connection::DIRECTION_OUT``

####displaying

    echo $connections->getCount().' people ' . implode(', ', $connections->getType()) . ' ' 
    . Node::getNode($connections->getSubject())->getProperty('name');
