<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::config('Configuracao');

class Redirect
{

    protected static function Redirect_To($page)
    {
        // header('Location: ' . $page);
        echo "<script>window.location.href='" . Configuracao::HOST_SERVER . "/" . $page . "';</script>";
    }

    protected static function Redirect_To_For_OnClick($page)
    {
        // header('Location: ' . $page);
        echo "window.location.href='" . Configuracao::HOST_SERVER . "/" . $page . "';";
    }

    public static function Redirect_To_Index()
    {
        Redirect::Redirect_To("index");
    }

    public static function Redirect_To_View($page)
    {
        Redirect::Redirect_To($page);
    }

    public static function Redirect_To_Index_For_OnClick()
    {
        Redirect::Redirect_To_For_OnClick("index");
    }

    public static function Redirect_To_View_For_OnClick($page)
    {
        Redirect::Redirect_To_For_OnClick($page);
    }

    public static function Back($numPage = null)
    {
        if ($numPage == null)
            echo '<script>window.history.back();</script>';
        else
            echo '<script>window.history.go(-' . $numPage . ');</script>';
    }

    public static function BackForOnclick($numPage = null)
    {
        if ($numPage == null)
            echo 'window.history.back();';
        else
            echo 'window.history.go(-' . $numPage . ');';
    }
}