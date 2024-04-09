<?php

namespace classes;

use classes\kategori;

require 'kategori.php';


if (isset($_FILES['kategori_resim'])) {
    $dosyaAdi = $_FILES['kategori_resim']['name'];
    $dosyaYolu = $_FILES['kategori_resim']['tmp_name'];
    $dosyaTipi = $_FILES['kategori_resim']['type'];
    $dosyaBoyutu = $_FILES['kategori_resim']['size'];
    $kategori_id = $_POST['kategori_id'];

    $veriler = [
        'kategori_resmi' => [
            'name' => $dosyaAdi,
            'tmp_name' => $dosyaYolu,
            'type' => $dosyaTipi,
            'size' => $dosyaBoyutu
        ],
        'kategori_id' => $kategori_id
    ];

    $kategori_aktarma = kategori::kategori_resim_ekle($veriler);

    if($kategori_aktarma['durum']){
        echo json_encode($kategori_aktarma);
    }else{
        echo $kategori_aktarma['message'];
    }

}
?>