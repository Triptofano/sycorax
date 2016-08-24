<?php

namespace Repository\Service;

use Base\Service\AbstractTable;
use Zend\Db\TableGateway\TableGateway;
use Repository\Entity\Algorithms;

class AlgorithmsTableService extends AbstractTable
{

    public static $tableName = "algorithms";

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
            $entity = new Algorithms();
            $entity->exchangeArray($row->toArray());
            $result[] = $entity;
        }
        return $result;
    }

    public function insert($data)
    {
        $algorithm = new Algorithms();
        
        $algorithm->exchangeArray($data);
        $algorithm->setHash(sha1($algorithm->getTitle()));
        $algorithm->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
        
        parent::insert($algorithm->toArray());
    }

}
