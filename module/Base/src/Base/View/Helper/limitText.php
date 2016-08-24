<?php
namespace CVSBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Filter\StripTags;

class limitText extends AbstractHelper
{      
    public function __invoke($value,$size) 
    {
        $filter = new StripTags($value);
        $value = $filter->filter($value);
        
        if (strlen($value) > $size) 
        {
            for ($i = $size; $i <= strlen($value); $i++) 
            {
                if (substr($value, $i, 1) == " ") 
                {
                    return substr($value, 0, $i) . " ...";
                }
            }
            
            return $value;
        } 
        else 
        {
            return $value;
        }
    }
}

