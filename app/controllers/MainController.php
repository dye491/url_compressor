<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 08.06.2017
 * Time: 10:10
 */

namespace app\controllers;


class MainController
{
    public $view;
    public $vars;

    public function actionIndex()
    {
        if (!empty($_POST['url'])) {

        }
        require APP . '/views/main/index.php';
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }
}