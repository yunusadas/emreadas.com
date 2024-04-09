(function ($) {

    $(document).ready(function () {

        let marka_id = 0;

        $(".dropdown").click(function () {

            marka_id = $(this).attr('id');

            let giden_veri = {};
            giden_veri["marka_id"] = marka_id;
            let degerler = {};
            degerler["req"] = "classes\\marka::marka_adi_ver";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        $('.marka_guncelle_ad').val(data.marka_ad);
                        $('.marka_guncelle_durum').val(data.marka_durum);
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

        $('.marka_duzenle').on("click", function () {

            let getForm = document.getElementById('marka_resim_form_duzenle');
            let duzenle_formData = new FormData(getForm);
            let marka_resim_duzenle = $('#marka_resim_duzenle_id').prop('files')[0];
            duzenle_formData.append('marka_resim', marka_resim_duzenle);

            var marka_ad = $('.marka_guncelle_ad').val();
            var marka_durum = $('.marka_guncelle_durum').val();

            let giden_veri = {};
            giden_veri["marka_ad"] = marka_ad;
            giden_veri["marka_durum"] = marka_durum;
            giden_veri["marka_id"] = marka_id;

            duzenle_formData.append('marka_id', marka_id);

            let degerler = {};
            degerler["req"] = "classes\\marka::marka_guncelle";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        $.ajax({
                            url: '../classes/marka_resim_aktar.php',
                            data: duzenle_formData,
                            type: "POST",
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function (data2) {
                                if (data2.durum === true) {
                                    console.log("Resim başarılı bir şekilde yüklendi");
                                    setTimeout(function () {
                                        window.location.href = "./markalar.php";
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

        $('.marka_ekle').on("click", function () {
            let getForm_ekle = document.getElementById('marka_ekle_resim_form');
            let ekle_formData = new FormData(getForm_ekle);
            let marka_resim_ekle = $('#marka_ekle_resim_id').prop('files')[0];
            ekle_formData.append('marka_resim', marka_resim_ekle);

            let marka_ad = $('.marka_ekle_ad').val();
            let marka_durum = $('.marka_ekle_durum').val();


            let giden_veri = {};
            giden_veri["marka_ad"] = marka_ad;
            giden_veri["marka_durum"] = marka_durum;

            let degerler = {};
            degerler["req"] = "classes\\marka::marka_ekle";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        ekle_formData.append('marka_id', data.marka_id);
                        $.ajax({
                            url: '../classes/marka_resim_aktar.php',
                            data: ekle_formData,
                            type: "POST",
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function (data3) {
                                if (data3.durum === true) {
                                    console.log("Resim başarılı bir şekilde yüklendi");
                                    setTimeout(function () {
                                        window.location.href = "./markalar.php";
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

        $('.marka_sil').on("click", function () {
            let giden_veri = {};
            giden_veri["marka_sid"] = marka_id;
            let degerler = {};
            degerler["req"] = "classes\\marka::marka_sil";
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
                            window.location.href = "./markalar.php";
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