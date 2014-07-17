<?php
require('vendor/autoload.php');

use PHPMongoGraph\Graph;

$graph = new Graph('mongodb://127.0.0.1', 'graph');

$graph->makeNode(12312)->save();

?>