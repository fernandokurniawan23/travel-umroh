-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Bulan Mei 2025 pada 10.55
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reads` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `excerpt`, `image`, `description`, `category_id`, `created_at`, `updated_at`, `reads`) VALUES
(1, '🕋 Panduan Umroh', 'panduan-umroh', '\"Panduan lengkap ibadah umrah untuk pemula, mulai dari persiapan, niat di miqat, thawaf, sa’i, hingga tahallul. Cocok bagi Anda yang ingin memahami setiap langkah umrah dengan mudah dan khusyuk.\"', 'blog/images/zBHZnVXOydomhn5V6p9MtyVMbAaIT8bweHYEkGZC.jpg', '<h2>🕋 Panduan Umrah untuk Pemula: Langkah demi Langkah</h2><p>Melaksanakan ibadah umrah adalah impian banyak umat Muslim. Meski ibadah ini tidak sekompleks haji, tetap saja penting untuk memahami setiap tahapannya agar perjalanan spiritual ini berjalan lancar dan khusyuk. Artikel ini akan membahas panduan umrah secara lengkap, khusus untuk Anda yang baru pertama kali akan melaksanakannya.</p><figure class=\"media\"><oembed url=\"https://www.youtube.com/watch?v=XJBibv9_FBI\"></oembed></figure><h3>1. <strong>Persiapan Sebelum Berangkat</strong></h3><p>Sebelum berangkat ke Tanah Suci, pastikan Anda telah menyiapkan hal-hal berikut:</p><p><strong>Paspor dan Visa</strong>: Pastikan paspor masih berlaku minimal 6 bulan. Urus visa umrah melalui agen travel resmi.</p><p><strong>Vaksinasi &amp; Kesehatan</strong>: Vaksin meningitis dan vaksin COVID-19 biasanya diwajibkan. Jangan lupa membawa obat pribadi.</p><p><strong>Perlengkapan Pribadi</strong>: Kain ihram (untuk pria), mukena (untuk wanita), sandal jepit, tas kecil, botol spray wudhu, dan buku panduan manasik.</p><p><strong>Manasik Umrah</strong>: Ikuti bimbingan manasik umrah agar memahami tata cara dan doa-doa yang dibaca selama ibadah.</p><h3>2. <strong>Niat dan Pakaian Ihram di Miqat</strong></h3><p>Saat tiba di tempat miqat (seperti Bir Ali untuk yang berangkat dari Madinah), niatkan umrah dan kenakan pakaian ihram. Sejak itu, Anda masuk dalam keadaan ihram dan wajib menjaga larangan-larangannya (seperti memotong kuku, mencukur rambut, dan menggunakan parfum).</p><p><strong>Niat Umrah:</strong></p><blockquote><p>اللَّهُمَّ لَبَّيْكَ عُمْرَةً</p><p>\"Labbaika ‘Umratan\"<br>(Aku sambut panggilan-Mu untuk melaksanakan umrah)</p></blockquote><h3>3. <strong>Thawaf di Masjidil Haram</strong></h3><p>Setibanya di Masjidil Haram, langsung menuju Ka\'bah untuk melaksanakan thawaf sebanyak 7 putaran. Putaran dimulai dari Hajar Aswad dan berlawanan arah jarum jam.</p><h3>4. <strong>Shalat di Belakang Maqam Ibrahim</strong></h3><p>Setelah thawaf, shalat sunnah 2 rakaat di belakang Maqam Ibrahim jika memungkinkan. Jika tidak, bisa dilakukan di tempat lain di Masjidil Haram.</p><h3>5. <strong>Minum Air Zamzam</strong></h3><p>Jangan lewatkan untuk minum air zamzam setelah thawaf dan shalat sunnah.</p><h3>6. <strong>Sa’i antara Shafa dan Marwah</strong></h3><p>Sa’i dilakukan sebanyak 7 kali bolak-balik dari Bukit Shafa ke Bukit Marwah. Bacalah doa dan dzikir selama sa’i.</p><h3>7. <strong>Tahallul (Memotong Rambut)</strong></h3><p>Sebagai penutup rangkaian umrah, lakukan tahallul dengan mencukur atau memotong sebagian rambut. Pria dianjurkan mencukur habis (tahliq), sedangkan wanita cukup memotong sebagian kecil rambut.</p>', 1, '2025-04-10 09:25:35', '2025-05-25 06:03:29', 39),
(4, '📸 Dokumentasi Perjalanan Umrah Agustus 2024 - Haromain Travel', 'dokumentasi-perjalanan-umrah-agustus-2024-haromain-travel', 'Suasana hangat dan penuh kebersamaan menyertai perjalanan umrah Agustus 2024. Saksikan dokumentasi momen-momen istimewa jamaah bersama Haromain Travel di Tanah Suci.', 'blog/images/NIw1VWXZ7Me4nCt0nFUVr4EcS4nUqpUy8TIoCDa7.jpg', '<p>Perjalanan umrah di bulan Agustus 2024 bersama Haromain Travel membawa semangat baru di tengah musim panas yang hangat di Tanah Suci. Jamaah kami tetap semangat dan khusyuk dalam menjalankan ibadah dengan bimbingan dari tim profesional dan pembimbing spiritual yang berpengalaman. Momen-momen kebersamaan, kekeluargaan, dan keharuan terasa begitu kental dalam setiap langkah ibadah mereka.<br>📷 Lihat dokumentasi perjalanan ini sebagai bukti nyata komitmen Haromain Travel dalam memberikan layanan terbaik untuk setiap jamaah. Mari wujudkan niat umrah Anda bersama kami!</p>', 2, '2025-04-24 02:41:10', '2025-05-25 06:08:38', 61),
(6, 'Dokumentasi Juli 2024 -Haromain Travel', 'dokumentasi-juli-2024-haromain-travel', 'Suasana hangat dan penuh kebersamaan menyertai perjalanan umrah Juli 2024. Saksikan dokumentasi momen-momen istimewa jamaah bersama Haromain Travel di Tanah Suci.', 'blog/images/saeQMJEvWw5KfuJP9tK7tzsgnfTxDSn9pCDIQfTQ.jpg', '<p>📷 Lihat dokumentasi perjalanan ini sebagai bukti nyata komitmen Haromain Travel dalam memberikan layanan terbaik untuk setiap jamaah. Mari wujudkan niat umrah Anda bersama kami!</p>', 2, '2025-05-22 03:14:05', '2025-05-25 05:13:06', 4),
(7, 'Dokumentasi september 2024 -Haromain Travel', 'dokumentasi-september-2024-haromain-travel', 'Suasana hangat dan penuh kebersamaan menyertai perjalanan umrah september2024. Saksikan dokumentasi momen-momen istimewa jamaah bersama Haromain Travel di Tanah Suci.', 'blog/images/oiQu6TGRy0QgcFETvFalzi4cfpIRVMlKjFVSH1dz.jpg', '<p>📷 Lihat dokumentasi perjalanan ini sebagai bukti nyata komitmen Haromain Travel dalam memberikan layanan terbaik untuk setiap jamaah. Mari wujudkan niat umrah Anda bersama kami!</p>', 2, '2025-05-22 03:18:29', '2025-05-25 05:31:29', 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog_images`
--

