<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 07.06.2017
 * Time: 17:30
 */

namespace app\helpers;


class HashValidator
{
    /**
     * Checks if $hash matches the pattern
     * @param $hash
     * @return int
     */
    public static function validate($hash)
    {
        return preg_match('#^[A-Za-z0-9_#@\-]+$#', $hash);
    }
}