<?php

namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;

class MenuCategory extends AbstractHelper
{
    public function __invoke(array $categoriesList, $urlPrefix)
    {
        $html = "";
                        
        foreach ($categoriesList as $category){
            $html .= sprintf('<li class="dropdown"><a href=""><span class="%s"></span> %s</a>', $category['icon'], $category['name']);
            $html .= $this->view->leftLinks($category['itens'], $urlPrefix, null);
            $html .= '</li>' . PHP_EOL;
        }
        
        return $html;
    }
}


