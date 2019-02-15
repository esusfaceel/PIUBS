<?php
ini_set('display_errors', true);

class Configuracao
{

    const NAME_APP = "Saúde";

    const HOST_SERVER = "http://localhost/saude";

    const USER_DATA_BASE = "postgres";

    const PASSWORD_DATA_BASE = "3008";

    const EMAIL = "contato@unifesspa.edu.br";
    
    const EXPORT_ARQUIVO = "C:/wamp64/www/saude/temp/";
    
    const TOKEN = "1ba95abf785c466eb788f55ef18c9092";

    public static function getDns()
    {
        $NAME_DATA_BASE = "saude";
        $HOST_DATA_BASE = "localhost";
        $PORT = "5432";
        
        return "pgsql:dbname=$NAME_DATA_BASE;host=$HOST_DATA_BASE;port=$PORT";
    }
}

?>