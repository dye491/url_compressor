<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 08.06.2017
 * Time: 10:10
 */

namespace app\controllers;

use app\helpers\RandomHelper;
use app\helpers\Validator;
use app\models\Main;
use app\views\View;

class MainController
{
    const HASH_LEN = 6;

    public $view;
    public $vars;

    public function actionIndex()
    {
        $title = 'URL Compressor';
        $hash = null;
        $redirect_url = null;
        $error = '';
        $csrf_token = isset($_SESSION['csrf']) ? $_SESSION['csrf'] : RandomHelper::generateCsrfToken();

        $model = new Main();
        if (!empty($_POST['url'])) {
            $url = htmlspecialchars($_POST['url']);
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $csrf_token) {
                $error = 'Неверный проверочный код';
                echo $error;
                return;
            }
            if (Validator::validateUrl($url)) {
                if (!empty($_POST['redirect_url'])) {
                    $redirect_url = htmlspecialchars($_POST['redirect_url']);
                    if (Validator::validateRedirectUrl($redirect_url, $hash)) {
                        if ($key = $model->findByUrl($url)) {
                            unset($model->urls[$key]);
                        }
                        $model->add($url, $hash);
                        echo $redirect_url;
                    } else {
                        http_response_code(400);
                        $error = 'Недействительный redirect URL';
                        echo $error;
                    }
                    return;
                }
                $hash = $model->findByUrl($url);
                if (!$hash) {
                    $hash = RandomHelper::generateRandomString(self::HASH_LEN);
                    $model->add($url, $hash);
                }
                $redirect_url = 'http://' . $_SERVER['HTTP_HOST'] . '/?h=' . $hash;
                echo $redirect_url;
            } else {
                http_response_code(400);
                $error = 'Недействительный URL';
                echo $error;
            }
            return;
        }
        $this->set([
            'title'        => $title,
            'redirect_url' => $redirect_url,
            'error'        => $error,
            'csrf_token'   => $csrf_token,
        ]);

        $this->view = new View();
        $this->view->render(APP . '/views/main/index.php', $this->vars);
    }

    public function actionView()
    {
        if (isset($_GET['h'])) {
            $h = htmlspecialchars($_GET['h']);
            if (Validator::validateHash($h)) {
                $model = new Main();
                if ($url = $model->findByHash($h)) {
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