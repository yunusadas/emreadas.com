<?php

namespace classes;
use MysqliDb;
$root= str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']));

require_once($_SERVER['DOCUMENT_ROOT'].'\admin-tema\admin\libs\MysqliDB\MysqliDb.php');

class baglanti

{
    public static function baglanti2()
    {
        return new MysqliDb ('localhost', 'root', '112358', 'baygunhirdavat');
    }
}