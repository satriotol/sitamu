<?php

namespace App\Services;

class SendWhatsappService
{
    public static function sendWhatsapp($nama_admin, $phone_no)
    {
        $message = "Yth. " . $nama_admin .
            "\n\nSaat ini ada pengunjung yang menunggu di Ruang Tamu PIP. Mohon difollow up. Informasi kunjungan selengkapnya di sitamu.diskominfo.semarangkota.go.id.
        Terima kasih ";

        $message = preg_replace("/(\n)/", "<ENTER>", $message);
        $message = preg_replace("/(\r)/", "<ENTER>", $message);

        $phone_no = preg_replace("/(\n)/", ",", $phone_no);
        $phone_no = preg_replace("/(\r)/", "", $phone_no);

        $data = array("phone_no" => $phone_no, "key" => "e4d16a0772635a648acd790503fe71a9ebcd9f538952dfbc", "message" => $message);
        $data_string = json_encode($data);
        $ch = curl_init('http://116.203.92.59/api/send_message');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );
        $result = curl_exec($ch);
    }
    public static function sendWhatsappToVisitor($nama, $phone_no)
    {
        $message = "Yth. " . $nama .
            "\n\nTerima kasih telah berkunjung di Data Center Kota Semarang. Mohon kesediannya untuk mengisi survey di https://forms.gle/HS7M8skaJxYUhoMz8 guna evaluasi dan perbaikan kinerja kami. Terima kasih.";

        $message = preg_replace("/(\n)/", "<ENTER>", $message);
        $message = preg_replace("/(\r)/", "<ENTER>", $message);

        $phone_no = preg_replace("/(\n)/", ",", $phone_no);
        $phone_no = preg_replace("/(\r)/", "", $phone_no);

        $data = array("phone_no" => $phone_no, "key" => "e4d16a0772635a648acd790503fe71a9ebcd9f538952dfbc", "message" => $message);
        $data_string = json_encode($data);
        $ch = curl_init('http://116.203.92.59/api/send_message');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );
        $result = curl_exec($ch);
    }
}