CREATE TABLE `blog_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `blog_images`
--

INSERT INTO `blog_images` (`id`, `blog_id`, `image_path`, `created_at`, `updated_at`) VALUES
(5, 4, 'blog/images/galleries/jWAoOi2HStmIFk4KLzGASGXGv2RUWVLjeIdmQub6.jpg', '2025-05-22 03:10:41', '2025-05-22 03:10:41'),
(6, 4, 'blog/images/galleries/z3WoMflvlM1Kwp2WdE3C1PJXBEKHZQJk8wwAvja2.jpg', '2025-05-22 03:10:41', '2025-05-22 03:10:41'),
(7, 4, 'blog/images/galleries/2rq9xC8NxMzocNPFK55WwSFgU5mnBmudMcMzYyxS.jpg', '2025-05-22 03:10:41', '2025-05-22 03:10:41'),
(8, 4, 'blog/images/galleries/R5IZgawlPJ0BlFezmw7dgMmpHXBXw2sRLHUqKERN.jpg', '2025-05-22 03:10:41', '2025-05-22 03:10:41'),
(9, 7, 'blog/images/galleries/NOJ0g7yyYrye1Ywd61ekJS8PbqshXj9TwodJwt8i.jpg', '2025-05-22 03:18:29', '2025-05-22 03:18:29'),
(10, 7, 'blog/images/galleries/ibThAgV4boe9mi2BAOZjnuLJYKPocVpcMuEqKsmj.jpg', '2025-05-22 03:18:29', '2025-05-22 03:18:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number_phone` varchar(255) NOT NULL,
  `ktp` varchar(255) DEFAULT NULL,
  `paspor` varchar(255) DEFAULT NULL,
  `vaccine_document` varchar(255) DEFAULT NULL,
  `travel_package_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_receipt` varchar(255) DEFAULT NULL,
  `shipment_info` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_receipt_confirmation` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `order_id`, `name`, `email`, `number_phone`, `ktp`, `paspor`, `vaccine_document`, `travel_package_id`, `user_id`, `shipment_receipt`, `shipment_info`, `created_at`, `updated_at`, `user_receipt_confirmation`) VALUES
(46, 'MNL-46-202505080636', 'Fernando Kurniawan', 'fernandokurniawan4@gmail.com', '089661997849', 'uploads/ktp/GW9ciu9zDcTmwM9FPtAap2g7AT63dg6hQ7hfnU3Q.png', 'uploads/paspor/xMAurrLrFhYewl3hNRxfQ0hpuG7gLAWJB8zGF9bI.png', 'uploads/vaccine_document/jnj7tRRYCcrOBOqh2NjUdxaCUXnAJQC01pbUtl2k.png', 2, 1, NULL, NULL, '2025-05-07 23:36:29', '2025-05-15 01:04:31', 0),
(69, NULL, 'farhan', 'frnndokrnwn237@gmail.com', '89661997844', NULL, NULL, NULL, 1, 6, 'uploads/bukti_pengiriman/rN3KvawTUGmvLylfkTANw7IPQzmyiqaLIE73I5LO.png', 'JTE1234567890', '2025-05-23 20:33:59', '2025-05-25 23:27:00', 0),
(79, 'USR-79-202505251459', 'n', 'frnndokrnwn237@gmail.com', '089661997849', NULL, NULL, NULL, 2, 6, NULL, NULL, '2025-05-25 07:59:00', '2025-05-25 07:59:00', 0),
(80, 'USR-80-202505260826', 'nando', 'fernandokurniawan4@gmail.com', '089661997849', NULL, NULL, NULL, 1, 69, 'uploads/bukti_pengiriman/WCOeVxFXd30TyPRjuJYkaeMi3IqT2wbkAS3rNGBS.png', 'JTE1234567891', '2025-05-26 01:26:30', '2025-05-26 01:29:37', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'edukasi dan informasi', 'edukasi-dan-informasi', '2025-04-10 09:21:56', '2025-04-10 09:22:09'),
(2, 'Dokumentasi', 'dokumentasi', '2025-04-24 02:32:26', '2025-04-24 02:32:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `travel_package_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `images`, `travel_package_id`, `created_at`, `updated_at`) VALUES
(1, 'paket umroh all in', 'travel_package/gallery/IuDiRZXIYOSSU8HmUTgNO2NR5SufIP6ZThJa9nmJ.jpg', 1, '2025-04-10 09:17:21', '2025-04-10 09:17:21'),
(2, 'paket umroh 12 hari', 'travel_package/gallery/wD1bq03UBEz5OWIENp4BgDnmcmqeBdvmIBleDH3Y.jpg', 2, '2025-04-10 09:18:34', '2025-04-10 09:18:34'),
(3, 'paket umroh itikaf', 'travel_package/gallery/Skdore89HDdBgwVnT2hi0LW2SrD5untBi79wXXZ6.jpg', 3, '2025-04-10 09:19:45', '2025-04-10 09:19:45'),
(4, 'Hotel Olayan Golden', 'travel_package/gallery/5iEqSt8Txlzrsj3uNkn23nEPgfo9kZvHqD9BMZ7M.jpg', 1, '2025-04-14 04:44:57', '2025-04-14 04:44:57'),
(5, 'Mirage Alsalam Hotel', 'travel_package/gallery/dAQ0d7wVR4aDL5eZt6crCL9uu9zr0PdJRbG2eHgA.jpg', 1, '2025-04-14 05:16:35', '2025-04-14 05:16:35'),
(7, 'umrah1', 'travel_package/gallery/GGfWJEKQGWP2MMKvoUFV1bld75CYqVIjADPXpsr2.jpg', 5, '2025-05-25 22:21:59', '2025-05-25 22:21:59'),
(8, 'umroh 2', 'travel_package/gallery/TXK0OVHX12XyqOLK5qKkPprkPSluU2lVOHvXMuCg.jpg', 6, '2025-05-25 22:28:07', '2025-05-25 22:28:07'),
(9, 'umroh 3', 'travel_package/gallery/ew8cxBM0rOjRFXKke5TW9htlvjJYrwyVQqYTHrde.jpg', 7, '2025-05-25 22:29:22', '2025-05-25 22:29:22'),
(10, 'umroh 4', 'travel_package/gallery/TYq2bnFGtu1VMrHAyWjTY5aQrP0cAfWhD82nhigo.jpg', 8, '2025-05-25 22:30:51', '2025-05-25 22:30:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_28_050111_create_categories_table', 1),
(6, '2023_02_28_065501_create_travel_packages_table', 1),
(7, '2023_02_28_065908_create_blogs_table', 1),
(8, '2023_02_28_070324_create_bookings_table', 1),
(9, '2023_03_01_020708_create_galleries_table', 1),
(10, '2023_03_01_151237_add_reads_to_blogs_table', 1),
(11, '2025_05_01_040202_add_payment_fields_to_bookings_table', 2),
(12, '2025_05_03_082732_add_payment_columns_to_bookings_table', 3),
(13, '2025_05_06_093455_add_role_to_users_table', 4),
(14, '2025_05_08_055409_add_vaccine_document_to_bookings_table', 5),
(16, '2025_05_21_140517_add_description_to_bookings_table', 6),
(17, '2025_05_21_163715_create_payments_table', 7),
(18, '2025_05_21_164336_remove_payment_fields_from_bookings_table', 7),
(19, '2025_05_22_063538_create_blog_images_table', 8),
(20, '2025_05_22_064642_create_blog_images_table', 9),
(21, '2025_05_24_082759_add_receipt_columns_to_bookings_table', 10),
(22, '2025_05_24_092307_add_user_receipt_confirmation_at_to_bookings', 11),
(23, '2025_05_24_101959_add_user_receipt_confirmation_to_bookings', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('fernandokurniawan4@gmail.com', '$2y$10$NBrqwj/ms/u5cRO.ieizcu64Q4ST4qWL1/Ze0rPY.EIJ8DrmhXwwy', '2025-04-27 05:52:10'),
('frnndokrnwn237@gmail.com', '$2y$10$W2VYfoHVSYf.ENa5tj0ADuNK/NPB1ypfJfp5Mt4Yg/XmkAYYaFam6', '2025-05-26 00:25:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'paid',
  `payment_date` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `amount`, `method`, `status`, `payment_date`, `description`, `created_at`, `updated_at`) VALUES
(9, 69, 3000000, 'VA BCA', 'success', '2025-05-23 17:00:00', 'Cicilan ke 1', '2025-05-23 20:58:03', '2025-05-23 21:26:16'),
(10, 69, 5000000, 'VA BCA', 'success', '2025-05-23 17:00:00', 'CICILAN KE 2', '2025-05-23 20:58:34', '2025-05-23 20:58:34'),
(11, 69, 18750000, 'VA BCA', 'success', '2025-05-23 17:00:00', 'Pelunasan', '2025-05-24 04:23:12', '2025-05-24 04:23:12'),
(15, 80, 5000000, 'VA BCA', 'success', '2025-05-25 17:00:00', 'Cicilan 1', '2025-05-26 01:28:57', '2025-05-26 01:28:57'),
(16, 80, 21750000, 'VA BCA', 'success', '2025-05-25 17:00:00', 'Pelunasan', '2025-05-26 01:29:16', '2025-05-26 01:29:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `travel_packages`
--

CREATE TABLE `travel_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `travel_packages`
--

INSERT INTO `travel_packages` (`id`, `type`, `slug`, `location`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Paket Umroh ALL-IN', 'paket-umroh-all-in', 'Soetta (CGK), Tangerang', 26750000, '<p>Tunaikan ibadah Umroh dengan nyaman bersama Haromain Travel melalui Paket Umroh All-In. Perjalanan ini dirancang untuk memberikan pengalaman terbaik bagi jamaah dengan fasilitas lengkap dan penerbangan langsung.</p><p>Detail Paket:<br>💰 Harga mulai dari: Rp 26,750 juta<br>✈ Maskapai: Garuda Indonesia (Direct Flight)<br>🏨 Penginapan:</p><p>Makkah: Olayan Golden</p><p>Madinah: Mirage Assalam<br>📅 Jadwal keberangkatan: 14 Januari 2025</p><p>Fasilitas yang Termasuk:<br>✅ Tiket pesawat Garuda Indonesia PP (direct flight)<br>✅ Akomodasi hotel berbintang di Makkah &amp; Madinah<br>✅ Fasilitas lengkap untuk kenyamanan jamaah</p><p>Paket ini menawarkan perjalanan yang nyaman dengan penerbangan langsung, mengurangi transit yang melelahkan. Selain itu, jamaah akan menginap di hotel dengan fasilitas terbaik yang dekat dengan Masjidil Haram dan Masjid Nabawi.</p><p>Jangan lewatkan kesempatan ini! Daftar sekarang dan rasakan pengalaman Umroh yang tenang serta penuh berkah.</p><p>📍 Alamat Kantor:<br>Jl. Parung Jaya No 56 B, RT 01/RW 01, Kel. Parung Jaya, Kec. Karang Tengah, Kota Tangerang 15159 (Samping Apartemen Metro Garden)</p><p>🔗 Info &amp; Reservasi:<br>🌍 Website: www.haromaintravel.com&nbsp;<br>&nbsp;</p>', '2025-04-10 09:16:43', '2025-04-25 22:42:12'),
(2, 'Paket Umroh 12 Hari', 'paket-umroh-12-hari', 'Soetta (CGK), Tangerang', 26000000, '<p>Nikmati perjalanan spiritual yang nyaman dan berkesan dengan Paket Umroh Awal Tahun 2025 dari Haromain Travel. Dengan harga Rp 26 juta, Anda akan mendapatkan pengalaman ibadah yang lengkap selama 12 hari, dimulai dari keberangkatan pada 25 Januari 2025.</p><p>Detail Paket:<br>💰 Harga: Rp 26 juta<br>✈ Maskapai: Qatar, Etihad, Emirates, atau Oman Air<br>🏨 Hotel:</p><p>Mekkah: Rawdat Al-Bayt (⭐⭐⭐⭐⭐)</p><p>Madinah: Jawharat Rasheed (⭐⭐⭐⭐⭐)</p><p>Fasilitas yang Termasuk:<br>✅ Tiket pesawat PP<br>✅ Visa Umroh<br>✅ Transportasi selama di Saudi<br>✅ Makan 3x sehari<br>✅ City Tour Makkah &amp; Madinah<br>✅ Air Zam-Zam 5L</p><p>Yang Belum Termasuk:<br>❌ Visa<br>❌ Keperluan pribadi<br>❌ Vaksin meningitis</p><p>🆓 Bonus Gratis:<br>🚆 Kereta Cepat<br>🕌 Ziarah Thaif<br>🏛 Museum Wahyu<br>🍗 AL-BAIK (restoran populer Arab Saudi)</p><p>🔗 Website: www.haromaintravel.com<br>📱 Instagram:&nbsp;@haromaintravel</p>', '2025-04-10 09:18:16', '2025-04-25 22:42:19'),
(3, 'Paket Umroh Itikaf (14 hari)', 'paket-umroh-itikaf-14-hari', 'Soetta (CGK), Tangerang', 28000000, '<p>Bersiaplah untuk meraih keutamaan Ramadhan dengan Paket Umroh Itikaf selama 14 hari bersama Haromain Travel. Perjalanan ini berlangsung dari 19 Maret hingga 2 April 2025, memberikan kesempatan bagi jamaah untuk beribadah lebih khusyuk di Tanah Suci selama bulan penuh berkah.</p><p>Detail Paket:<br>💰 Harga mulai dari: Rp 28 juta<br>🏨 Hotel:</p><p>Makkah: Apartemen Ajyad / Setaraf</p><p>Madinah: Al Manar / Setaraf<br>✈ Maskapai: Saudi Arabian Airlines<br>👳‍♂ Dibimbing oleh: Ustadz Harry Febrian</p><p>Fasilitas yang Termasuk:<br>✅ Tiket pesawat PP<br>✅ Visa Umroh<br>✅ Siskopatuh<br>✅ Transportasi lengkap (Bandara, City Tour, Kepulangan)<br>✅ Makan buka puasa &amp; sahur<br>✅ Air Zam-Zam 5L</p><p>Yang Belum Termasuk:<br>❌ Pengurusan paspor<br>❌ Handling<br>❌ Keperluan pribadi<br>❌ Over bagasi<br>❌ Perlengkapan</p><p>Dengan paket ini, Anda akan mendapatkan pengalaman itikaf di Masjidil Haram dan Masjid Nabawi, merasakan keistimewaan ibadah di bulan Ramadhan. Segera daftarkan diri Anda dan nikmati perjalanan spiritual yang penuh berkah bersama Haromain Travel!</p><p>🔗 Reservasi &amp; Info lebih lanjut:<br>🌍 www.haromaintravel.com<br>📱 Instagram:&nbsp;@haromaintravel</p>', '2025-04-10 09:19:27', '2025-04-25 22:42:25'),
(5, 'Paket Umroh 1', 'paket-umroh-1', 'Soetta (CGK), Tangerang', 25000000, '<p>lorem ipsum</p>', '2025-05-25 22:20:07', '2025-05-25 22:20:07'),
(6, 'paket umroh 2', 'paket-umroh-2', 'Soetta (CGK), Tangerang', 26000000, '<p>lorem ipsum</p>', '2025-05-25 22:27:44', '2025-05-25 22:27:44'),
(7, 'paket umroh 3', 'paket-umroh-3', 'Soetta (CGK), Tangerang', 26000000, '<p>loremipsum</p>', '2025-05-25 22:29:09', '2025-05-25 22:29:09'),
(8, 'paket umroh 4', 'paket-umroh-4', 'Soetta (CGK), Tangerang', 28000000, '<p>lorem</p>', '2025-05-25 22:30:33', '2025-05-25 22:30:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'haromaintravel@gmail.com', '2025-04-10 11:24:27', '$2y$10$t3YFnyFqQFOoOEpZHwefmeJV19EDfxtlNoxOawThWjXJobybYU1mK', 'JBjZVO55YXle11FN3AtUZSHwHpL1k00EQ2QAoEAVJIlbASsmJx7WZxcfIxmM', 'administrator', '2025-04-09 07:12:46', '2025-05-06 03:30:46'),
(6, 'Fernando Kurniawan', 'frnndokrnwn237@gmail.com', '2025-04-10 10:27:50', '$2y$10$A62fT.zrCctvGbUQckwTXe70BbZ93u9F/U91aHrxs3ukBsHWzSXTq', 'l3psrXmk1jW8Dhsq02byiqhqal2ig35iUFoUtf7uEXieN0LScEKKNiD8gw1N', 'user', '2025-04-10 10:26:17', '2025-05-25 23:53:52'),
(39, 'kurniawan', 'kurniawanhose12@gmail.com', '2025-04-27 06:16:43', '$2y$10$qP/mUK1XaX7RnHgCDsoPAOJVOQLYGfwVYXuWGuOvVrd8uVCFVfknq', NULL, 'user', '2025-04-27 06:16:24', '2025-04-27 06:16:43'),
(58, 'Ketua', 'ketua@ketua.com', '2025-05-06 03:05:46', '$2y$10$XvtcSuB6oExYhgTIsCheJ.iDAlYOnUXoq/7TOdiJU/hMAGC7U9WQu', NULL, 'ketua', '2025-05-06 03:05:46', '2025-05-15 00:18:41'),
(60, 'sekretaris', 'sekre@sekre.com', '2025-05-06 04:00:50', '$2y$10$wrfwIwrdGaAc3eyHr3SS9u2d59LNWzTIXP3lAAn95kUJemiyb9QFe', NULL, 'sekretaris', '2025-05-06 04:00:50', '2025-05-15 00:19:27'),
(61, 'bendahara', 'bendahara@bendahara.com', '2025-05-06 04:24:56', '$2y$10$k8L7c7Q.S4.2ljMrTYkRXOOmlOKpVpEeuzRRYWv6e8eTyA/zVotUa', NULL, 'bendahara', '2025-05-06 04:24:56', '2025-05-15 00:19:36'),
(62, 'administrasi', 'adminisitrasi@administrasi.com', '2025-05-06 04:25:59', '$2y$10$qqhcwLvhTYhZ8AYXP4U5UOziGZo0M1uQClRdujvqDY3DBoOL5pceG', NULL, 'administrasi', '2025-05-06 04:25:59', '2025-05-15 00:19:47'),
(63, 'mfarhan', 'emailcadangan1998@gmail.com', '2025-05-06 05:52:47', '$2y$10$uIYRlqdrnCerM3GEyCiDiurxmsyfc.qKPLLzRGUp7gn7aG4RaF7a6', NULL, 'user', '2025-05-06 05:49:59', '2025-05-06 05:52:47'),
(64, 'taraka', 'tarakabhanu15@gmail.com', '2025-05-06 21:56:51', '$2y$10$xXedfexqfUu.p/GRcBnSDecix/yDMjLrf0W6iEkbTB0miX0cyyqTS', NULL, 'user', '2025-05-06 21:53:53', '2025-05-06 21:56:51'),
(67, 'nando', 'nando@nando.com', '2025-05-25 00:14:26', '$2y$10$neIzDVPjBtwL9C4uvN78m.QswfqxHM4VH2MbMddtO5YuXqwnGeAHW', NULL, 'user', '2025-05-25 00:14:26', '2025-05-25 00:14:26'),
(69, 'Fernando Kurniawan', 'fernandokurniawan4@gmail.com', '2025-05-26 00:39:59', '$2y$10$eQij2OBQGpb0.uBtHJYbmOaBUg3kXq2gYdgN7Wtg217eLfGX7sj.y', NULL, 'user', '2025-05-26 00:39:44', '2025-05-26 00:39:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`),
  ADD KEY `blogs_category_id_foreign` (`category_id`),
  ADD KEY `blogs_reads_index` (`reads`);

--
-- Indeks untuk tabel `blog_images`
--
ALTER TABLE `blog_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_images_blog_id_foreign` (`blog_id`);

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_travel_package_id_foreign` (`travel_package_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_travel_package_id_foreign` (`travel_package_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_booking_id_foreign` (`booking_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `travel_packages`
--
ALTER TABLE `travel_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `travel_packages_slug_unique` (`slug`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `blog_images`
--
ALTER TABLE `blog_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `travel_packages`
--
ALTER TABLE `travel_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ketidakleluasaan untuk tabel `blog_images`
--
ALTER TABLE `blog_images`
  ADD CONSTRAINT `blog_images_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_travel_package_id_foreign` FOREIGN KEY (`travel_package_id`) REFERENCES `travel_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_travel_package_id_foreign` FOREIGN KEY (`travel_package_id`) REFERENCES `travel_packages` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
