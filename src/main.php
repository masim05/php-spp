<?php

require_once __DIR__ . '/../vendor/autoload.php';

use SPP\Graph;
use SPP\DijkstraSPPSolver;

function main($from, $to, $connections)
{
    $graph = new Graph();

    foreach ($connections as $params) {
        $graph->addEdgeForce($params[0], $params[1], $params[2]);
    };

    $algo = new DijkstraSPPSolver($graph);

    $algo->solve($from, $to);
    print_r($algo->getSolution());
}

main(
    'Moscow',
    'Ufa',
    [
        ['Moscow', 'Nizhny Novgorod', 10],
        ['Nizhny Novgorod', 'Kazan', 10],
        ['Kazan', 'Samara', 8],
        ['Kazan', 'Izhevsk', 9],
        ['Samara', 'Moscow', 26],
        ['Izhevsk', 'Perm', 8],
        ['Kazan', 'Ufa', 12],
        ['Samara', 'Ufa', 11],
        ['Ufa', 'Orenburg', 12],
    ]
);

?>