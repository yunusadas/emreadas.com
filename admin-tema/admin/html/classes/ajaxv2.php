<?php
/**
 * Yunus Emre Adaş Tarafından oluşturulmuştur.
 * Date     : 18 Mart 2024
 * Time     : 23:12
 * İşlev    : Ajax ve PHP arasında köprü.
 * Açıklama : Ajax request olarak gelen verileri php sınıflarına gönderir.
 */


error_reporting(E_ALL);
ini_set("display_errors", "On");

use classes\kisi;
use classes\kategori;
use classes\urun;
use classes\marka;


require 'kisi.php';
include_once  'kategori.php';
include_once  'urun.php';
include_once 'marka.php';


if (!isset($_POST['req'])) {
    header('400 Bad Request');
    exit;
}

try {
    $req_arr = explode("::", trim($_POST['req']));
    $className = $req_arr[0];
    $funcName = $req_arr[1];
    $info = array();
    if (isset($_POST['data'])) {
        $datas = explode(",", trim($_POST['data']));
        foreach ($datas as $data) {
            $info[] = $data;
        }
    }
    if (isset($_POST['text'])) {
        $info["text"] = $_POST['text'];
    }
    if (isset($_POST['array'])) {
        $info["array"] = $_POST['array'];
    }
    $info["post"] = $_POST;
    $abc = $className::$funcName($info);
    echo json_encode($abc);

} catch (Exception $e) {
    if (empty($e))
        header('404 Not Found');
    else {
        $mesaj = "Sorun oluştu. [ajax-2]";
        error_log('Hata oluştu: ' . $e->getMessage());
        if ($e->getMessage())
            $mesaj = $e->getMessage();
        echo json_encode($mesaj);
        die();
    }
    exit;
}