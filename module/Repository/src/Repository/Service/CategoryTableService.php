<?php

namespace Repository\Service;

use Base\Service\AbstractTable;
use Zend\Db\TableGateway\TableGateway;
use Repository\Entity\Category;

class CategoryTableService extends AbstractTable
{
    public static $tableName = "category";
    
    public function getTableName()
    {
        return self::$tableName;
    }
    
    public function __construct(TableGateway $tableGateway)
    {
        parent::__construct($tableGateway);
    }

    public function findAll()
    {
        $result = array();
        foreach (parent::findAll() as $row) {
            $entity = new Category();
            $entity->exchangeArray($row->toArray());
            $result[] = $entity;
        }
        return $result;
    }

    public function insert($data)
    {
        $category = new Category();
        $category->exchangeArray($data);
        
        parent::insert($category->toArray());
    }
    
    public function update($data)
    {
        $category = new Category();
        $category->exchangeArray($data);
        
        parent::update($category->toArray());
    }

}
