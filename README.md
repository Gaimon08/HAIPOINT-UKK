# HAIPOINT

## _Aplikasi Point Of Sale Codeigniter 4_
HAIPOINT adalah solusi Point of Sale yang inovatif dan efisien untuk membantu bisnis Anda dalam mengelola transaksi dengan lebih mudah dan cepat. Dibangun dengan teknologi terkini, HAIPOINT menyediakan berbagai fitur yang dirancang untuk meningkatkan pengalaman bertransaksi Anda.

Aplikasi ini dirancang sebagai bagian dari Uji Kompetensi Keahlian di SMKN 2 Kuningan,
[Haikal Jibran Al-Ghiffarry](https://haikaldiscoveries.my.id/#hero) XII RPL1.

Demo: https://haikaldiscoveries.my.id

## Features

- Kasir Cepat: Proses transaksi dengan cepat dan efisien menggunakan antarmuka kasir yang sederhana.
- Scanner Barcode: Pindai produk dengan mudah menggunakan scanner barcode terintegrasi.
- Generate Barcode: Buat barcode produk secara otomatis untuk manajemen inventaris yang lebih efisien.
- Cetak Struk: Cetak struk transaksi secara langsung untuk pelanggan Anda.
- Print PDF: Cetak laporan transaksi dalam format PDF untuk dicetak atau disimpan.
- Laporan Real-time: Pantau kinerja bisnis Anda dengan laporan real-time yang komprehensif

## Installation

```sh
git clone https://github.com/Gaimon08/HAIPOINT-UKK.git
```  

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

Impor berkas database starter.sql ke server database web Anda dan jalankan aplikasi dengan menggunakan server pengembangan lokal 'php spark serve'. 
Gunakan informasi berikut untuk masuk:

- Username: superadmin
- Email: superadmin@gmail.com
- Password: demoapp1

> **Warning**
> The end of life date for PHP 7.4 was November 28, 2022. If you are
> still using PHP 7.4, you should upgrade immediately. The end of life date
> for PHP 8.0 will be November 26, 2023.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
