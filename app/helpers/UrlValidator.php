<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 02.06.2017
 * Time: 10:20
 */

namespace app\helpers;


class UrlValidator
{
    /**
     * Checks that $url is real URL, e. g. request to it returns 200 OK
     * @param string $url
     * @return bool
     */
    public static function validateUrl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);

        if (curl_exec($ch) === false) return false;
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($code == 200);
    }
}