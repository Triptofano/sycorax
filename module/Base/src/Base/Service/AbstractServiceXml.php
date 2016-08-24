<?php
namespace Base\Service;

use Doctrine\ORM\EntityManager;

use Zend\Config\Reader\Xml as ReaderXML;
use Zend\Config\Writer\Xml as WriterXML;

abstract class AbstractServiceXml
{
    /**
     * @var EntityManager
     */    
    protected $em;
    
    protected $entity;
    
    public function __construct(EntityManager $em) 
    {
        $this->em = $em;
    }

    public function read($path) 
    {
        $reader = new ReaderXML();
        $data = $reader->fromFile($path);
        
        return $data;
    }
    
    public function write($path, array $data)
    {
        $config = new Zend\Config\Config($data, true);
        
        $writer = new WriterXML();
        $writer->toFile($path, $config);
        #echo $writer->toString($config);die;
    }
}

