<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::config('Configuracao');
Import::library('Request');
Import::library('Redirect');
Import::entidade('Usuario');

class Security
{

    const ADM = 1;

    const COLABORADOR = 2;

    public static function RECOVERY_PASSWORD()
    {
        if (Request::getSession('recovery') == null) {
            Request::setSession("err", 'Área restrita!');
            Redirect::Redirect_To_View('login');
            return FALSE;
        } else
            return TRUE;
    }

    public static function ADM()
    {
        if (Request::getSession('login') != null) {
            if (Request::getSession('login')->getIdCargo() != self::ADM) {
                Request::setSession("err", 'Usuário sem permissão!');
                Redirect::Redirect_To_Index();
                return FALSE;
            } else
                return TRUE;
        } else {
            Request::setSession("err", 'Usuário não autenticado!');
            Redirect::Redirect_To_View('login');
            return FALSE;
        }
    }

    public static function SelfAndADM($idCriador = NULL)
    {
        if (Request::getSession('login') != null) {
            $idCriador = ($idCriador == NULL) ? Request::Get('id') : $idCriador;
            if (Request::getSession('login')->getId() != $idCriador && Request::getSession('login')->getIdCargo() != self::ADM) {
                Request::setSession("err", 'Usuário sem permissão!');
                Redirect::Back();
                return FALSE;
            } else
                return TRUE;
        } else {
            Request::setSession("err", 'Usuário não autenticado!');
            Redirect::Redirect_To_View('login');
            return FALSE;
        }
    }

    public static function Self($idCriador = NULL)
    {
        if (Request::getSession('login') != null) {
            $idCriador = ($idCriador == NULL) ? Request::Get('id') : $idCriador;
            if (Request::getSession('login')->getId() != $idCriador) {
                Request::setSession("err", 'Usuário sem permissão!');
                Redirect::Back();
                return FALSE;
            } else
                return TRUE;
        } else {
            Request::setSession("err", 'Usuário não autenticado!');
            Redirect::Redirect_To_View('login');
            return FALSE;
        }
    }

    public static function PerfilPermitido(array $array)
    {
        if (Request::getSession('login') != null) {
            $permitido = FALSE;
            foreach ($array as $id) {
                if (Request::getSession('login')->getIdCargo() == $id)
                    $permitido = TRUE;
            }
            if ($permitido == FALSE) {
                Request::setSession("err", 'Usuário sem permissão!');
                Redirect::Back();
                return FALSE;
            } else
                return TRUE;
        } else {
            if (basename($_SERVER['SCRIPT_NAME']) != "index.php")
                Request::setSession("err", 'Usuário não autenticado!');
            Redirect::Redirect_To_View('login');
        }
    }
}