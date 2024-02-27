# HAIPOINT

## _Aplikasi Point Of Sale Codeigniter 4_
HAIPOINT adalah solusi Point of Sale yang inovatif dan efisien untuk membantu bisnis Anda dalam mengelola transaksi dengan lebih mudah dan cepat. Dibangun dengan teknologi terkini, HAIPOINT menyediakan berbagai fitur yang dirancang untuk meningkatkan pengalaman bertransaksi Anda.

Aplikasi ini dirancang sebagai bagian dari Uji Kompetensi Keahlian di SMKN 2 Kuningan.
[Haikal Jibran Al-Ghiffarry](https://haikaldiscoveries.my.id/#hero) XII RPL1.

## Features

- Kasir Cepat: Proses transaksi dengan cepat dan efisien menggunakan antarmuka kasir yang sederhana.
- Scanner Barcode: Pindai produk dengan mudah menggunakan scanner barcode terintegrasi.
- Generate Barcode: Buat barcode produk secara otomatis untuk manajemen inventaris yang lebih efisien.
- Cetak Struk: Cetak struk transaksi secara langsung untuk pelanggan Anda.
- Print PDF: Cetak laporan transaksi dalam format PDF untuk dicetak atau disimpan.
- Laporan Real-time: Pantau kinerja bisnis Anda dengan laporan real-time yang komprehensif

## Installation

clone
```sh
[cd dillinger
npm i
node app](https://github.com/Gaimon08/HAIPOINT-UKK.git)
```  

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

Impor berkas database starter.sql ke server database web Anda dan jalankan aplikasi dengan menggunakan server pengembangan lokal 'php spark serve'. 
Gunakan informasi berikut untuk masuk:

Username: superadmin
Email: superadmin@gmail.com
Password: demoapp1

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> **Warning**
> The end of life date for PHP 7.4 was November 28, 2022. If you are
> still using PHP 7.4, you should upgrade immediately. The end of life date
> for PHP 8.0 will be November 26, 2023.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
