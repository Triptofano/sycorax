<?php

namespace Repository\Entity;

/**
 * Description of Code
 *
 * @author Andre
 */
class Code
{
    private $id;
    private $algorithms_id;
    private $linguage;
    private $version;
    private $code;    
    private $createdAt;

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

    public function getLinguage()
    {
        return $this->linguage;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getAlgorithmsId()
    {
        return $this->algorithms;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setLinguage($linguage)
    {
        $this->linguage = $linguage;
        return $this;
    }

    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function setAlgorithmsId($algorithms)
    {
        $this->algorithms = $algorithms;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

}
