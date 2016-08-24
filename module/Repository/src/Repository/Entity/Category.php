<?php

namespace Repository\Entity;

/**
 * Description of Category
 *
 * @author Andre
 */
class Category
{
    private $id;
    private $name;
    
    function __construct()
    {
        
    }
    
    public function exchangeArray($data)
    {
        $methods = get_class_methods($this);
        foreach ($data as $key => $value) {
            $names = explode("_", $key);
            $method = 'set' . ucfirst($names[0]);
            for ($idx = 1; $idx < count($names); $idx++)
                $method .= ucfirst($names[$idx]);

            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function toArray()
    {
        $toArray = array();
        foreach (get_object_vars($this) as $name => $key)
            $toArray[strtolower(preg_replace('/([A-Z]+)/', '_$1', $name))] = $key;

        return $toArray;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}
