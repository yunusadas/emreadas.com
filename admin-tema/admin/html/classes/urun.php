<?php

namespace classes;

use classes\sifre;

use Exception;

include_once 'baglanti.php';
include_once 'sifre.php';

class urun
{

    public static function urun_listele()
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $kategori_arr = $db->rawQuery('select id,baslik from kategoriler');
            $urun_arr = $db->rawQuery('select * from urunler');
            $datas = array();
            foreach ($urun_arr as $urun) {
                if ($urun["durum"] == 1) {
                    $urun["durum"] = "Aktif";
                } else {
                    $urun["durum"] = "Pasif";
                }
                $kat_adi = "";
                foreach ($kategori_arr as $kategori) {
                    if ($kategori["id"] == $urun["kategori_id"]) {
                        $kat_adi = $kategori["baslik"];
                        break;
                    }
                }
                $datas[] = [
                    "id" => sifre::sifre_yap($urun["id"]),
                    "urun_adi" => $urun["baslik"],
                    "kat_adi" => $kat_adi,
                    "urun_durum" => $urun["durum"],
                    "urun_aciklama" => $urun["icerik"],
                    "urun_seo_keywords" => $urun["seo_keyword"],
                    "resim_url" => $urun["resim_url"],
                    "urun_url" => $urun["urun_url"]
                ];
            }
            $db->disconnectAll();
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kişiler listelenemedi"];
        }
    }

    public static function slider_listele()
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $kategori_arr = $db->rawQuery('select id,baslik from kategoriler');
            $urun_arr = $db->rawQuery('select * from urunler where slider_durum = 1 order by id desc');
            $datas = array();
            foreach ($urun_arr as $urun) {
                if ($urun["durum"] == 1) {
                    $urun["durum"] = "Aktif";
                } else {
                    $urun["durum"] = "Pasif";
                }
                $kat_adi = "";
                foreach ($kategori_arr as $kategori) {
                    if ($kategori["id"] == $urun["kategori_id"]) {
                        $kat_adi = $kategori["baslik"];
                        break;
                    }
                }
                $datas[] = [
                    "id" => sifre::sifre_yap($urun["id"]),
                    "urun_adi" => $urun["baslik"],
                    "kat_adi" => $kat_adi,
                    "urun_durum" => $urun["durum"],
                    "urun_aciklama" => $urun["icerik"],
                    "urun_seo_keywords" => $urun["seo_keyword"],
                    "resim_url" => $urun["resim_url"],
                    "urun_url" => $urun["urun_url"]
                ];
            }
            $db->disconnectAll();
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Ürünler listelenemedi"];
        }
    }

    public static function urun_ekle_duzenle($veriler)
    {
        $db = new baglanti();
        $db = $db->baglanti2();
        $girdiler = $veriler["array"];
        $urun_adi = $girdiler["urun_adi"];
        $urun_kategori = sifre::sifre_coz($girdiler["urun_kategori"]);
        $urun_durum = $girdiler["urun_durum"];
        $urun_aciklama = $girdiler["urun_aciklama"];
        $urun_seo_keywords = $girdiler["urun_seo_keyword"];
        $urun_temiz = sifre::turk_to_eng_bosluksuz($urun_adi);
        $urun_url = mb_strtolower($urun_temiz);
        $slider_durum = $girdiler["slider_durum"];
        $urun_marka = sifre::sifre_coz($girdiler["urun_marka"]);

        if ($girdiler["urun_id"])
            $id = sifre::sifre_coz($girdiler["urun_id"]);
        if (is_null($urun_adi) or $urun_adi == "")
            return ["durum" => false, "message" => "Lütfen ürün adı giriniz!"];
        if (is_null($urun_kategori) or $urun_kategori == "Seçiniz")
            return ["durum" => false, "message" => "Lütfen kategori seçiniz!"];
        if (is_null($urun_durum) or $urun_durum == "Seçiniz")
            return ["durum" => false, "message" => "Lütfen durum seçiniz!"];
        if (is_null($urun_aciklama) or $urun_aciklama == "")
            return ["durum" => false, "message" => "Lütfen açıklama giriniz!"];
        if (is_null($urun_marka) or $urun_marka == "Seçiniz")
            return ["durum" => false, "message" => "Lütfen marka seçiniz!"];


        try {
            if ($girdiler["urun_id"]) {
                $urun_resim = $db->rawQuery('SELECT resim_url FROM urunler WHERE id = ?', array($id))[0];
                $urun_resim = str_replace("/", "\\", $urun_resim);
                $urun_resim_path = $_SERVER['DOCUMENT_ROOT'] . "\\" . $urun_resim["resim_url"];

                if (file_exists($urun_resim_path)) {
                    unlink($urun_resim_path);
                }
                $db->where('id', $id);
                $update = $db->update('urunler', [
                    'baslik' => $urun_adi,
                    'kategori_id' => $urun_kategori,
                    'durum' => $urun_durum,
                    'icerik' => $urun_aciklama,
                    'seo_keyword' => $urun_seo_keywords,
                    'resim_url' => 'test',
                    'urun_url' => $urun_url,
                    'slider_durum' => $slider_durum,
                    'marka_id' => $urun_marka
                ]);
                if ($update) {
                    $db->disconnectAll();
                    return ["durum" => true, "message" => "Ürün güncellendi."];
                } else
                    return ["durum" => false, "message" => "Ürün güncellenemedi."];
            } else {
                $insert = $db->insert('urunler', [
                    'baslik' => $urun_adi,
                    'kategori_id' => $urun_kategori,
                    'durum' => $urun_durum,
                    'icerik' => $urun_aciklama,
                    'seo_keyword' => $urun_seo_keywords,
                    'resim_url' => 'test',
                    'urun_url' => $urun_url,
                    'slider_durum' => $slider_durum,
                    'marka_id' => $urun_marka
                ]);
                if ($insert) {
                    $urun_yeni_id = $db->getInsertId();
                    $db->disconnectAll();
                    return ["durum" => true, "message" => "Ürün eklendi.", "urun_id" => sifre::sifre_yap($urun_yeni_id)];
                } else
                    return ["durum" => false, "message" => "Ürün eklenemedi."];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Ürün eklenirken hata oluştu."];
        }
    }

    public static function urun_sil($veriler)
    {

        $db = new baglanti();
        $db = $db->baglanti2();

        $girdiler = $veriler["array"];
        if ($girdiler["urun_id"] == "" or $girdiler["urun_id"] == null)
            return ["durum" => false, "message" => "Lütfen ürün seçiniz!"];

        $id = sifre::sifre_coz($girdiler["urun_id"]);
        try {
            $urun_resim = $db->rawQuery('SELECT resim_url FROM urunler WHERE id = ?', array($id))[0];
            $urun_resim = str_replace("/", "\\", $urun_resim);
            $urun_resim_path = $_SERVER['DOCUMENT_ROOT'] . "\\" . $urun_resim["resim_url"];
            $db->where('id', $id);
            $sil = $db->delete('urunler');

            if ($sil) {
                if (unlink($urun_resim_path)) {
                    $db->disconnectAll();
                    return ["durum" => true, "message" => "Ürün ve resim silindi."];
                }
            } else
                return ["durum" => false, "message" => "Ürün silinemedi."];
        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Ürün silinirken hata oluştu."];
        }


    }

    public static function urun_getir($sid)
    {
        $db = new baglanti();
        $db = $db->baglanti2();
        if ($sid == "" or $sid == null)
            return ["durum" => false, "message" => "Lütfen ürün seçiniz!"];
        try {
            $id = sifre::sifre_coz($sid);
            $urun = $db->rawQuery('select * from urunler where id = ?', array($id))[0];
            $urun["id"] = sifre::sifre_yap($urun["id"]);
            $urun["kategori_id"] = sifre::sifre_yap($urun["kategori_id"]);
            $urun["marka_id"] = sifre::sifre_yap($urun["marka_id"]);
            $db->disconnectAll();
            return $urun;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Ürün getirilemedi."];
        }
    }

    public static function urun_resim_ekle($veriler)
    {
        $dosyaAdi = sifre::turk_to_eng_bosluksuz($veriler['urun_resmi']['name']);
        $dosyaAdi = mb_strtolower($dosyaAdi);
        $dosyaYolu = $veriler['urun_resmi']['tmp_name'];
        $urun_id = sifre::sifre_coz($veriler['urun_id']);


        move_uploaded_file($dosyaYolu, $_SERVER['DOCUMENT_ROOT'] . "\admin-tema\admin\assets\img\urunler\\" . $dosyaAdi);
        $err = error_get_last();

        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $db->where('id', $urun_id);
            $update = $db->update('urunler', [
                'resim_url' => "admin-tema/admin/assets/img/urunler/" . $dosyaAdi
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

    public static function urunler_urun_listele($urun_id = null)
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $kategori_arr = $db->rawQuery('select id,baslik from kategoriler');
            $urun_arr = $db->rawQuery('select * from urunler limit 10');
            $datas = array();
            foreach ($urun_arr as $urun) {
                $kat_adi = "";
                foreach ($kategori_arr as $kategori) {
                    if ($kategori["id"] == $urun["kategori_id"]) {
                        $kat_adi = $kategori["baslik"];
                        break;
                    }
                }
                $datas[] = [
                    "id" => sifre::sifre_yap($urun["id"]),
                    "urun_adi" => $urun["baslik"],
                    "urun_durum" => $urun["durum"],
                    "urun_url" => $urun["urun_url"],
                    "urun_aciklama" => $urun["icerik"],
                    "kat_adi" => $kat_adi,
                    "urun_seo_keywords" => $urun["seo_keyword"],
                    "resim_url" => $urun["resim_url"]
                ];
            }
            $db->disconnectAll();
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Ürünler listelenemedi"];
        }
    }

    public static function urun_detay_listele($urun_url)
    {
        $db = new baglanti();
        $db = $db->baglanti2();
        try {
            $kategori_arr = $db->rawQuery('select id,baslik from kategoriler');
            $urun_arr = $db->rawQuery('select * from urunler where urun_url = ?', array($urun_url));
            $datas = array();
            foreach ($urun_arr as $urun) {
                $kat_adi = "";
                foreach ($kategori_arr as $kategori) {
                    if ($kategori["id"] == $urun["kategori_id"]) {
                        $kat_adi = $kategori["baslik"];
                        break;
                    }
                }
                $datas[] = [
                    "id" => sifre::sifre_yap($urun["id"]),
                    "urun_adi" => $urun["baslik"],
                    "urun_durum" => $urun["durum"],
                    "urun_url" => $urun["urun_url"],
                    "urun_aciklama" => $urun["icerik"],
                    "kat_adi" => $kat_adi,
                    "urun_seo_keywords" => $urun["seo_keyword"],
                    "resim_url" => $urun["resim_url"]
                ];
            }
            $db->disconnectAll();
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Ürünler listelenemedi"];
        }
    }

    public static function kategoriye_gore_urun_listele($kat_sid)
    {
        $db = new baglanti();
        $db = $db->baglanti2();
        if (is_null($kat_sid))
            return ["durum" => false, "message" => "Kategori seçiniz!"];

        $kat_id = sifre::sifre_coz($kat_sid);
        try {
            $kategori_arr = $db->rawQuery('select id,baslik from kategoriler');
            $urun_arr = $db->rawQuery('select * from urunler where durum = 1 and kategori_id = ?', array($kat_id));
            $datas = array();
            foreach ($urun_arr as $urun) {
                $kat_adi = "";
                foreach ($kategori_arr as $kategori) {
                    if ($kategori["id"] == $urun["kategori_id"]) {
                        $kat_adi = $kategori["baslik"];
                        break;
                    }
                }
                $datas[] = [
                    "id" => sifre::sifre_yap($urun["id"]),
                    "urun_adi" => $urun["baslik"],
                    "urun_url" => $urun["urun_url"],
                    "kat_adi" => $kat_adi,
                    "resim_url" => $urun["resim_url"]
                ];
            }
            $db->disconnectAll();
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Ürünler listelenemedi"];
        }
    }

    public static function markaya_gore_urun_listele($marka_sid)
    {
        $db = new baglanti();
        $db = $db->baglanti2();
        if (is_null($marka_sid))
            return ["durum" => false, "message" => "Marka seçiniz!"];

        $marka_id = sifre::sifre_coz($marka_sid);
        try {
            $marka_arr = $db->rawQuery('select id,baslik from kategoriler');
            $urun_arr = $db->rawQuery('select * from urunler where durum = 1 and marka_id = ?', array($marka_id));
            $datas = array();
            foreach ($urun_arr as $urun) {
                $kat_adi = "";
                foreach ($marka_arr as $marka) {
                    if ($marka["id"] == $urun["kategori_id"]) {
                        $kat_adi = $marka["baslik"];
                        break;
                    }
                }
                $datas[] = [
                    "id" => sifre::sifre_yap($urun["id"]),
                    "urun_adi" => $urun["baslik"],
                    "urun_url" => $urun["urun_url"],
                    "kat_adi" => $kat_adi,
                    "resim_url" => $urun["resim_url"]
                ];
            }
            $db->disconnectAll();
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Ürünler listelenemedi"];
        }
    }

}