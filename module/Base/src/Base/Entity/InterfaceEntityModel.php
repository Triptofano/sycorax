<?php
namespace Base\Entity;

define('STATUS_NEW', 0);       
define('STATUS_APPROVED', 1);  
define('STATUS_DELETED', 2);  

interface InterfaceEntityModel
{
    public function exchangeArray($data);
    public function toArray();
}
