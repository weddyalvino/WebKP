<?php
class PDOUtil {
    public static function openKoneksi() {
        try {
            $db = "mysql:host=localhost;dbname=gereja";
            $db_handler = new PDO($db, "root", "");
            $db_handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        return $db_handler;
    }

    public static function closeKoneksi() {
        $link = NULL;
    }

}