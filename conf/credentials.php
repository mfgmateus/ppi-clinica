<?php

class Credentials
{
    const SERVER = "mysql";
    const USER = "root";
    const PASS = "password";
    const DATABASE = "CLINICA";

//    const SERVER = "fdb17.awardspace.net";
//    const USER = "2464340_javadoctors";
//    const PASS = "2464340_javadoctors";
//    const DATABASE = "2464340_javadoctors";

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
