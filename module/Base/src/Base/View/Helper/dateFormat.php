<?php
namespace CVSBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Filter\StripTags;

class dateFormat extends AbstractHelper
{      
    public function __invoke($value) 
    {
        $str = '';
        
        $str .= $value->format('d') . '/' . $value->format('m') .'/'. $value->format('Y');
       
        return $str;
    }
}

