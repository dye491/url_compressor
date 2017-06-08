<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 08.06.2017
 * Time: 11:08
 */

namespace app\models;


class Main
{
    /**
     * @var array
     */
    public $urls;

    public function __construct()
    {
        if (USE_COOKIE) {
            $this->urls = isset($_COOKIE['urls']) ? unserialize($_COOKIE['urls']) : [];
        }
        if (empty($this->urls)) {
            $this->urls = isset($_SESSION['urls']) ? $_SESSION['urls'] : [];
        }
    }

    public function findByUrl($url)
    {
        return array_search($url, $this->urls);
    }

    public function findByHash($hash)
    {
        return isset($this->urls[$hash]) ? $this->urls[$hash] : false;
    }

    public function add($url, $hash)
    {
        $this->urls[$hash] = $url;
        if (USE_COOKIE) {
            setcookie('urls', serialize($this->urls), time() + COOKIE_LIFETIME);
        }
        $_SESSION['urls'][$hash] = $url;
    }
}