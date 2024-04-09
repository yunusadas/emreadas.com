(function ($) {

    $(document).ready(function () {

        let kisi_id = 0;

        $(".dropdown").click(function () {
            var selectedId = $(this).attr('id');
            $('.eski_sifre').val();
            $('.yeni_sifre').val();
            $('.yeni_sifre_tekrar').val();
            kisi_id = selectedId;
        });

        $('.kisi_duzenle').click(function () {
            let eski_sifre = $('.eski_sifre').val();
            let yeni_sifre = $('.yeni_sifre').val();
            let yeni_sifre_tekrar = $('.yeni_sifre_tekrar').val();


            let giden_veri = {};
            giden_veri["eski_sifre"] = eski_sifre;
            giden_veri["yeni_sifre"] = yeni_sifre;
            giden_veri["yeni_sifre_tekrar"] = yeni_sifre_tekrar;
            giden_veri["kisi_id"] = kisi_id;

            let degerler = {};
            degerler["req"] = "classes\\kisi::kisi_guncelle";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        $('#basarili').show();
                        $('#duzenle_modal').modal('hide');
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                    if (data === false)
                        console.log("İşlem başarısız", "error");
                },
                error: function (data) {
                    console.log("Sunucu hatası",data);
                }
            });

        });

        $('.kisi_ekle').click(function () {
            let kisi_ad = $('.kisi_ad').val();
            let kisi_soyad = $('.kisi_soyad').val();
            let kisi_email = $('.kisi_email').val();
            let kisi_sifre = $('.kisi_sifre').val();
            let kisi_sifre_tekrar = $('.kisi_sifre_tekrar').val();

            let giden_veri = {};
            giden_veri["kisi_ad"] = kisi_ad;
            giden_veri["kisi_soyad"] = kisi_soyad;
            giden_veri["kisi_email"] = kisi_email;
            giden_veri["kisi_sifre"] = kisi_sifre;
            giden_veri["kisi_sifre_tekrar"] = kisi_sifre_tekrar;

            let degerler = {};
            degerler["req"] = "classes\\kisi::kisi_ekle";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        $('#basarili').show();
                        $('#ekle_modal').modal('hide');
                        setTimeout(function () {
                            location.reload();
                        }, 2500);
                    }
                    if (data === false)
                        console.log("İşlem başarısız", "error");
                },
                error: function (data) {
                    console.log("Sunucu hatası",data);
                }
            });
        });

        $('.kisi_sil').click(function () {
            let giden_veri = {};
            giden_veri["kisi_id"] = kisi_id;
            let degerler = {};
            degerler["req"] = "classes\\kisi::kisi_sil";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        $('#basarili').show();
                        setTimeout(function () {
                            $('#sil_modal').modal('hide');
                        }, 500);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                    if (data === false)
                        console.log("İşlem başarısız", "error");
                },
                error: function (data) {
                    console.log("Sunucu hatası", "error");
                }
            });
        });
    });

})(jQuery);