<?php

class Credentials
{
    const SERVER = "mysql";
    const USER = "root";
    const PASS = "password";
    const DATABASE = "CLINICA";

    public static function getServer()
    {
        return self::SERVER;
    }

    public static function getUser()
    {
        return self::USER;
    }

    public static function getPass()
    {
        return self::PASS;
    }

    public static function getDatabase()
    {
        return self::DATABASE;
    }
}

?>
