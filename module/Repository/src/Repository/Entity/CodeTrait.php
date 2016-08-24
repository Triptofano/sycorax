<?php

namespace Repository\Entity;

/**
 * Description of Code
 *
 * @author Andre
 */
trait CodeTrait
{

    private $codeTable;

    public function setCodeTable($codeTable)
    {
        $this->codeTable = $codeTable;
    }

}
