<?php

namespace Repository\Entity;

/**
 * Description of Algorithms
 *
 * @author Andre
 */
class Algorithms
{

    private $id;
    private $hash;
    private $title;
    private $developer;
    private $categoryId;
    private $description;
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

    public function getHash()
    {
        return $this->hash;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDeveloper()
    {
        return $this->developer;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setDeveloper($developer)
    {
        $this->developer = $developer;
        return $this;
    }

    public function setCategoryId($categoryId)
    {
        $this->category_id = (int)$categoryId;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setCreatedAt($createdAt)
    {
        if ($createdAt instanceof \DateTime)
            $this->createdAt = date_format($createdAt, 'Y-m-d H:i:s');
        else
            $this->createdAt = $createdAt;
        
        return $this;
    }

}
