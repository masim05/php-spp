<?php

namespace SPP;

interface GraphInterface
{
    /**
     * Adds a new vertex to the current graph.
     *
     * @param  String $vertex
     * @return GraphInterface
     * @throws SPP\Exception
     */
    public function addVertex($vertex);

    /**
     * Adds a new edge between existing verteces in the current graph.
     *
     * @param  String $from , String $to, Integer $cost
     * @return GraphInterface
     * @throws SPP\Exception
     */
    public function addEdge($from, $to, $cost);

    /**
     * Adds a new edge to the current graph creating verteces if necessary.
     *
     * @param  String $from , String $to, Integer $cost
     * @return GraphInterface
     * @throws SPP\Exception
     */
    public function addEdgeForce($from, $to, $cost);
}

?>