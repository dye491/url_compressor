<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 08.06.2017
 * Time: 10:10
 */

namespace app\controllers;


use app\helpers\HashValidator;
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
                    $model->add($_POST['url'], $hash);
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

    public function actionView()
    {
        if (isset($_GET['h'])) {
            if (HashValidator::validate($_GET['h'])) {
                $model = new Main();
                if ($url = $model->findByHash($_GET['h'])) {
                    header("Location: $url");
                } else {
                    http_response_code(404);
                    echo "Ошибка (#404): Страница не найдена";
                }
            } else {
                echo "Недопустимый символ в параметре h";
            }
        } else {
            http_response_code(400);
            echo "Ошибка (#400):Запрос не содержит параметра h";
        }
    }

    public function set(array $vars)
    {
        $this->vars = $vars;
    }
}