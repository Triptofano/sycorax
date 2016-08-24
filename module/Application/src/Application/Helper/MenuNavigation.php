<?php

namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;

class MenuNavigation extends AbstractHelper
{

    public function __invoke(array $menu, $urlPrefix)
    {
        $html = "";

        foreach ($menu as $nav) {
            $html .= '<li class="odd">';
            $html .= '<a class="dropdown-toggle" data-toggle="dropdown" href="#">';
            $html .= '<span class="headmenu-label">' . $nav['name'] . '</span>';
            $html .= '</a>';
            if (isset($nav['links'])) {

                $html .= '<ul class="dropdown-menu">' . PHP_EOL;

                foreach($nav['links'] as $submenu) {
                    foreach ($submenu as $key => $item) {
                        if ($key == 'header')
                            $html .= sprintf("<li class=\"nav-header\">%s</li>\n", $item['name']);
                        else
                            $html .= sprintf("<li><a href=\"%s/%s\">%s</a></li>\n", $urlPrefix, $item['name_link'], $item['name']);
                    }
                }

                $html .= '<ul>' . PHP_EOL;
            }
            $html .= '</li>' . PHP_EOL;
        }

        return $html;
    }

}
