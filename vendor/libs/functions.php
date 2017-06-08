<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 08.06.2017
 * Time: 10:32
 */

/**
 * formats $arr in human readable way
 * @param $arr
 */
function debug($arr) {
    echo '<pre>'. print_r($arr, true) . '</pre>';
}