<?php

namespace classes;

use Exception;
use classes\sifre;

require 'baglanti.php';
require 'sifre.php';


class kisi
{
    public static function kisi_listele()
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $kisi_arr = $db->rawQuery('select * from kisiler');

            $datas = array();
            foreach ($kisi_arr as $kisi) {
                $datas[] = [
                    "id" => sifre::sifre_yap($kisi["id"]),
                    "kisi_ad_soyad" => $kisi["ad"] . " " . $kisi["soyad"],
                    "kisi_email" => $kisi["email"],
                    "kisi_yetki" => "Admin"
                ];
            }


            $db->disconnectAll();

            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kişiler listelenemedi"];
        }
    }

    public static function kisi_ekle($veriler)
    {
        try {
            $db = new baglanti();
            $db = $db->baglanti2();

            $girdiler = $veriler["array"];
            $kisi_ad = $girdiler["kisi_ad"];
            $kisi_soyad = $girdiler["kisi_soyad"];
            $kisi_email = $girdiler["kisi_email"];
            $kisi_sifre = $girdiler["kisi_sifre"];
            $kisi_sifre_tekrar = $girdiler["kisi_sifre_tekrar"];

            $mail_kontrol = $db->rawQuery('select email from kisiler where email = ?', array($kisi_email));
            if (count($mail_kontrol) > 0) {
                return ["durum" => false, "message" => "Bu email adresi zaten kayıtlı"];
            }

            if (!filter_var($kisi_email, FILTER_VALIDATE_EMAIL)) {
                return ["durum" => false, "message" => "Geçersiz email formatı"];
            }

            if ($kisi_sifre !== $kisi_sifre_tekrar) {
                return ["durum" => false, "message" => "Şifreler uyuşmuyor"];
            }
            $kisi_sifre = sifre::user_sifre_yap($kisi_sifre)["sifre"];

            $sonuc = $db->insert('kisiler', [
                'ad' => $kisi_ad,
                'soyad' => $kisi_soyad,
                'email' => $kisi_email,
                'sifre' => $kisi_sifre
            ]);

            if ($sonuc) {
                $db->disconnectAll();
                return ["durum" => true, "message" => "Kişi eklendi"];

            } else {
                return ["durum" => false, "message" => "Kişi eklenemedi"];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kişi eklenemedi"];
        }
    }

    public static function kisi_guncelle($veriler)
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {

            $girdiler = $veriler["array"];
            $eski_sifre = $girdiler["eski_sifre"];
            $yeni_sifre = $girdiler["yeni_sifre"];
            $yeni_sifre_tekrar = $girdiler["yeni_sifre_tekrar"];
            $id = sifre::sifre_coz($girdiler["kisi_id"]);

            $eski = $db->rawQuery('select sifre from kisiler where id = ?', array($id))[0]["sifre"];
            $cozulmus_eski = sifre::user_sifre_coz($eski)["sifre"];
            if ($cozulmus_eski != $eski_sifre) {
                return ["durum" => false, "message" => "Eski şifre uyuşmuyor"];
            }

            if ($yeni_sifre !== $yeni_sifre_tekrar) {
                return ["durum" => false, "message" => "Yeni şifreler uyuşmuyor"];
            }

            $sonuc = $db->where('id', $id)->update('kisiler', [
                'sifre' => sifre::user_sifre_yap($yeni_sifre)["sifre"]
            ]);
            if ($sonuc) {
                $db->disconnectAll();
                return ["durum" => true, "message" => "Şifre güncellendi."];

            } else {
                return ["durum" => false, "message" => "Şifre güncellenemedi."];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Şifre güncellenirken bir hata oluştu."];
        }
    }

    public static function kisi_sil($veriler)
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        $girdiler = $veriler["array"];
        $id = sifre::sifre_coz($girdiler["kisi_id"]);

        try {
            $sonuc = $db->where('id', $id)->delete('kisiler');

            if ($sonuc) {
                $db->disconnectAll();
                return ["durum" => true, "message" => "Kişi silindi"];

            } else {
                return ["durum" => false, "message" => "Kişi silinemedi"];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kişi silinemedi"];
        }
    }


}