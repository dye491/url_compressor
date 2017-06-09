<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 02.06.2017
 * Time: 10:20
 */

namespace app\helpers;


class Validator
{
    /**
     * Checks that $url is real URL, e. g. request to it returns 200 OK
     * @param string $url
     * @param bool $redirect_url
     * @return bool
     */
    public static function validateUrl($url, $redirect_url = false, &$hash = null)
    {
        if ($redirect_url) {
            $pattern = "#^http\:\/\/{$_SERVER['HTTP_HOST']}\/?\?h\=([A-za-z0-9_\#\@\-]+)$#i";

            $result = preg_match($pattern, $url, $matches);
            if ($result) {
                $hash = $matches[1];
            }

            return $result;
        } else {
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

    /**
     * Checks if $hash matches the pattern
     * @param $hash
     * @return int
     */
    public static function validateHash($hash)
    {
        return preg_match("#^[A-Za-z0-9_\#\@\-]+$#", $hash);
    }
}