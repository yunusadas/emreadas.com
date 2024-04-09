<?php

namespace classes;

use classes\sifre;

use Exception;

include_once 'baglanti.php';
include_once 'sifre.php';
class marka
{

    public static function marka_listele(){
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $marka_arr = $db->rawQuery('select * from marka');

            $datas = array();
            foreach ($marka_arr as $marka) {
                if ($marka["durum"] == 1) {
                    $marka["durum"] = "Aktif";
                } else {
                    $marka["durum"] = "Pasif";
                }
                $datas[] = [
                    "id" => sifre::sifre_yap($marka["id"]),
                    "marka_adi" => $marka["baslik"],
                    "durum" => $marka["durum"],
                    "resim_url"=>$marka["resim_url"]
                ];
            }
            $db->disconnectAll();
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Kişiler listelenemedi"];
        }
    }

    public static function marka_resim_ekle($veriler)
    {
        $dosyaAdi = sifre::turk_to_eng_bosluksuz($veriler['marka_resmi']['name']);
        $dosyaAdi = mb_strtolower($dosyaAdi);
        $dosyaYolu = $veriler['marka_resmi']['tmp_name'];
        $dosyaTipi = $veriler['marka_resmi']['type'];
        $dosyaBoyutu = $veriler['marka_resmi']['size'];
        $marka_id = sifre::sifre_coz($veriler['marka_id']);


        move_uploaded_file($dosyaYolu, $_SERVER['DOCUMENT_ROOT'] . "\admin-tema\admin\assets\img\markalar\\" . $dosyaAdi);
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $db->where('id', $marka_id);
            $update = $db->update('marka', [
                'resim_url' => "admin-tema/admin/assets/img/markalar/" . $dosyaAdi
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

    public static function marka_adi_ver($veriler)
    {
        try {
            $db = new \classes\baglanti();
            $db = $db->baglanti2();

            $girdiler = $veriler["array"];
            $sid = $girdiler["marka_id"];
            $id = sifre::sifre_coz($sid);

            $marka_arr = $db->rawQuery('SELECT baslik,durum FROM marka WHERE id = ?', array($id))[0];

            $marka_adi = $marka_arr["baslik"];
            $marka_durum = $marka_arr["durum"];
            if ($marka_adi) {
                $db->disconnectAll();
                return ["durum" => true, "marka_ad" => $marka_adi, "marka_durum" => $marka_durum];
            }else{
                return ["durum" => false, "message" => "Marka adı alınamadı"];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Marka adı alınamadı"];
        }
    }

    public static function marka_guncelle($veriler)
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $girdiler = $veriler["array"];
            $sid = $girdiler["marka_id"];
            $id = sifre::sifre_coz($sid);
            $marka_ad = $girdiler["marka_ad"];
            $marka_durum = $girdiler["marka_durum"];

            $marka_resim = $db->rawQuery('SELECT resim_url FROM marka WHERE id = ?', array($id))[0];
            $marka_resim = str_replace("/", "\\", $marka_resim);

            $marka_resim_path = $_SERVER['DOCUMENT_ROOT'] . "\\" . $marka_resim["resim_url"];

            if (file_exists($marka_resim_path)) {
                unlink($marka_resim_path);

            }
            $sonuc = $db->where('id', $id)->update('marka', [
                'baslik' => $marka_ad,
                'durum' => $marka_durum
            ]);

            if ($sonuc) {
                $db->disconnectAll();
                return ["durum" => true, "message" => "Marka güncellendi"];
            } else {
                return ["durum" => false, "message" => "Marka güncellenemedi"];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Marka güncellenemedi"];
        }
    }

    public static function marka_ekle($veriler)
    {
        try {
            $girdiler = $veriler["array"];
            $marka_ad = $girdiler["marka_ad"];
            $marka_durum = $girdiler["marka_durum"];

            $db = new baglanti();
            $db = $db->baglanti2();

            $sonuc = $db->insert('marka', [
                'baslik' => $marka_ad,
                'durum' => $marka_durum,
            ]);

            $marka_id = $db->getInsertId();
            $marka_id = sifre::sifre_yap($marka_id);
            if ($sonuc) {
                $db->disconnectAll();
                return ["durum" => true, "message" => "Marka eklendi", "marka_id" => $marka_id];

            } else {
                return ["durum" => false, "message" => "Marka eklenemedi"];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Marka eklenemedi"];
        }
    }

    public static function marka_sil($veriler)
    {
        $db = new \classes\baglanti();
        $db = $db->baglanti2();

        $girdiler = $veriler["array"];

        if (is_null($girdiler)) {
            return ["durum" => false, "message" => "Lütfen marka seçiniz!"];
        }

        $sid = $girdiler["marka_sid"];
        $id = sifre::sifre_coz($sid);

        try {
            $marka_resim = $db->rawQuery('SELECT resim_url FROM marka WHERE id = ?', array($id))[0];
            $marka_resim = str_replace("/", "\\", $marka_resim);
            $sonuc = $db->where('id', $id)->delete('marka');
            $marka_resim_path = $_SERVER['DOCUMENT_ROOT'] . "\\" . $marka_resim["resim_url"];
            if ($sonuc) {
                if (file_exists($marka_resim_path)) {
                    if (unlink($marka_resim_path)) {
                        $db->disconnectAll();
                        return ["durum" => true, "message" => "Marka silindi."];
                    } else {
                        return ["durum" => false, "message" => "Marka resmi silinemedi."];}
                } else {
                    $db->disconnectAll();
                    return ["durum" => true, "message" => "Marka silindi. Fakat resim bulunamadığı için silinemedi."];
                }
            } else {
                return ["durum" => false, "message" => "Marka silinemedi."];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "marka silinirken bir hata meydana geldi."];
        }
    }

    public static function marka_detay_listele()
    {
        $db = new baglanti();
        $db = $db->baglanti2();

        try {
            $marka_arr = $db->rawQuery('select * from marka order by sira_no');

            $datas = array();
            foreach ($marka_arr as $marka) {
                $datas[] = [
                    "id" => sifre::sifre_yap($marka["id"]),
                    "marka_adi" => $marka["baslik"],
                    "marka_durum" => $marka["durum"],
                    "resim_url" => $marka["resim_url"],
                    "sira_no" => $marka["sira_no"],
                ];
            }
            $db->disconnectAll();
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ["durum" => false, "message" => "Markalar listelenemedi"];
        }
    }

}