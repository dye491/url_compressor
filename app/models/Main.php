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
        $this->urls = isset($_SESSION['urls']) ? $_SESSION['urls'] : [];
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
        $_SESSION['urls'][$hash] = $url;
    }
}