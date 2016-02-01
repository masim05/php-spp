<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use SPP\Graph;
use SPP\DijkstraSPPSolver;

class DijkstraTest extends PHPUnit_Framework_TestCase
{

    public function testSolutionInConnectedGraph()
    {
        $graph = new Graph();

        $graph->addEdgeForce('Moscow', 'Kaluga', 10);
        $graph->addEdgeForce('Moscow', 'Tula', 12);
        $graph->addEdgeForce('Moscow', 'Ryazan', 14);
        $graph->addEdgeForce('Moscow', 'Vladimir', 16);
        $graph->addEdgeForce('Kaluga', 'Tula', 4);
        $graph->addEdgeForce('Ryazan', 'Tula', 10);
        $graph->addEdgeForce('Ryazan', 'Vladimir', 16);

        $solver = new DijkstraSPPSolver($graph);

        $solver->solve('Kaluga', 'Vladimir');
        $solution = $solver->getSolution();

        //print_r($solution);

        $this->assertEquals(true, $solution["success"]);
        $this->assertEquals(26, $solution["cost"]);

    }

    public function testSolutionInDisconnectedGraph()
    {
        $graph = new Graph();

        $graph->addEdgeForce('Moscow', 'Kaluga', 10);
        $graph->addEdgeForce('Ryazan', 'Vladimir', 16);

        $solver = new DijkstraSPPSolver($graph);

        $solver->solve('Kaluga', 'Vladimir');
        $solution = $solver->getSolution();

        //print_r($solution);

        $this->assertEquals(false, $solution["success"]);

    }
}

?>