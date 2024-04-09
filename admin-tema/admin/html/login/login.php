<?php
if ($_GET['errorcode'] == '2ACF') {
    $hata = '';
    $hata_text = 'Lütfen giriş yapınız.';
} else {
    $hata = 'style="display: none;"';
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
<html
        lang="en"
        class="light-style customizer-hide"
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

    <title>Login Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

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
    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css"/>
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
</head>

<body>
<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                      <span class="app-brand-logo demo">
                        <img src="/assets/img/logo/baygun_logo_main.svg" alt="">
                      </span>
                    </div>
                    <!-- /Logo -->

                    <form id="login" class="mb-3" action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email adresi</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email or username"
                                    autofocus
                            />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Şifre</label>

                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"
                                />
                            </div>
                        </div>
                        <div class="mb-3" <?php echo $hata; ?>>
                            <div id="basarisiz" class="alert alert-danger alert-dismissible" role="alert"
                                 style="width: 300px;">
                                Lütfen giriş yapınız.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit" name="giris">Giriş Yap</button>
                        </div>
                    </form>

                    <a href="/index.php" style="text-align: center;">
                        <p class="icon-name text-capitalize text-truncate mb-0">Anasayfaya dön</p>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
session_start();

use classes\baglanti;
use classes\sifre;

require '../classes/baglanti.php';
require_once '../classes/sifre.php';
error_reporting(E_ALL);
ini_set("display_errors", "On");

if (isset($_POST['giris'])) {
    $email = $_POST['email'];
    $sifre = $_POST['password'];
    if (empty($email) || empty($sifre)) {
        echo json_encode(["durum" => false, "message" => "Lütfen tüm alanları doldurunuz."]);
        exit;
    }
    $db = new baglanti();
    $db = $db->baglanti2();
    $kisi_arr = $db->rawQuery('select * from kisiler where email = ?', array($email));

    if (count($kisi_arr) == 0) {
        echo json_encode(["durum" => false, "message" => "Kullanıcı bulunamadı."]);
        $hata = '';
        $hata_text = 'Kullanıcı bulunamadı.';
        exit;
    }
    $kisi = $kisi_arr[0];

    $kisi["sifre"] = sifre::user_sifre_coz($kisi["sifre"])["sifre"];

    if ($sifre != $kisi["sifre"]) {
        echo json_encode(["durum" => false, "message" => "Şifre hatalı."]);
        $hata = '';
        $hata_text = 'Şifre hatalı.';
        exit;
    }

    $_SESSION['kisi'] = [
        "id" => sifre::sifre_yap($kisi["id"]),
        "ad" => $kisi["ad"],
        "soyad" => $kisi["soyad"],
        "email" => $kisi["email"],
    ];

    $_SESSION['start_time'] = time();
    $_SESSION['expire_time'] = $_SESSION['start_time'] + (30 * 60);


    header('Location: ../urunler/urunler.php');
    echo json_encode(["durum" => true, "message" => "Giriş başarılı."]);
    exit;

} else {
    exit;
}

?>
<script src="../../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../../assets/vendor/libs/popper/popper.js"></script>
<script src="../../assets/vendor/js/bootstrap.js"></script>
<script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../../assets/vendor/js/menu.js"></script>
<script src="../../assets/js/main.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
