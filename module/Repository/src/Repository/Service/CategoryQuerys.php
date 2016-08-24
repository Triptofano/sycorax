<?php

namespace Api\Service;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate\In;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class CategoryQuerys
{
    protected $sql;

    public function __construct(Sql $sql)
    {
        $this->sql = $sql;
    }

    public function searchRegions($id, $typeRegion)
    {
        $select = $this->sql->select()
                ->columns('algorithms')
                ->from('table_cities')
                ->where(array($arrayRegionsID[$typeRegion] => $id));

        $selectString = $this->sql->buildSqlString($select);
        $adapter = $this->sql->getAdapter();
        $resultSet = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        $uniqueIDs = array();
        foreach ($resultSet as $row) {
            $uniqueIDs = array_merge($uniqueIDs, array_values((array) $row));
        }
        $uniqueIDs = array_unique($uniqueIDs);
        return $uniqueIDs;
    }

    public function getCategoryWithAlgorithms(array $values)
    {
        $select = $this->sql->select()
                ->columns(array('ids' => 'fkQuestionID'))
                ->from('algorithms')
                ->join(array('c' => 'category'), 'algorithms.category_id = c.id')
                ;

        $selectString = $this->sql->buildSqlString($select);
        $adapter = $this->sql->getAdapter();
        $resultSet = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        $questionIDs = array();
        foreach ($resultSet as $row) {
            $questionIDs = array_merge($questionIDs, array_values((array) $row));
        }
        $questionIDs = array_unique($questionIDs);

        return $questionIDs;
    }
    
}
