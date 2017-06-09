<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 02.06.2017
 * Time: 10:06
 */

namespace app\helpers;


class RandomHelper
{
    public static function generateRandomString($length)
    {
        $seed = str_split(
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            'abcdefghijklmnopqrstuvwxyz' .
            '0123456789_-$@'
        );
        shuffle($seed);
        $rand = '';
        foreach (array_rand($seed, $length) as $key) {
            $rand .= $seed[$key];
        }

        return $rand;
    }
}