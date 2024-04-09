<?php

namespace classes;

use classes\urun;

require 'urun.php';


if (isset($_FILES['urun_resim'])) {
    $dosyaAdi = $_FILES['urun_resim']['name'];
    $dosyaYolu = $_FILES['urun_resim']['tmp_name'];
    $dosyaTipi = $_FILES['urun_resim']['type'];
    $dosyaBoyutu = $_FILES['urun_resim']['size'];
    $urun_id = $_POST['urun_id'];

    $veriler = [
        'urun_resmi' => [
            'name' => $dosyaAdi,
            'tmp_name' => $dosyaYolu,
            'type' => $dosyaTipi,
            'size' => $dosyaBoyutu
        ],
        'urun_id' => $urun_id
    ];

    $urun_aktarma = urun::urun_resim_ekle($veriler);

    if($urun_aktarma['durum']){
        echo json_encode($urun_aktarma);
    }else{
        echo $urun_aktarma['message'];
    }

}
?>