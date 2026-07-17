<?php

if (!function_exists('base62_encode')) {
    function base62_encode($num)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($chars);
        $encoded = '';
        do {
            $encoded = $chars[$num % $base] . $encoded;
            $num = (int)($num / $base);
        } while ($num > 0);
        return $encoded;
    }
}

if (!function_exists('base62_decode')) {
    function base62_decode($str)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($chars);
        $decoded = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            $decoded = $decoded * $base + strpos($chars, $str[$i]);
        }
        return $decoded;
    }
}
