<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('Resquest');

class Alert
{

    private static function sucesso($msg)
    {
        echo "<script type='text/javascript'>showToast('Sucesso!<br>" . $msg . " ', 12000, 'green');</script>";
    }

    private static function atencao($msg)
    {
        echo "<script type='text/javascript'>showToast('Atenção!<br>" . $msg . " ', 8000, 'yellow');</script>";
    }

    public static function err($msg)
    {
        echo "<script type='text/javascript'>showToast('Erro!<br>" . $msg . " ', 5000, 'red');</script>";
    }

    public static function showMensage()
    {
        if (Request::getSession("sucesso") != null) {
            self::sucesso(Request::getSession("sucesso"));
            Request::deleteSession("sucesso");
        } elseif (Request::getSession("atencao") != null) {
            self::atencao(Request::getSession("atencao"));
            Request::deleteSession("atencao");
        } elseif (Request::getSession("err") != null) {
            Alert::err(Request::getSession("err"));
            Request::deleteSession("err");
        }
    }
}