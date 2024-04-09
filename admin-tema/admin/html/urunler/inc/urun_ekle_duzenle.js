(function ($) {

    $(document).ready(function () {

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        let urun_id = urlParams.get('urun_id');
        let slider_durum = $('#slider_durum');

        $('#urun_duzenle').on("click", function () {
            let urun_adi = $('#urun_adi').val();
            let urun_seo_keyword = $('#seo_keywords').val();
            let urun_kategori = $('#urun_kategori').val();
            let urun_durum = $('#urun_durum').val();
            let urun_aciklama = $('#urun_aciklama').val();
            let urun_marka = $('#urun_marka').val();
            slider_durum = $('#slider_durum').prop("checked") ? 1 : 0;
            urun_ekle_duzenle(urun_adi, urun_seo_keyword, urun_kategori, urun_durum, urun_aciklama, slider_durum, urun_marka, urun_id);

        });

        $('#yeni_urun_ekle').on("click", function () {
            let urun_adi = $('#urun_adi').val();
            let urun_seo_keyword = $('#seo_keywords').val();
            let urun_kategori = $('#urun_kategori').val();
            let urun_durum = $('#urun_durum').val();
            let urun_aciklama = $('#urun_aciklama').val();
            let urun_marka = $('#urun_marka').val();
            slider_durum = $('#slider_durum').prop("checked") ? 1 : 0;
            urun_ekle_duzenle(urun_adi, urun_seo_keyword, urun_kategori, urun_durum, urun_aciklama, slider_durum,urun_marka );
        });

        function urun_ekle_duzenle(urun_adi, urun_seo_keyword, urun_kategori, urun_durum, urun_aciklama, slider_durum, urun_marka, urun_id = null) {

            let getForm = document.getElementById('urun_resim_form');
            let formData = new FormData(getForm);
            let resim = $('#urun_resim_id').prop('files')[0];
            formData.append('urun_resim', resim);

            let giden_veri = {};
            giden_veri["urun_id"] = urun_id;
            giden_veri["urun_adi"] = urun_adi;
            giden_veri["urun_seo_keyword"] = urun_seo_keyword;
            giden_veri["urun_kategori"] = urun_kategori;
            giden_veri["urun_durum"] = urun_durum;
            giden_veri["urun_aciklama"] = urun_aciklama;
            giden_veri["urun_marka"] = urun_marka;
            giden_veri["slider_durum"] = slider_durum;

            let degerler = {};
            degerler["req"] = "classes\\urun::urun_ekle_duzenle";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        console.log(data.urun_id)
                        if (urun_id === null)
                            formData.append('urun_id', data.urun_id);
                        else
                            formData.append('urun_id', urun_id);
                        $.ajax({
                            url: '../classes/resim_aktar.php',
                            data: formData,
                            type: "POST",
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function (data2) {
                                if (data2.durum === true) {
                                    console.log("Resim başarılı bir şekilde yüklendi");
                                    setTimeout(function () {
                                        window.location.href = "urunler.php";
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


                    } else
                        console.log(data, "error");
                    if (data === false)
                        console.log("İşlem başarısız", "error");
                },
                error: function (data) {
                    console.log("Sunucu hatası", "error");
                }
            });

        }

    });

})(jQuery);