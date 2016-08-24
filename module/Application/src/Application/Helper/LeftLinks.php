<?php

namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;

class LeftLinks extends AbstractHelper
{

    public function __invoke(array $values, $urlPrefix, $style)
    {
        $html = '';

        if ($style) {
            $html .= '<ul ';
            foreach ($style as $params) {
                $html .= $params . ' ';
            }
            $html .= PHP_EOL;
        } else {
            $html .= '<ul style="list-style-type:none;">' . PHP_EOL;
        }

        foreach ($values as $item) {
            $html .= sprintf("<li><a href=\"%s/%s\">%s</a></li>\n", $urlPrefix, $item['name_link'], $item['name']);
        }

        $html .= '</ul>' . PHP_EOL;

        return $html;
    }

}
