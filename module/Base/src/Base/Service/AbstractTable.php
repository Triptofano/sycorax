<?php

namespace Base\Service;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;

class AbstractTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findAll($paginated = false)
    {
        if ($paginated) {
            return new DbSelect(
                    new Select($this->tableGateway->getTable()), $this->tableGateway->getAdapter(), $this->tableGateway->getResultSetPrototype()
            );
        }
        return $this->tableGateway->select();
    }

    public function findById($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function find(array $column)
    {        
        $rowset = $this->tableGateway->select($column);
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row " . key($column) . " and value ". $column[0]);
        }
        return $row;
    }
    
    public function insert($data)
    {
        //$data['id'] = 0;
        $this->tableGateway->insert($data);
        return $this->tableGateway->getLastInsertValue();   
    }

    public function update($data)
    {
        if ($data['id']) {
            return $this->tableGateway->update($data, array('id' => $data['id']));
        } else {
            throw new \Exception('Item id does not exist');
        }
    }

    public function delete($id)
    {
        return $this->tableGateway->delete(array('id' => (int) $id));
    }

}
