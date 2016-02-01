<?php

namespace SPP;

interface SPPSolverInterface
{
    /**
     * Solves the shortest path problem on a given graph.
     *
     * @param  Graph $graph , String $from , String $to
     * @return mixed
     * @throws SPP\Exception
     */
    public function solve($from, $to);
}

?>