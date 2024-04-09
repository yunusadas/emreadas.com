<?php
namespace urunler;

use classes\kategori;
use classes\urun;
use classes\marka;


require '../classes/urun.php';
require '../classes/kategori.php';
require '../classes/marka.php';

error_reporting(E_ALL);
ini_set("display_errors", "On");

$kategoriler = kategori::kategori_listele();
$markalar = marka::marka_listele();

if (isset($_GET["urun_id"])) {
    $urun = urun::urun_getir($_GET["urun_id"]);
    $button = "Güncelle";
    $button_id = "urun_duzenle";
    $baslik = "Ürün Güncelle";
} else {
    $urun["baslik"] = "";
    $urun["icerik"] = "";
    $urun["durum"] = 0;
    $urun["seo_keyword"] = "";
    $urun["slider_durum"] = 0;
    $kategoriler = kategori::kategori_listele();
    $button = "Ekle";
    $button_id = "yeni_urun_ekle";
    $baslik = "Ürün Ekle";
}
?>


<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->

<?php

?>
<html
        lang="en"
        class="light-style layout-menu-fixed"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="../assets/"
        data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Tables - Basic Tables | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="../../assets/css/demo.css"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"/>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
</head>

<body>
<style>
    #ck_container {
        height: 200px;
        margin: 20px auto;
    }

    .ck-editor__editable[role="textbox"] {
        /* Editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* Block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php require '../aside_panel.php'; ?>
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span
                                class="text-muted fw-light">Ürünler /</span> <?php echo $baslik; ?></h4>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <h5 class="card-header"><?php echo $baslik; ?></h5>
                                <div class="card-body">

                                    <div class="mb-3">
                                        <label for="urun_adi" class="form-label">Urun Adi</label>
                                        <input
                                                type="text"
                                                value="<?php echo $urun["baslik"] ?>"
                                                class="form-control"
                                                id="urun_adi"
                                                placeholder="Or: bosch tornavida"
                                                aria-describedby="defaultFormControlHelp"
                                        />
                                        <div id="urun_adi_uyari" class="form-text">
                                            Lütfen bir ürün adı giriniz.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="seo_keywords" class="form-label">Seo Anahtar Kelimeler</label>
                                        <input
                                                type="text"
                                                class="form-control"
                                                id="seo_keywords"
                                                value="<?php echo $urun["seo_keyword"] ?>"
                                                placeholder="Or: havya makinesi, havya, makinesi"
                                                aria-describedby="defaultFormControlHelp"
                                        />
                                        <div id="urun_adi_uyari" class="form-text">
                                            Lütfen anahtar kelime giriniz.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="urun_kategori" class="form-label">Urun Kategorisi</label>
                                        <select class="form-select" id="urun_kategori"
                                                aria-label="Default select example">
                                            <option value="0" selected>Seçiniz</option>
                                            <?php
                                            foreach ($kategoriler as $kategori) {
                                                echo "<option value='" . $kategori["id"] . "' " . ($kategori["id"] == $urun["kategori_id"] ? "selected" : "") . ">" . $kategori["kategori_adi"] . "</option>";

                                            }
                                            ?>
                                        </select>
                                        <div id="urun_kategori_uyari" class="form-text">
                                            Lütfen kategori seçiniz.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="urun_marka" class="form-label">Urun Markası</label>
                                        <select class="form-select" id="urun_marka"
                                                aria-label="Default select example">
                                            <option value="0" selected>Seçiniz</option>
                                            <?php
                                            foreach ($markalar as $marka) {
                                                echo "<option value='" . $marka["id"] . "' " . ($marka["id"] == $urun["marka_id"] ? "selected" : "") . ">" . $marka["marka_adi"] . "</option>";

                                            }
                                            ?>
                                        </select>
                                        <div id="urun_marka_uyari" class="form-text">
                                            Lütfen marka seçiniz.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="urun_durum" class="form-label">Urun Durumu</label>
                                        <select class="form-select" id="urun_durum" aria-label="Default select example">
                                            <option value="0" selected>Seçiniz</option>
                                            <option <?php if ($urun["durum"] == 1) {
                                                echo "selected";
                                            } ?> value="1">Aktif
                                            </option>
                                            <option <?php if ($urun["durum"] == 2) {
                                                echo "selected";
                                            } ?> value="2">Pasif
                                            </option>
                                        </select>
                                        <div id="urun_kategori_uyari" class="form-text">
                                            Lütfen urun durumu seçiniz.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="urun_aciklama" class="form-label">Urun Açıklaması</label>
                                        <textarea placeholder="Or: Urun detayları bu şekildedir." class="form-control"
                                                  style="height:300px;" id="urun_aciklama"
                                                  rows="3"><?php echo $urun["icerik"] ?></textarea>
                                        <div id="urun_kategori_uyari" class="form-text">
                                            Lütfen açıklama giriniz.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <form id="urun_resim_form" method="post" enctype="multipart/form-data">
                                            <label for="inputGroupFileAddon03" class="form-label">Urun Görseli</label>
                                            <div class="input-group">
                                                <input id="urun_resim_id" accept="image/png, image/jpeg, image/jpg"
                                                       name="urun_resim" type="file" class="form-control"
                                                       aria-describedby="inputGroupFileAddon03" aria-label="Upload"/>
                                            </div>
                                            <div id="urun_resim_uyari" class="form-text">
                                                Lütfen resim giriniz ve boyutları 690x808 ayarlayınız.
                                            </div>
                                        </form>
                                    </div>
                                    <hr class="my-4"/>
                                    <div class="mb-3">
                                        <label for="slider_durum" class="form-label">Slider Durumu</label>
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox" <?php if ($urun["slider_durum"] == 1) {
                                                echo "checked";
                                            } ?> value="1" id="slider_durum">
                                            <label for="slider_durum" class="">Slider'da göster</label>
                                        </div>
                                    </div>

                                    <!--<div class="mb-3" id="ck_container">
                                        <div id="editor"></div>
                                    </div>
                                    <br> <br> <br>
                                    -->
                                    <br>
                                    <div class="mb-3">
                                        <button class="btn rounded-pill btn-primary"
                                                id="<?php echo $button_id ?>"
                                                style="width: 150px; position: absolute; bottom: 20px;right: 60px;"><?php echo $button ?>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5"/>
                </div>
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                    </div>
                </footer>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="../../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../../assets/vendor/libs/popper/popper.js"></script>
<script src="../../assets/vendor/js/bootstrap.js"></script>
<script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../../assets/vendor/js/menu.js"></script>
<!-- endbuild -->
<!-- Main JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="inc/urun_ekle_duzenle.js"></script>
<script src="../../assets/js/main.js"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!--<script
        src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js">
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ))
        .catch( error => {
            console.error( error );
        } );
TODO BURASI CKEDITOR KISMI
</script>-->
</body>
</html>
