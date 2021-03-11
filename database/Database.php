<?php
final class Database{
    private const host = "localhost";
    private const db = "db_exemplo";
    private const user = "root";
    private const password = "root";
    
    public static function connect(){
        try
        {
            $conexao = new PDO("mysql:host=".self::host.";dbname=".self::db,self::user, self::password);
        }
        catch (PDOException $e)
        {
            die("<div>" . $e->getMessage() . "</div>");
        }
        return ($conexao);
    }
}