<?php
$datas_tr = [
    "baslik" => "Proje Bilgileri",
    "musteri_dil" => "Firma",
    "kategori" => "Web Tasarım",
    "kategori_dil" => "Kategori",
    "musteri" => "MFA Grup Yapı",
    "tarih_dil"=>"Proje Tarihi",
    "tarih" => "12 Mayıs, 2023",
    "url" => "www.mfagrupyapi.com",
    "url_dil"=>"Proje Linki",
    "aciklama" => "Proje kapsamında website geliştirilmesi 
    ve seo çalışması yapılmıştır. Firmanın kurumsal kimliğine 
    uygun bir tasarım oluşturulmuştur. Dijital pazarlama 
    çalışmaları yapılmıştır. Seo merkezli içerik oluşturma 
    ve arka yüz tasarımları yapılmıştır.",
    "alt_baslik" => "Projede Yapılanlar: ",
];
$datas_en = [
    "baslik" => "Project information",
    "musteri_dil" => "Client",
    "kategori" => "Web design",
    "kategori_dil" => "Category",
    "musteri" => "MFA Grup Yapı",
    "tarih_dil"=>"Project Date",
    "tarih" => "12 May, 2023",
    "url_dil"=>"Project Link",
    "url" => "www.mfagrupyapi.com",
    "aciklama" => "Project scope includes website development and seo work. 
     A design suitable for the corporate identity of the company has been created.
     Digital marketing studies have been carried out. Seo-focused content creation 
     and back-end designs have been made.",
    "alt_baslik" => "What's done in the project: ",
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Portfolio Details - Personal Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<main id="main">

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">
                                <img src="assets/img/portfolio/mfa_1.png" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="assets/img/portfolio/mfa_3.png" alt="">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3><?php echo $datas_tr["baslik"] ?></h3>
                        <ul>
                            <li><strong><?php echo $datas_tr["kategori_dil"] ?>:</strong> <?php echo $datas_tr["kategori"] ?></li>
                            <li><strong><?php echo $datas_tr["musteri_dil"] ?>:</strong> <?php echo $datas_tr["musteri"] ?></li>
                            <li><strong><?php echo $datas_tr["tarih_dil"] ?>:</strong> <?php echo $datas_tr["tarih"] ?></li>
                            <li><strong><?php echo $datas_tr["url_dil"] ?>:</strong> <a target="_blank"
                                                                                        href="https://<?php echo $datas_tr["url"] ?>"><?php echo $datas_tr["url"] ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="portfolio-description">
                        <h2><?php echo $datas_tr["alt_baslik"] ?></h2>
                        <p>
                            <?php echo $datas_tr["aciklama"] ?>
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/typed.js/typed.umd.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>