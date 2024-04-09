(function ($) {

    $(document).ready(function () {

        let kategori_id = 0;

        $(".dropdown").click(function () {

            kategori_id = $(this).attr('id');
            let giden_veri = {};
            giden_veri["kategori_id"] = kategori_id;
            let degerler = {};
            degerler["req"] = "classes\\kategori::kategori_adi_ver";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        $('.kategori_guncelle_ad').val(data.kategori_ad);
                        $('.kategori_guncelle_durum').val(data.kategori_durum);
                    } else
                        console.log(data, "error");
                    if (data === false)
                        console.log("İşlem başarısız", "error");
                },
                error: function (data) {
                    console.log("Sunucu hatası", "error");
                }
            });
        });

        $('.kategori_duzenle').on("click", function () {

            let getForm = document.getElementById('kategori_resim_form_duzenle');
            let duzenle_formData = new FormData(getForm);
            let kategori_resim_duzenle = $('#kategori_resim_duzenle_id').prop('files')[0];
            duzenle_formData.append('kategori_resim', kategori_resim_duzenle);

            var kategori_ad = $('.kategori_guncelle_ad').val();
            var kategori_durum = $('.kategori_guncelle_durum').val();

            let giden_veri = {};
            giden_veri["kategori_ad"] = kategori_ad;
            giden_veri["kategori_durum"] = kategori_durum;
            giden_veri["kategori_id"] = kategori_id;

            duzenle_formData.append('kategori_id', kategori_id);

            let degerler = {};
            degerler["req"] = "classes\\kategori::kategori_guncelle";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        $.ajax({
                            url: '../classes/kategori_resim_aktar.php',
                            data: duzenle_formData,
                            type: "POST",
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function (data2) {
                                if (data2.durum === true) {
                                    console.log("Resim başarılı bir şekilde yüklendi");
                                    setTimeout(function () {
                                        window.location.href = "./kategoriler.php";
                                    }, 2000);

                                } else
                                    console.log(data2, "error");
                                if (data2 === false)
                                    console.log("İşlem başarısız", "error");
                            },
                            error: function (data2) {
                                console.log("Sunucu hatası", "error");
                            }

                        })
                        $('#basarili').show();
                        $('.kapat').click();
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    } else
                        console.log(data, "error");
                    if (data === false)
                        console.log("İşlem başarısız", "error");
                },
                error: function (data) {
                    console.log("Sunucu hatası", "error");
                }
            });

        });

        $('.kategori_ekle').click(function () {
            let getForm_ekle = document.getElementById('kategori_ekle_resim_form');
            let ekle_formData = new FormData(getForm_ekle);
            let kategori_resim_ekle = $('#kategori_ekle_resim_id').prop('files')[0];
            ekle_formData.append('kategori_resim', kategori_resim_ekle);

            let kategori_ad = $('.kategori_ekle_ad').val();
            let kategori_durum = $('.kategori_ekle_durum').val();


            let giden_veri = {};
            giden_veri["kategori_ad"] = kategori_ad;
            giden_veri["kategori_durum"] = kategori_durum;

            let degerler = {};
            degerler["req"] = "classes\\kategori::kategori_ekle";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        ekle_formData.append('kategori_id', data.kategori_id);
                        $.ajax({
                            url: '../classes/kategori_resim_aktar.php',
                            data: ekle_formData,
                            type: "POST",
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function (data3) {
                                if (data3.durum === true) {
                                    console.log("Resim başarılı bir şekilde yüklendi");
                                    setTimeout(function () {
                                        window.location.href = "./kategoriler.php";
                                    }, 2000);
                                } else
                                    console.log(data3, "error");
                                if (data3 === false)
                                    console.log("İşlem başarısız", "error");
                            },
                            error: function (data2) {
                                console.log("Sunucu hatası", "error");
                            }
                        })

                    } else
                        console.log(data, "error");
                    if (data === false)
                        console.log("İşlem başarısız", "error");
                },
                error: function (data) {
                    console.log("Sunucu hatası", "error");
                }
            });
        });

        $('.kategori_sil').click(function () {
            let giden_veri = {};
            giden_veri["kategori_sid"] = kategori_id;
            let degerler = {};
            degerler["req"] = "classes\\kategori::kategori_sil";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        console.log(data.durum)
                        setTimeout(function () {
                            window.location.href = "./kategoriler.php";
                        }, 2000);
                    } else
                        console.log(data, "error");
                    if (data === false)
                        console.log("İşlem başarısız", "error");
                },
                error: function (data) {
                    console.log("Sunucu hatası", "error", data);
                }
            });
        });
    });

})(jQuery);