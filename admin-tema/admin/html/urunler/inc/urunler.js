(function ($) {

    $(document).ready(function () {

        let urun_id = 0;

        $(".dropdown").click(function () {
            urun_id = $(this).attr('id');
        });


        $('.urun_duzenle').click(function () {
            window.location.href = "urun_ekle_duzenle.php?urun_id=" + urun_id;
        });

        $('#urun_ekle').click(function () {
            window.location.href = "urun_ekle_duzenle.php";
        });

        $('.urun_sil').click(function () {
            let giden_veri = {};
            giden_veri["urun_id"] = urun_id;
            let degerler = {};
            degerler["req"] = "classes\\urun::urun_sil";
            degerler["array"] = giden_veri;
            $.ajax({
                url: '../classes/ajaxv2.php',
                data: degerler,
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.durum === true) {
                        $('#basarili').show();
                        $('.kapat').click();
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
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



    });

})(jQuery);