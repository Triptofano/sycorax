<?php

namespace Repository\Entity;

/**
 * Description of Category
 *
 * @author Andre
 */
trait CategoryTrait
{
    private $categoryTable;

    public function setCategoryTable($categoryTable)
    {
        $this->categoryTable = $categoryTable;
    }

}
