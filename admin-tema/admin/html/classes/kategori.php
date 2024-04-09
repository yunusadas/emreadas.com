<?php

namespace classes;

use classes\sifre;

use Exception;

include_once 'baglanti.php';
include_once 'sifre.php';

class kategori
{

    public static function kategori_listele()
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $kategori_arr = $db->rawQuery('select * from kategoriler');

            $datas = array();
            foreach ($kategori_arr as $kategori) {
                if ($kategori["durum"] == 1) {
                    $kategori["durum"] = "Aktif";
                } else {
                    $kategori["durum"] = "Pasif";
                }
                $datas[] = [
                    "id" => sifre::sifre_yap($kategori["id"]),
                    "kategori_adi" => $kategori["baslik"],
                    "kategori_durum" => $kategori["durum"],
                ];
            }
            $db->disconnectAll();
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kişiler listelenemedi"];
        }
    }

    public static function kategori_ekle($veriler)
    {
        try {
            $girdiler = $veriler["array"];
            $kategori_ad = $girdiler["kategori_ad"];
            $kategori_durum = $girdiler["kategori_durum"];

            $db = new baglanti();
            $db = $db->baglanti2();

            $sonuc = $db->insert('kategoriler', [
                'baslik' => $kategori_ad,
                'durum' => $kategori_durum,
            ]);

            $kategori_id = $db->getInsertId();
            $kategori_id = sifre::sifre_yap($kategori_id);
            if ($sonuc) {
                $db->disconnectAll();
                return ["durum" => true, "message" => "Kategori eklendi", "kategori_id" => $kategori_id];

            } else {
                return ["durum" => false, "message" => "Kategori eklenemedi"];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kategori eklenemedi"];
        }
    }

    public static function kategori_guncelle($veriler)
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $girdiler = $veriler["array"];
            $sid = $girdiler["kategori_id"];
            $id = sifre::sifre_coz($sid);
            $kategori_ad = $girdiler["kategori_ad"];
            $kategori_durum = $girdiler["kategori_durum"];

            $kategori_resim = $db->rawQuery('SELECT resim_url FROM kategoriler WHERE id = ?', array($id))[0];
            $kategori_resim = str_replace("/", "\\", $kategori_resim);

            $kategori_resim_path = $_SERVER['DOCUMENT_ROOT'] . "\\" . $kategori_resim["resim_url"];

            if (file_exists($kategori_resim_path)) {
               unlink($kategori_resim_path);

            }
            $sonuc = $db->where('id', $id)->update('kategoriler', [
                'baslik' => $kategori_ad,
                'durum' => $kategori_durum
            ]);

            if ($sonuc) {
                $db->disconnectAll();
                return ["durum" => true, "message" => "Kategori güncellendi"];
            } else {
                return ["durum" => false, "message" => "Kategori güncellenemedi"];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kategori güncellenemedi"];
        }
    }

    public static function kategori_sil($veriler)
    {
        $db = new \classes\baglanti();
        $db = $db->baglanti2();

        $girdiler = $veriler["array"];

        if (is_null($girdiler)) {
            return ["durum" => false, "message" => "Lütfen kategori seçiniz!"];
        }

        $sid = $girdiler["kategori_sid"];
        $id = sifre::sifre_coz($sid);

        try {
            /*TODO urunler tablosu yapıldığı zaman aktif edilecek!*/
            /*$urun_varmi = $db->rawQuery('SELECT * FROM urunler WHERE kategori_id = ?', array($id));

            if($urun_varmi){
                return ["durum" => false, "message" => "Bu kategoriye ait ürünler bulunmaktadır. Kategori silinemedi."];
            }*/
            $kategori_resim = $db->rawQuery('SELECT resim_url FROM kategoriler WHERE id = ?', array($id))[0];
            $kategori_resim = str_replace("/", "\\", $kategori_resim);
            $sonuc = $db->where('id', $id)->delete('kategoriler');
            $kategori_resim_path = $_SERVER['DOCUMENT_ROOT'] . "\\" . $kategori_resim["resim_url"];
            if ($sonuc) {
                if (file_exists($kategori_resim_path)) {
                    if (unlink($kategori_resim_path)) {
                        $db->disconnectAll();
                        return ["durum" => true, "message" => "Kategori silindi."];
                    } else {
                        return ["durum" => false, "message" => "Kategori resmi silinemedi."];}
                } else {
                    $db->disconnectAll();
                    return ["durum" => true, "message" => "Kategori silindi. Fakat resim bulunamadığı için silinemedi."];
                }
            } else {
                return ["durum" => false, "message" => "Kategori silinemedi."];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kategori silinirken bir hata meydana geldi."];
        }
    }

    public static function kategori_adi_ver($veriler)
    {
        try {
            $db = new \classes\baglanti();
            $db = $db->baglanti2();

            $girdiler = $veriler["array"];
            $sid = $girdiler["kategori_id"];
            $id = sifre::sifre_coz($sid);

            $kategori_arr = $db->rawQuery('SELECT baslik,durum FROM kategoriler WHERE id = ?', array($id))[0];

            $kategori_adi = $kategori_arr["baslik"];
            $kategori_durum = $kategori_arr["durum"];
            if ($kategori_adi) {
                $db->disconnectAll();
                return ["durum" => true, "kategori_ad" => $kategori_adi, "kategori_durum" => $kategori_durum];
            }else{
                return ["durum" => false, "message" => "Kategori adı alınamadı"];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kategori adı alınamadı"];
        }
    }

    public static function kategori_detay_listele()
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $kategori_arr = $db->rawQuery('select * from kategoriler order by sira_no');

            $datas = array();
            foreach ($kategori_arr as $kategori) {
                $datas[] = [
                    "id" => sifre::sifre_yap($kategori["id"]),
                    "kategori_adi" => $kategori["baslik"],
                    "kategori_durum" => $kategori["durum"],
                    "resim_url" => $kategori["resim_url"],
                ];
            }
            $db->disconnectAll();
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kategoriler listelenemedi"];
        }
    }

    public static function kategori_footer_ad_ver(){
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $kategori_arr = $db->rawQuery('select * from kategoriler order by sira_no limit 4');

            $datas = array();
            foreach ($kategori_arr as $kategori) {
                $datas[] = [
                    "id" => sifre::sifre_yap($kategori["id"]),
                    "kategori_adi" => $kategori["baslik"],
                    "kategori_durum" => $kategori["durum"],
                ];
            }
            $db->disconnectAll();
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kategoriler listelenemedi"];
        }
    }

    public static function kategori_resim_ekle($veriler)
    {
        $dosyaAdi = sifre::turk_to_eng_bosluksuz($veriler['kategori_resmi']['name']);
        $dosyaAdi = mb_strtolower($dosyaAdi);
        $dosyaYolu = $veriler['kategori_resmi']['tmp_name'];
        $dosyaTipi = $veriler['kategori_resmi']['type'];
        $dosyaBoyutu = $veriler['kategori_resmi']['size'];
        $kategori_id = sifre::sifre_coz($veriler['kategori_id']);


        move_uploaded_file($dosyaYolu, $_SERVER['DOCUMENT_ROOT'] . "\admin-tema\admin\assets\img\kategoriler\\" . $dosyaAdi);
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $db->where('id', $kategori_id);
            $update = $db->update('kategoriler', [
                'resim_url' => "admin-tema/admin/assets/img/kategoriler/" . $dosyaAdi
            ]);
            if ($update) {
                $db->disconnectAll();
                return ["durum" => true, "message" => "Resim eklendi."];
            } else
                return ["durum" => false, "message" => "Resim eklenemedi."];
        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Resim eklenirken hata oluştu."];
        }

    }


}