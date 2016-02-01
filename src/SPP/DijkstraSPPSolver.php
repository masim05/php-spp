<?php

namespace SPP;

class DijkstraSPPSolver implements SPPSolverInterface
{
    protected $graph;
    protected $handled = array();
    protected $start;
    protected $finish;

    /**
     * Instantiates a new algorithm, requiring a graph to work with.
     *
     * @param GraphInterface $graph
     */
    public function __construct(GraphInterface $graph)
    {
        $this->graph = $graph;
    }


    /**
     * {@inheritdoc}
     */
    public function solve($from, $to)
    {
        $this->start = $from;
        $this->finish = $to;

        $queue = array();

        array_push($queue, $from);
        $this->handled[$from] = array(
            "cost" => 0,
            "predecessors" => array(),
        );

        while (!empty($queue)) {
            $current = array_pop($queue);
            $connections = $this->graph->getConnections($current);
            foreach ($connections as $next => $step_cost) {
                if (array_key_exists($next, $this->handled)) {
                    // The vertex is already in access.

                    // Check if we have just found cheaper route.
                    $gap = $this->handled[$next]["cost"] - $this->handled[$current]["cost"]
                        - $step_cost;
                    if ($gap < 0) {
                        // new route is more expensive, do nothing actually
                    } else if ($gap == 0) {
                        // new route has the same cost, add it the list
                        array_push($this->handled[$next]["predecessors"], $current);
                    } else {
                        // new route is cheaper, use it
                        $this->handled[$next] = array(
                            "cost" => $this->handled[$current]["cost"] + $step_cost,
                            "predecessors" => array($current)
                        );
                    }
                } else {
                    // This is the first time we achieve the vertex.
                    array_push($queue, $next);
                    $this->handled[$next] = array(
                        "cost" => $this->handled[$current]["cost"] + $step_cost,
                        "predecessors" => array($current)
                    );
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSolution()
    {
        if (!array_key_exists($this->finish, $this->handled)) {
            return array(
                "success" => false
            );
        }

        $routes = array();
        $queue = array();

        array_push($queue, $this->finish);


        while (!empty($queue)) {
            $current = array_pop($queue);
            array_unshift($routes, $current);
            if (empty($this->handled[$current]["predecessors"])) {
                break;
            }

            array_push($queue, $this->handled[$current]["predecessors"][0]);
        }

        return array(
            "success" => true,
            "cost" => $this->handled[$this->finish]["cost"],
            "routes" => $routes,
        );
    }

}

?>