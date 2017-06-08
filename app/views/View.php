<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 08.06.2017
 * Time: 12:00
 */

namespace app\views;


class View
{
    public function render($file, $vars)
    {
        if (!empty($vars)) extract($vars);
        require $file;
    }
}