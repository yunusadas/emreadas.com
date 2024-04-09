<?php

namespace classes;

use classes\marka;

require 'marka.php';


if (isset($_FILES['marka_resim'])) {
    $dosyaAdi = $_FILES['marka_resim']['name'];
    $dosyaYolu = $_FILES['marka_resim']['tmp_name'];
    $dosyaTipi = $_FILES['marka_resim']['type'];
    $dosyaBoyutu = $_FILES['marka_resim']['size'];
    $marka_id = $_POST['marka_id'];

    $veriler = [
        'marka_resmi' => [
            'name' => $dosyaAdi,
            'tmp_name' => $dosyaYolu,
            'type' => $dosyaTipi,
            'size' => $dosyaBoyutu
        ],
        'marka_id' => $marka_id
    ];

    $marka_aktarma = marka::marka_resim_ekle($veriler);

    if($marka_aktarma['durum']){
        echo json_encode($marka_aktarma);
    }else{
        echo $marka_aktarma['message'];
    }

}
?>