<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 08.06.2017
 * Time: 10:10
 */

namespace app\controllers;


use app\helpers\RandomHelper;
use app\helpers\UrlValidator;
use app\models\Main;
use app\views\View;

class MainController
{
    const HASH_LEN = 6;

    public $view;
    public $vars;

    public function actionIndex()
    {
        $title = 'URL Shorter';
        $hash = null;
        $short_url = null;
        $error = '';

        $model = new Main();
        if (!empty($_POST['url'])) {
            if (UrlValidator::validateUrl($_POST['url'])) {
                $hash = $model->findByUrl($_POST['url']);
                if (!$hash) {
                    $hash = RandomHelper::generateRandomString(self::HASH_LEN);
                }
                $short_url = 'http://' . $_SERVER['HTTP_HOST'] . '/?h=' . $hash;
            } else {
                $error = 'Недействительный URL';
            }
        }
        $this->set([
            'title'     => $title,
            'short_url' => $short_url,
            'error'     => $error
        ]);

        $view = new View();
        $view->render(APP . '/views/main/index.php', $this->vars);
    }

    public function viewAction()
    {

    }

    public function set(array $vars)
    {
        $this->vars = $vars;
    }
}