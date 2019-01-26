<?php
namespace App\Controller;
use System\Controller as Controller;

class About extends Controller{
    public function index(){
        $this->res->render("about", array("head"=>"About Us", "Content"=> "PT. Mitra Karya Makmur telah melakukan bisnis sejak tahun 2003. Perusahaan bergerak dalam bisnis pekerjaan pemindahan tanah, kontraktor umum, drainage, infrastruktur jalan dan juga penyewaan alat-alat berat. Didirikan oleh Bapak Djoko Handoko. Perusahaan telah ada untuk periode yang signifikan. Menyelesaikan setiap proyek tepat waktu serta memenuhi standar kepuasan pelanggan yang tinggi, PT. Mitra Karya Makmur telah membangun hubungan kepercayaan dengan banyak pelanggannya. PT. Mitra Karya Makmur tumbuh menjadi mitra terpercaya dalam setiap pekerjaan, dan terus menerima berbagai pekerjaan dari pemilik proyek. Beberapa proyek yang telah dilakukan oleh perusahaan termasuk cut & fill, pekerjaan grading di BSD, Sentul City, Grand Wisata, Sentul Nirwana Bogor, Pembangunan Perumahan (PP) dengan Nindya Karya, Kota Wisata, Legenda Wisata, pembangunan tol jagorawi jalan, pengembangan jalan menuju ke Bandara Internasional Soekarno-Hatta, Jalan Tol Lingkar Luar Kebon Jeruk-Ulujami, serta beberapa proyek lain seperti proyek Wijaya Karya, Adhi-Karya, Adhi-Acset KSO, MNC Group, Kawasan Industri Internasional di KIIC di Karawang, Delta Mas di Cikarang, dan CFLD di Karawang."));
    }
}