<?php

namespace Repository\Entity;

/**
 * Description of Algorithms
 *
 * @author Andre
 */
trait AlgorithmsTrait
{
    private $algorithmsTable;

    public function setAlgorithmsTable($algorithmsTable)
    {
        $this->algorithmsTable = $algorithmsTable;
    }

}
