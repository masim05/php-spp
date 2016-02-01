<?php

namespace SPP;

use SPP\Exception;

class Graph implements GraphInterface
{

    protected $vertices = array();


    /**
     * {@inheritdoc}
     */
    public function addVertex($vertex)
    {
        throw new Exception("addVertex is not implemented.");
    }

    /**
     * {@inheritdoc}
     */
    public function addEdge($from, $to, $cost)
    {
        $this->assertArgumentType("string", "from", $from);
        $this->assertArgumentType("string", "to", $to);
        $this->assertArgumentType("integer", "cost", $cost);
        $this->assertCostPositiveness($cost);

        $this->assertVertexExistance($from);
        $this->assertVertexExistance($to);

        $from_connections = $this->vertices[$from];
        if (array_key_exists($to, $from_connections)) {
            throw new Exception(
                "The edge '" . $from . "' -> '" . $to . "' already exists."
            );
        }
        $this->vertices[$from][$to] = $cost;

        $to_connections = $this->vertices[$to];
        if (array_key_exists($from, $to_connections)) {
            throw new Exception(
                "The edge '" . $to . "' -> '" . $from . "' already exists."
            );
        }
        $this->vertices[$to][$from] = $cost;

    }

    /**
     * {@inheritdoc}
     */
    public function addEdgeForce($from, $to, $cost)
    {
        $this->assertArgumentType("string", "from", $from);
        $this->assertArgumentType("string", "to", $to);
        $this->assertArgumentType("integer", "cost", $cost);
        $this->assertCostPositiveness($cost);

        if (!array_key_exists($from, $this->vertices)) {
            $this->vertices[$from] = array();
        }

        if (!array_key_exists($to, $this->vertices)) {
            $this->vertices[$to] = array();
        }

        $this->addEdge($from, $to, $cost);
    }

    /* Private methods */

    /*
     * @param String $type
     * @param String $name
     * @param mixed $value
     * @throws \SPP\Exception
     */
    private function assertArgumentType($type, $name, $value)
    {
        if (gettype($value) != $type) {
            throw new Exception(
                "Invalid '" . $name . "' argument: must be " . $type . "."
            );
        }
    }

    /*
     * @param Integer $value
     * @throws \SPP\Exception
     */
    private function assertCostPositiveness($value)
    {
        if ($value <= 0) {
            throw new Exception("Cost is '" . $value . "', but must be positive.");
        }

    }

    /*
     * @param String $id
     * @throws \SPP\Exception
     */
    private function assertVertexExistance($id)
    {
        if (!array_key_exists($id, $this->vertices)) {
            throw new Exception("Vertex '" . $id . "' not found in graph.");
        }

    }
}

?>