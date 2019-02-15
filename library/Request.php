<?php

class Request
{

    public static function Get($nome)
    {
        return (isset($_GET[$nome])) ? $_GET[$nome] : (int) basename($_SERVER['REQUEST_URI']);
    }

    public static function GetToken()
    {
        return (isset($_GET['token'])) ? $_GET['token'] : (basename($_SERVER['REQUEST_URI']) != "recoveryPassword") ? basename($_SERVER['REQUEST_URI']) : null;
    }

    public static function Post($nome)
    {
        return (isset($_POST[$nome])) ? $_POST[$nome] : null;
    }

    public static function File($nome)
    {
        return (isset($_FILES[$nome])) ? $_FILES[$nome] : null;
    }

    public static function getSession($nome)
    {
        if (Request::is_session_started() === FALSE)
            session_start();
        return (isset($_SESSION[$nome])) ? $_SESSION[$nome] : null;
    }

    public static function setSession($nome, $value)
    {
        if (Request::is_session_started() === FALSE)
            session_start();
        $_SESSION[$nome] = $value;
    }

    public static function deleteSession($nome)
    {
        if (Request::is_session_started() === FALSE)
            session_start();
        $_SESSION[$nome] = null;
        unset($_SESSION[$nome]);
    }

    public static function validaSession($nome)
    {
        if (Request::is_session_started() === FALSE)
            session_start();
        return isset($_SESSION[$nome]);
    }

    public static function validaPost($nome)
    {
        return isset($_POST[$nome]);
    }

    private static function is_session_started()
    {
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=')) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }
}