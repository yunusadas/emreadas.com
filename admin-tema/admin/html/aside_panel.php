<?php
$sayfaAdi = basename($_SERVER['PHP_SELF']);
$ayar_active = "";
$kategori_active = "";
$urun_active = "";
switch ($sayfaAdi) {
    case "index.php":
        $sayfaAdi = "Dashboard";
        break;
    case "ayarlar.php":
        $sayfaAdi = "Ayarlar";
        $ayar_active = "active";
        break;
    case "kisi_ayarlari.php":
        $sayfaAdi = "Kisi Ayarlari";
        $ayar_active = "active";
        break;
    case "kategoriler.php":
        $sayfaAdi = "Kategoriler";
        $kategori_active = "active";
        break;
    case "markalar.php":
        $sayfaAdi = "Markalar";
        $marka_active = "active";
        break;
    case "urun_ekle_duzenle.php":
    case "urunler.php":
        $sayfaAdi = "Urunler";
        $urun_active = "active";
        break;

    default:
        $sayfaAdi = "Dashboard";
}
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
              <span class="app-brand-logo demo">
                 <img src="/assets/img/logo/baygun_logo_main.svg" alt="logo">
              </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Yonetim</span>
        </li>

        <li class="menu-item <?php echo $kategori_active; ?>">
            <a href="../kategoriler/kategoriler.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Basic">Kategoriler</div>
            </a>
        </li>
        <li class="menu-item <?php echo $marka_active; ?>">
            <a href="../markalar/markalar.php" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-factory'></i>
                <div data-i18n="Basic">Markalar</div>
            </a>
        </li>
        <li class="menu-item <?php echo $urun_active; ?>">
            <a href="../urunler/urunler.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Basic">Urunler</div>
            </a>
        </li>
        <li class="menu-item <?php echo $ayar_active; ?>">
            <a href="../ayarlar.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Basic">Ayarlar</div>
            </a>
        </li>
        <li class="menu-item <?php echo $ayar_active; ?>">
            <a href="../login/login.php" class="menu-link">
                <?php ?>
                <i class='menu-icon tf-icons bx bx-log-out'></i>
               <form action="">
                    <div data-i18n="Basic">
                        Çıkış Yap
                    </div>
                </form>
            </a>
        </li>
    </ul>
</aside>