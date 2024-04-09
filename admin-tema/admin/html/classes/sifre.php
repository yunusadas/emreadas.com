<?php

namespace classes;
/**
 * Yunus Emre Adaş Tarafından oluşturulmuştur.
 * Date     : 19.03.2024
 * Time     : 02:34
 * Açıklama : Genel Şifreleme İşlemleri
 */
class sifre
{

    public static function kayit_id_coz($id)
    {
        if (empty($id))
            return false;

        if (is_numeric($id) and $id > 0)
            return intval($id);

        if (!is_numeric($id))
            $id = sifre::sifre_coz($id);

        if (is_numeric($id) && $id > 0 && $id !== false)
            return intval($id);

        return "user-not-found";
    }

    public static function sifre_yap($string)
    {
        $string = $string * 1498158 + 825920496;
        return (base64_encode($string));

    }

    public static function user_sifre_yap($string)
    {
        if ($string == "" || $string == null)
            return false;
        else {
            $data = $string;
            $cipher = "AES-256-CBC";
            $key = "33de5ce9487ba2a0cf8c94a2575b8a99";
            $sifrelenmis = openssl_encrypt($data, $cipher, $key,0,"1234567890123456");
            return ["durum" => true, "sifre" => $sifrelenmis];
        }

    }

    public static function user_sifre_coz($string)
    {
        if ($string == "" || $string == null)
            return false;
        else {
            $data = $string;
            $cipher = "AES-256-CBC";
            $key = "33de5ce9487ba2a0cf8c94a2575b8a99";

            $cozulmus = openssl_decrypt($data, $cipher, $key,0,"1234567890123456");

            return ["durum" => true, "sifre" => $cozulmus];
        }
    }


    public static function sifre_coz($string)
    {
        $string = base64_decode(urldecode($string));
        $number = ($string - 825920496) / 1498158;
        if (is_numeric($number) && $number > 0)
            return intval($number);

        return false;
    }

    /**
     * 0-10 milyon arasında benzersiz 9 haneli hash üretir
     * @param $birinci_id
     * @param $limit
     * @return string
     */
    public static function id_to_hash($birinci_id, $limit = 9)
    {
        //kişi id md5 dönüşümü
        $md5_hash = md5($birinci_id);

        //taban değişimi ve 9 hane sınırı
        $hash = substr(base_convert($md5_hash, 16, 32), 0, $limit);

        return $hash;
    }


    public static function randomPassword($limit = 6)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $limit; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
    public static function turk_to_eng_bosluksuz($metin)
    {
        $aranan = array("ç", "Ç", "ğ", "Ğ", "ı", "İ", "ö", "Ö", "ş", "Ş", "ü", "Ü", " ","/");
        $yerine = array("c", "C", "g", "G", "i", "I", "o", "O", "s", "S", "u", "U", "_","-");
        $gidecek = str_replace($aranan, $yerine, $metin);
        return $gidecek;
    }
}