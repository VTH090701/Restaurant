-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 29, 2023 lúc 05:28 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlquanan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baiviet`
--

CREATE TABLE `baiviet` (
  `baiviet_id` int(11) NOT NULL,
  `nv_id` int(11) UNSIGNED NOT NULL,
  `baiviet_tieude` tinytext NOT NULL,
  `baiviet_tomtat` text NOT NULL,
  `baiviet_noidung` text NOT NULL,
  `baiviet_tinhtrang` int(10) NOT NULL,
  `baiviet_hinhanh` varchar(200) NOT NULL,
  `baiviet_tgd` datetime NOT NULL,
  `baiviet_tgcn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `baiviet`
--

INSERT INTO `baiviet` (`baiviet_id`, `nv_id`, `baiviet_tieude`, `baiviet_tomtat`, `baiviet_noidung`, `baiviet_tinhtrang`, `baiviet_hinhanh`, `baiviet_tgd`, `baiviet_tgcn`) VALUES
(2, 1, 'Khung giờ vàng chỉ có tại cửa hàng ăn uống TH-Restaurant', '<p>Các khách hàng khi đến ăn trực tiếp tại cửa hàng từ 13:00 - 16:00 PM sẽ được giảm giá 10% cho tổng hóa đơn</p>', '<p>Nhân dịp kỷ niệm 10 năm thành lập. Cửa hàng xin gửi thông báo đến cho các khàng hàng của cửa hàng, 1 ưu đãi giảm 10% trên tổng hóa đơn của khách hàng nhằm để tri ân và cảm ơn khách hàng đã lun tin tưởng và ủng hộ cửa hàng ăn uống của chúng tôi. Lời cuối cùng, nhắn nhủ với khách hàng là hãy nhanh chân đến cửa hàng từ khung giờ 13:00 - 16:00 đến có thể nhận được ưu đãi nhá. Lưu ý ưu đãi chỉ có giá trị trong vòng 1 tuần từ 11/12/2023 - 15/12/2023. Cảm ơn khách hàng của cửa hàng, chúc các khách hàng lun lun sức khỏe.</p><p>TH-Restaurant</p><p>Đường 3/2, quận Ninh Kiều, thành phố Cần Thơ</p>', 1, 'discount10%.jpg', '2023-12-05 01:07:32', '2023-12-27 19:40:55'),
(3, 1, 'Thế nào là một bữa ăn ngon ?', '<p>Ai cũng công nhận ăn uống tại nhà thường ngon hơn vì hợp khẩu vị, bảo đảm dinh dưỡng, an toàn vệ sinh thực phẩm, rẻ tiền và đặc biệt là vui hơn vì được quây quần, trò chuyện với người thân. Tuy nhiên, trong thời buổi công nghiệp, tổ chức tốt và duy trì bữa ăn gia đình là vấn đề không đơn giản. Để giải quyết phần nào điều này, bạn cần nắm rõ 10 bí quyết.</p>', '<p>-<strong>Đa dạng thực phẩm:</strong></p><p>Thực phẩm dù hoàn hảo tới đâu cũng không thể cung cấp đủ dinh dưỡng cho cơ thể. Mỗi ngày, cơ thể cần từ 20 đến 30 loại thực phẩm khác nhau mới bảo đảm đủ chất. Muốn thế, bạn cần phối hợp nhiều loại thực phẩm trong thực đơn, mỗi thứ một ít để làm được nhiều món (mặn, canh, xào, thập cẩm... ) và phải chịu khó đổi món mỗi bữa.<br>- Đủ chứ không cần nhiều:</p><p>Không phải cứ ăn nhiều là đủ vì ăn uống không chừng mực, ăn nhiều hơn so với nhu cầu thì rất có thể dẫn đến các bệnh lý mạn tính có liên quan đến dinh dưỡng (như béo phì, tim mạch, ung thư, đái tháo đường...). Tốt nhất là ăn vừa đủ với nhu cầu của từng người trong từng thời kỳ cụ thể.</p><p>Chẳng hạn, trẻ em và thanh thiếu niên là lứa tuổi đang phát triển nhanh, nhu cầu dinh dưỡng cao thì bữa ăn cần bảo đảm hơn về chất và lượng; người lao động, đặc biệt là lao động nặng, nhu cầu dinh dưỡng sẽ cao hơn người làm việc văn phòng.<br>- Đắt chưa hẳn bổ:</p><p>Bữa ăn nên có cả thực phẩm động vật và thực vật. Nếu ngày nào cũng ăn thịt với trứng mà thiếu cá và đậu hũ thì rối loạn mỡ máu và bệnh tim mạch sẽ đến thăm sớm. Một người trưởng thành mỗi tháng cần ăn 1,5 kg thịt; 2 kg hải sản và 3 kg đậu hũ là có thể cân đối được lượng đạm.</p>', 1, 'about-4.jpg', '2023-12-12 01:01:58', '2023-12-12 01:02:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ban`
--

CREATE TABLE `ban` (
  `ban_id` int(11) UNSIGNED NOT NULL,
  `ban_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ban_tinhtrang` int(10) NOT NULL,
  `ban_slnguoi` int(20) NOT NULL,
  `ban_dat` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ban`
--

INSERT INTO `ban` (`ban_id`, `ban_ten`, `ban_tinhtrang`, `ban_slnguoi`, `ban_dat`, `created_at`, `updated_at`) VALUES
(16, 'Bàn 11', 0, 4, 0, NULL, '2023-12-27 09:46:11'),
(18, 'Bàn 22', 0, 4, 0, NULL, '2023-09-21 08:30:00'),
(19, 'Bàn 33', 0, 6, 0, NULL, '2023-09-21 08:30:04'),
(20, 'Bàn 44', 0, 6, 0, NULL, '2023-09-21 08:30:08'),
(21, 'Bàn 55', 0, 8, 0, NULL, '2023-09-21 08:30:12'),
(22, 'Bàn 66', 0, 8, 0, NULL, '2023-09-21 08:30:16'),
(23, 'Bàn 77', 0, 8, 0, '2023-09-21 18:15:28', NULL),
(24, 'Bàn 88', 0, 2, 0, '2023-09-27 11:56:37', NULL),
(26, 'Mang về', 0, 0, 0, '2023-11-15 12:22:38', NULL),
(27, 'Mang về 11', 0, 0, 0, '2023-12-09 16:25:45', NULL),
(28, 'Mang về 22', 0, 0, 0, '2023-12-09 16:25:53', NULL),
(29, 'Mang về 33', 0, 0, 0, '2023-12-09 16:26:04', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `binhluan_id` int(11) NOT NULL,
  `ma_id` int(11) UNSIGNED NOT NULL,
  `khachhang_id` int(11) UNSIGNED NOT NULL,
  `binhluan_noidung` varchar(255) NOT NULL,
  `binhluan_tinhtrang` int(10) NOT NULL,
  `binhluan_thoigian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`binhluan_id`, `ma_id`, `khachhang_id`, `binhluan_noidung`, `binhluan_tinhtrang`, `binhluan_thoigian`) VALUES
(5, 16, 37, 'Cơm gà ngon lắm tui đã ăn rồi!', 0, '2023-12-03 17:35:05'),
(6, 20, 38, 'Cơm tấm ở đây ngon lắm mng ơi!', 1, '2023-12-12 17:51:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctdinhluong`
--

CREATE TABLE `ctdinhluong` (
  `ctdl_id` int(11) NOT NULL,
  `dl_id` int(11) UNSIGNED NOT NULL,
  `nl_id` int(11) UNSIGNED NOT NULL,
  `ctdl_sl` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ctdinhluong`
--

INSERT INTO `ctdinhluong` (`ctdl_id`, `dl_id`, `nl_id`, `ctdl_sl`) VALUES
(92, 4, 13, 0.1),
(93, 4, 14, 0.1),
(94, 4, 15, 0.15),
(99, 3, 7, 0.25),
(100, 3, 8, 0.35),
(101, 3, 9, 0.1),
(102, 3, 10, 0.1),
(103, 5, 11, 0.35),
(104, 5, 14, 0.1),
(105, 5, 15, 0.15),
(113, 8, 17, 1),
(114, 9, 18, 1),
(115, 10, 24, 1),
(121, 7, 12, 0.15),
(122, 7, 14, 0.1),
(123, 7, 21, 0.1),
(124, 7, 22, 0.1),
(125, 6, 14, 0.1),
(126, 6, 20, 0.35),
(127, 6, 12, 0.15),
(129, 12, 23, 1),
(134, 2, 7, 0.25),
(135, 2, 9, 0.1),
(136, 2, 10, 0.1),
(137, 2, 11, 0.35);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cthoadon`
--

CREATE TABLE `cthoadon` (
  `cthoadon_id` int(10) UNSIGNED NOT NULL,
  `hoadon_id` int(11) UNSIGNED NOT NULL,
  `ma_id` int(11) UNSIGNED NOT NULL,
  `cthoadon_slsp` int(11) NOT NULL,
  `cthoadon_giasp` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cthoadon`
--

INSERT INTO `cthoadon` (`cthoadon_id`, `hoadon_id`, `ma_id`, `cthoadon_slsp`, `cthoadon_giasp`, `created_at`, `updated_at`) VALUES
(765, 248, 28, 12, 35000, NULL, NULL),
(766, 249, 35, 3, 15000, NULL, NULL),
(767, 249, 29, 12, 35000, NULL, NULL),
(829, 294, 28, 1, 35000, NULL, NULL),
(832, 295, 29, 1, 35000, NULL, NULL),
(834, 297, 29, 1, 35000, NULL, NULL),
(882, 326, 19, 10, 35000, NULL, NULL),
(885, 328, 20, 1, 25000, NULL, NULL),
(889, 330, 29, 1, 35000, NULL, NULL),
(890, 330, 35, 1, 15000, NULL, NULL),
(893, 331, 20, 1, 25000, NULL, NULL),
(894, 331, 38, 1, 15000, NULL, NULL),
(895, 331, 28, 1, 35000, NULL, NULL),
(896, 332, 28, 1, 35000, NULL, NULL),
(897, 333, 28, 1, 35000, NULL, NULL),
(898, 334, 19, 1, 35000, NULL, NULL),
(899, 335, 28, 1, 35000, NULL, NULL),
(900, 336, 18, 1, 35000, NULL, NULL),
(912, 351, 18, 1, 35000, NULL, NULL),
(913, 351, 38, 1, 15000, NULL, NULL),
(914, 351, 36, 1, 15000, NULL, NULL),
(1311, 365, 16, 1, 25000, NULL, NULL),
(1312, 365, 38, 1, 15000, NULL, NULL),
(1314, 366, 20, 2, 25000, NULL, NULL),
(1326, 367, 16, 1, 25000, NULL, NULL),
(1327, 367, 35, 1, 15000, NULL, NULL),
(1328, 367, 37, 2, 15000, NULL, NULL),
(1329, 367, 38, 1, 15000, NULL, NULL),
(1401, 373, 35, 1, 15000, NULL, NULL),
(1402, 373, 37, 1, 15000, NULL, NULL),
(1403, 373, 38, 3, 15000, NULL, NULL),
(1404, 373, 36, 1, 15000, NULL, NULL),
(1405, 374, 16, 1, 25000, NULL, NULL),
(1406, 374, 35, 1, 15000, NULL, NULL),
(1407, 375, 28, 1, 35000, NULL, NULL),
(1408, 375, 20, 1, 25000, NULL, NULL),
(1427, 376, 29, 2, 35000, NULL, NULL),
(1428, 376, 37, 1, 15000, NULL, NULL),
(1429, 376, 38, 1, 15000, NULL, NULL),
(1430, 376, 28, 1, 35000, NULL, NULL),
(1434, 378, 16, 2, 25000, NULL, NULL),
(1435, 378, 20, 1, 25000, NULL, NULL),
(1436, 379, 16, 1, 25000, NULL, NULL),
(1439, 381, 28, 1, 35000, NULL, NULL),
(1440, 380, 38, 1, 15000, NULL, NULL),
(1441, 380, 20, 1, 25000, NULL, NULL),
(1442, 382, 19, 1, 35000, NULL, NULL),
(1443, 383, 19, 1, 35000, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctphienlamviec`
--

CREATE TABLE `ctphienlamviec` (
  `ctphien_id` int(10) UNSIGNED NOT NULL,
  `phienlamviec_id` int(11) UNSIGNED NOT NULL,
  `ctphien_motachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctphien_sotienchi` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ctphienlamviec`
--

INSERT INTO `ctphienlamviec` (`ctphien_id`, `phienlamviec_id`, `ctphien_motachi`, `ctphien_sotienchi`, `created_at`, `updated_at`) VALUES
(7, 65, 'Tiền xăng cho nhân viên mua đồ', 50000, NULL, NULL),
(8, 78, '4 kg bánh gạo', 100000, NULL, NULL),
(9, 78, '4 kg bánh gạo', 100000, NULL, NULL),
(10, 80, 'Tiền xăng cho nhân viên mua đồ', 50000, NULL, NULL),
(15, 85, 'Mua 1 bóng đèn', 50000, NULL, NULL),
(16, 85, 'Mua khăn giấy', 100000, NULL, NULL),
(17, 100, 'Mua 1 bóng đèn', 50000, NULL, NULL),
(18, 102, 'Mua 1 bóng đèn', 50000, NULL, NULL),
(19, 103, 'Mua 1 bóng đèn', 50000, NULL, NULL),
(20, 106, 'Mua 1 bóng đèn', 50000, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctphieunhaphang`
--

CREATE TABLE `ctphieunhaphang` (
  `ctnh_id` int(11) NOT NULL,
  `pnh_id` int(11) UNSIGNED NOT NULL,
  `ncc_id` int(11) UNSIGNED NOT NULL,
  `nl_id` int(11) UNSIGNED NOT NULL,
  `ctnh_soluong` int(20) NOT NULL,
  `ctnh_dongia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ctphieunhaphang`
--

INSERT INTO `ctphieunhaphang` (`ctnh_id`, `pnh_id`, `ncc_id`, `nl_id`, `ctnh_soluong`, `ctnh_dongia`) VALUES
(68, 63, 11, 7, 2, 27000),
(69, 63, 13, 8, 2, 150000),
(70, 63, 13, 9, 2, 100000),
(71, 63, 13, 10, 2, 27000),
(72, 63, 13, 11, 2, 27000),
(73, 64, 11, 7, 10, 27000),
(74, 66, 13, 8, 10, 160000),
(75, 66, 13, 11, 10, 110000),
(76, 67, 11, 7, 10, 27000),
(77, 68, 12, 12, 10, 15000),
(80, 76, 13, 13, 5, 160000),
(81, 77, 13, 13, 10, 160000),
(82, 78, 12, 15, 10, 14000),
(83, 78, 13, 14, 10, 15000),
(84, 78, 13, 16, 10, 20000),
(85, 78, 12, 12, 10, 15000),
(86, 78, 13, 20, 5, 150000),
(87, 78, 13, 21, 5, 100000),
(88, 78, 13, 22, 5, 50000),
(89, 79, 14, 24, 10, 7000),
(90, 79, 14, 23, 10, 7000),
(91, 79, 14, 18, 10, 7000),
(92, 79, 14, 17, 10, 7000),
(93, 80, 13, 13, 10, 160000),
(94, 81, 14, 24, 10, 7000),
(95, 81, 14, 23, 10, 7000),
(96, 81, 14, 18, 10, 7000),
(97, 81, 14, 17, 10, 7000),
(98, 82, 13, 7, 10, 27000),
(99, 83, 13, 13, 10, 160000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctquyen`
--

CREATE TABLE `ctquyen` (
  `ctquyen_id` int(11) NOT NULL,
  `quyen_id` int(11) UNSIGNED NOT NULL,
  `nv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ctquyen`
--

INSERT INTO `ctquyen` (`ctquyen_id`, `quyen_id`, `nv_id`) VALUES
(71, 1, 1),
(78, 2, 2),
(63, 3, 3),
(64, 3, 12),
(65, 3, 13),
(66, 3, 14),
(72, 8, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `danhmuc_id` int(10) UNSIGNED NOT NULL,
  `danhmuc_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `danhmuc_mota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `danhmuc_tinhtrang` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`danhmuc_id`, `danhmuc_ten`, `danhmuc_mota`, `danhmuc_tinhtrang`, `created_at`, `updated_at`) VALUES
(3, 'Cơm', 'Các loại cơm như cơm: cơm gà, cơm xào bò,...', 1, '2023-08-22 11:11:44', '2023-10-31 09:28:52'),
(4, 'Phở', 'Các loại phở như: phở bò, phở gà,...', 1, '2023-08-26 02:01:41', NULL),
(12, 'Bún', 'Các loại bún như: bún bò huế,...', 1, '2023-09-12 15:57:26', '2023-11-10 09:08:59'),
(18, 'Nước uống', 'Tất cả các loại nước giải khát cho khách hàng', 1, '2023-11-15 12:08:00', '2023-12-27 06:07:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `datban`
--

CREATE TABLE `datban` (
  `datban_id` int(11) NOT NULL,
  `ban_id` int(11) UNSIGNED NOT NULL,
  `khachhang_id` int(11) UNSIGNED NOT NULL,
  `datban_ten` varchar(100) NOT NULL,
  `datban_email` varchar(100) NOT NULL,
  `datban_sdt` varchar(20) NOT NULL,
  `datban_thoigian` datetime NOT NULL,
  `datban_tinhtrang` int(10) NOT NULL,
  `datban_slnguoi` int(20) NOT NULL,
  `datban_kt` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `datban`
--

INSERT INTO `datban` (`datban_id`, `ban_id`, `khachhang_id`, `datban_ten`, `datban_email`, `datban_sdt`, `datban_thoigian`, `datban_tinhtrang`, `datban_slnguoi`, `datban_kt`) VALUES
(72, 16, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '091454957', '2023-11-20 15:00:00', 1, 3, 1),
(73, 16, 39, 'Lý Trọng Nhân', 'nhan@gmail.com', '0914549811', '2023-11-20 20:00:00', 1, 4, 1),
(76, 20, 39, 'Lý Trọng Nhân', 'nhan@gmail.com', '0914549822', '2023-11-24 14:50:00', 1, 3, 1),
(78, 16, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0123456789', '2023-09-12 18:57:00', 1, 3, 1),
(84, 16, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0123456789', '2023-10-04 18:15:00', 2, 3, 0),
(85, 18, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0914549857', '2023-07-03 15:30:00', 1, 3, 1),
(86, 16, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0944521926', '2023-08-07 20:00:00', 1, 3, 1),
(87, 20, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\n', '0914549811', '2023-06-12 20:00:00', 1, 4, 1),
(88, 21, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\n', '0914549811', '2023-04-17 20:00:00', 1, 4, 1),
(89, 21, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\n', '0914549811', '2023-05-10 20:00:00', 1, 4, 1),
(90, 18, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\n', '0914549811', '2023-03-06 20:00:00', 1, 4, 1),
(91, 19, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\n', '0914549811', '2023-02-15 20:00:00', 1, 4, 1),
(92, 18, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-01-23 20:00:00', 1, 4, 1),
(93, 20, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-01-15 20:00:00', 1, 4, 1),
(94, 18, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-12-03 20:00:00', 1, 4, 1),
(95, 22, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-02-13 20:00:00', 1, 4, 1),
(96, 22, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-03-06 20:00:00', 1, 4, 1),
(97, 22, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-03-05 20:00:00', 1, 4, 1),
(98, 22, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-05-11 20:00:00', 1, 4, 1),
(99, 19, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-06-13 20:00:00', 1, 4, 1),
(100, 24, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-07-05 20:00:00', 1, 4, 1),
(101, 20, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-11-02 20:00:00', 1, 4, 1),
(102, 20, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-11-11 20:00:00', 1, 4, 1),
(103, 19, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-07-06 20:00:00', 2, 4, 1),
(104, 19, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-09-14 20:00:00', 1, 4, 1),
(105, 20, 39, 'Lý Trọng Nhân', 'nhan@gmail.com', '0914549822', '2023-08-02 14:50:00', 1, 3, 1),
(106, 16, 39, 'Lý Trọng Nhân', 'nhan@gmail.com', '0914549822', '2023-10-03 14:50:00', 1, 3, 1),
(107, 18, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-09-04 20:00:00', 1, 4, 1),
(108, 19, 39, 'Lý Trọng Nhân', 'nhan@gmail.com', '0914549811', '2023-09-13 20:00:00', 1, 4, 1),
(109, 19, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com\r\n', '0914549811', '2023-10-18 20:00:00', 1, 4, 1),
(110, 18, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0914549857', '2023-12-12 19:00:00', 1, 3, 1),
(111, 24, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0944521926', '2023-12-12 18:00:00', 1, 2, 0),
(112, 18, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0914549857', '2023-12-13 20:00:00', 2, 4, 0),
(113, 18, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0914549857', '2023-12-13 14:00:00', 1, 4, 1),
(114, 20, 39, 'Lý Trọng Nhân', 'nhan@gmail.com', '0914549822', '2023-12-13 14:50:00', 1, 3, 2),
(115, 16, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0944521926', '2023-12-13 19:00:00', 2, 4, 0),
(116, 19, 39, 'Lý Trọng Nhân', 'nhan@gamil.com', '0944521926', '2023-12-14 15:00:00', 2, 5, 0),
(117, 19, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0914549822', '2023-12-14 14:00:00', 1, 5, 0),
(118, 16, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '1234567890', '2023-12-28 09:57:00', 2, 3, 0),
(119, 16, 38, 'Võ Thanh Hiếu', 'thanhhieu090701@gmail.com', '0123456789', '2023-12-28 19:03:00', 0, 3, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dinhluong`
--

CREATE TABLE `dinhluong` (
  `dl_id` int(11) UNSIGNED NOT NULL,
  `ma_id` int(11) UNSIGNED NOT NULL,
  `dl_dvt` varchar(100) NOT NULL,
  `dl_trangthai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dinhluong`
--

INSERT INTO `dinhluong` (`dl_id`, `ma_id`, `dl_dvt`, `dl_trangthai`) VALUES
(2, 16, 'dĩa', 1),
(3, 20, 'dĩa', 1),
(4, 18, 'tô', 1),
(5, 19, 'tô', 1),
(6, 28, 'tô', 1),
(7, 29, 'tô', 1),
(8, 36, 'lon', 1),
(9, 37, 'lon', 1),
(10, 38, 'lon', 1),
(12, 35, 'lon', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giamgia`
--

CREATE TABLE `giamgia` (
  `gg_id` int(11) UNSIGNED NOT NULL,
  `gg_ten` varchar(150) NOT NULL,
  `gg_stg` int(50) NOT NULL,
  `gg_tinhnang` int(11) NOT NULL,
  `gg_soluong` int(11) NOT NULL,
  `gg_magiam` varchar(50) NOT NULL,
  `gg_ngaybd` date NOT NULL,
  `gg_ngaykt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giamgia`
--

INSERT INTO `giamgia` (`gg_id`, `gg_ten`, `gg_stg`, `gg_tinhnang`, `gg_soluong`, `gg_magiam`, `gg_ngaybd`, `gg_ngaykt`) VALUES
(5, 'Giảm giá khung giờ vàng', 10, 2, 9, '12122023PT', '2023-12-12', '2023-12-16'),
(6, 'Giảm giá khung giờ vàng', 10000, 1, 9, '12122023', '2023-12-12', '2023-12-16'),
(7, 'Giảm giá kỷ niệm thành lập', 10000, 1, 20, 'KT03122023', '2023-12-03', '2023-12-05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanh`
--

CREATE TABLE `hinhanh` (
  `hinhanh_id` int(11) NOT NULL,
  `hinhanh_ten` varchar(100) NOT NULL,
  `hinhanh_anh` varchar(100) NOT NULL,
  `ma_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hinhanh`
--

INSERT INTO `hinhanh` (`hinhanh_id`, `hinhanh_ten`, `hinhanh_anh`, `ma_id`) VALUES
(8, 'Phở_bò.jpeg', 'Phở_bò.jpeg', 18),
(16, 'Cơm_tấm1.jpeg', 'Cơm_tấm1.jpeg', 20),
(18, 'Cơm_tấm.jpeg', 'Cơm_tấm.jpeg', 20),
(19, 'Cơm_tấm2.jpg', 'Cơm_tấm2.jpg', 20),
(20, 'Cơm_gà.jpg', 'Cơm_gà.jpg', 16),
(21, 'Cơm_gà1.jpg', 'Cơm_gà1.jpg', 16),
(22, 'Cơm_gà2.jpg', 'Cơm_gà2.jpg', 16);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `hoadon_id` int(10) UNSIGNED NOT NULL,
  `nv_id` int(11) UNSIGNED NOT NULL,
  `phienlamviec_id` int(11) UNSIGNED NOT NULL,
  `ban_id` int(11) UNSIGNED NOT NULL,
  `khachhang_id` int(11) UNSIGNED NOT NULL,
  `gg_id` int(11) UNSIGNED DEFAULT NULL,
  `hoadon_tinhtrang` int(10) NOT NULL,
  `hoadon_tongtien` int(20) NOT NULL,
  `hoadon_ghichu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hoadon_httt` int(11) NOT NULL,
  `hoadon_ngaytao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`hoadon_id`, `nv_id`, `phienlamviec_id`, `ban_id`, `khachhang_id`, `gg_id`, `hoadon_tinhtrang`, `hoadon_tongtien`, `hoadon_ghichu`, `hoadon_httt`, `hoadon_ngaytao`, `created_at`, `updated_at`) VALUES
(248, 8, 90, 20, 38, NULL, 3, 1150000, 'Không', 1, '2023-09-12 17:25:00', NULL, NULL),
(249, 8, 81, 16, 37, NULL, 3, 1500000, 'Không', 1, '2023-02-12 17:22:25', NULL, NULL),
(294, 8, 95, 16, 37, NULL, 3, 1150000, 'Không', 1, '2023-04-12 17:18:33', NULL, NULL),
(295, 8, 82, 18, 37, NULL, 3, 50000, 'Không', 1, '2023-01-08 18:29:57', NULL, NULL),
(297, 1, 80, 16, 37, NULL, 3, 35000, 'Không', 2, '2023-07-05 05:42:11', NULL, NULL),
(326, 8, 97, 19, 41, NULL, 3, 1350000, 'Không', 1, '2023-01-12 17:16:31', NULL, NULL),
(328, 8, 96, 19, 37, NULL, 3, 1140000, 'Không', 1, '2023-03-12 17:18:09', NULL, NULL),
(330, 8, 98, 16, 37, NULL, 3, 1600000, 'Không', 1, '2023-02-12 17:17:15', NULL, NULL),
(331, 8, 94, 16, 37, NULL, 3, 1175000, 'Không', 1, '2023-05-12 17:19:39', NULL, NULL),
(332, 8, 91, 19, 37, NULL, 3, 35000, 'Không', 1, '2023-08-13 18:15:12', NULL, NULL),
(333, 1, 84, 18, 43, NULL, 3, 35000, 'Không', 1, '2023-11-30 18:19:02', NULL, NULL),
(334, 1, 84, 19, 37, NULL, 3, 35000, 'Không', 1, '2023-11-30 18:15:43', NULL, NULL),
(335, 8, 92, 20, 37, NULL, 3, 1350000, 'Không', 1, '2023-07-12 17:21:05', NULL, NULL),
(336, 1, 87, 16, 39, NULL, 3, 35000, 'Không', 3, '2023-09-05 16:27:21', NULL, NULL),
(337, 10, 87, 16, 39, NULL, 3, 35000, 'Không', 3, '2023-12-08 16:27:21', NULL, NULL),
(338, 8, 93, 21, 37, NULL, 3, 1250000, 'Không', 1, '2023-06-12 17:20:18', NULL, NULL),
(342, 11, 80, 20, 37, NULL, 3, 50000, 'Không', 1, '2023-11-20 03:57:13', NULL, NULL),
(344, 1, 81, 20, 37, NULL, 3, 50000, 'Không', 1, '2023-10-30 03:32:47', NULL, NULL),
(345, 10, 79, 16, 37, NULL, 3, 35000, 'Không', 2, '2023-01-27 05:42:11', NULL, NULL),
(346, 10, 81, 19, 43, NULL, 3, 35000, 'Không', 1, '2023-09-06 12:48:31', NULL, NULL),
(347, 11, 87, 16, 38, NULL, 3, 35000, 'Không', 3, '2023-12-07 16:27:21', NULL, NULL),
(348, 8, 89, 18, 38, NULL, 3, 1350000, 'Không', 1, '2023-08-12 17:23:00', NULL, NULL),
(349, 8, 89, 20, 43, NULL, 3, 1350000, 'Không', 1, '2023-10-12 17:25:52', NULL, NULL),
(350, 8, 97, 20, 43, NULL, 3, 100000, 'Không', 1, '2023-01-12 17:14:02', NULL, NULL),
(351, 1, 88, 16, 37, NULL, 3, 65000, 'Không', 1, '2023-12-10 15:19:24', NULL, NULL),
(365, 1, 100, 18, 39, NULL, 3, 40000, 'Không', 1, '2023-12-11 12:55:49', NULL, NULL),
(366, 1, 101, 16, 37, NULL, 3, 50000, 'Không', 1, '2023-12-11 18:46:47', NULL, NULL),
(367, 1, 102, 16, 37, NULL, 3, 85000, 'Không', 1, '2023-12-12 13:10:22', NULL, NULL),
(373, 1, 102, 19, 39, NULL, 3, 90000, 'Không', 1, '2023-12-12 13:10:25', NULL, NULL),
(374, 1, 103, 16, 37, 6, 3, 30000, 'Không', 1, '2023-12-12 13:22:53', NULL, NULL),
(375, 1, 103, 16, 38, 5, 3, 54000, 'Không', 1, '2023-12-12 13:25:42', NULL, NULL),
(376, 1, 104, 16, 37, NULL, 3, 135000, 'Không', 1, '2023-12-12 17:29:03', NULL, NULL),
(377, 8, 90, 20, 38, NULL, 3, 1150000, 'Không', 1, '2023-11-02 17:25:00', NULL, NULL),
(378, 1, 104, 16, 39, NULL, 3, 75000, 'Không', 1, '2023-12-13 04:03:16', NULL, NULL),
(379, 1, 105, 16, 43, NULL, 3, 25000, 'Không', 1, '2023-12-13 05:46:39', NULL, NULL),
(380, 1, 106, 19, 37, NULL, 3, 40000, 'Không', 1, '2023-12-17 12:55:30', NULL, NULL),
(381, 1, 106, 18, 37, NULL, 3, 35000, 'Không', 1, '2023-12-13 06:53:47', NULL, NULL),
(382, 1, 106, 16, 37, NULL, 3, 35000, 'Không', 1, '2023-12-21 05:13:31', NULL, NULL),
(383, 1, 106, 16, 37, NULL, 3, 35000, 'Không', 1, '2023-12-27 11:36:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `khachhang_id` int(10) UNSIGNED NOT NULL,
  `khachhang_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_sdt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_hinhanh` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_diachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_matkhau` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_trangthai` int(10) NOT NULL,
  `khachhang_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`khachhang_id`, `khachhang_ten`, `khachhang_sdt`, `khachhang_hinhanh`, `khachhang_diachi`, `khachhang_email`, `khachhang_matkhau`, `khachhang_trangthai`, `khachhang_token`, `created_at`, `updated_at`) VALUES
(37, 'Phan Thành Tấn', '0944521926', 'avatar_user.png', 'Tỉnh Cà Mau , Thành phố Cà Mau , Phường 5, đường Trần Hưng Đạo', 'tan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, NULL, NULL),
(38, 'Hiếu khách hàng', '0914549857', 'avatar_user.png', 'Tỉnh Cà Mau , Thành phố Cà Mau , Phường 5, đường Phan Ngọc Hiển', 'thanhhieu090701@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, NULL, NULL),
(39, 'Lý Trọng Nhân', '0914549850', 'avatar_user.png', 'Tỉnh Cà Mau , Thành phố Cà Mau , Phường 9, hẻm 132', 'nhan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, NULL, NULL),
(41, 'Trương Phương Linh', '01234567819', 'avatar_user.png', 'Tỉnh Cà Mau , Thành phố Cà Mau , Phường 5, đường Phan Ngọc Hiển', 'linh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, NULL, NULL),
(43, 'Huỳnh Chí Đoàn', '0914549111', 'avatar_user.png', 'Tỉnh Cà Mau , Thành phố Cà Mau , Phường 5, đường Trần Hưng Đạo', 'doan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mailsettings`
--

CREATE TABLE `mailsettings` (
  `mail_id` int(11) NOT NULL,
  `mail_transport` varchar(255) NOT NULL,
  `mail_host` varchar(255) NOT NULL,
  `mail_port` varchar(255) NOT NULL,
  `mail_user` varchar(255) NOT NULL,
  `mail_password` varchar(255) NOT NULL,
  `mail_encryption` varchar(255) NOT NULL,
  `mail_from` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `mailsettings`
--

INSERT INTO `mailsettings` (`mail_id`, `mail_transport`, `mail_host`, `mail_port`, `mail_user`, `mail_password`, `mail_encryption`, `mail_from`) VALUES
(2, 'smtp', 'smtp.googlemail.com', '465', 'thanhhieu090701@gmail.com', 'ymahbywxoziycqrv', 'ssl', 'thanhhieu090701@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_22_085737_create_tbl_admin_table', 1),
(6, '2023_08_22_113449_create_tbl_category', 2),
(7, '2023_08_22_183929_create_tbl_product', 3),
(8, '2023_08_23_172022_create_tbl_table', 4),
(9, '2023_08_24_171047_create_tbl_customer', 5),
(10, '2023_08_27_072204_create_tbl_bill', 6),
(11, '2023_08_27_072621_create_tbl_billdetail', 7),
(12, '2023_08_27_072903_create_tbl_bill', 8),
(13, '2023_09_10_130825_create_tbl_shift', 9),
(14, '2023_09_10_171739_create_tbl_shift', 10),
(15, '2023_09_27_142808_create_tbl_detailsshift', 11),
(16, '2023_09_27_143202_create_tbl_detailsshift', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monan`
--

CREATE TABLE `monan` (
  `ma_id` int(10) UNSIGNED NOT NULL,
  `danhmuc_id` int(11) UNSIGNED NOT NULL,
  `ma_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_mota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_noidung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_gia` int(20) NOT NULL,
  `ma_hinhanh` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_tinhtrang` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monan`
--

INSERT INTO `monan` (`ma_id`, `danhmuc_id`, `ma_ten`, `ma_mota`, `ma_noidung`, `ma_gia`, `ma_hinhanh`, `ma_tinhtrang`, `created_at`, `updated_at`) VALUES
(16, 3, 'Cơm gà', 'Cơm gà là món ăn được chế biến và trình bày với hình thức cơm và thịt gà. Cơm có thể dùng là cơm trắng hoặc cơm chiên, cơm rang và thịt gà được trình bày thông thường là đùi gà hay cánh gà. Món cơm gà tương đối dễ làm và phổ biến.', 'Không', 25000, 'Cơm_gà.jpg', 1, NULL, NULL),
(18, 4, 'Phở bò', 'Không', 'Không', 35000, 'Phở_bò.jpeg', 1, NULL, NULL),
(19, 4, 'Phở gà', 'Không', 'Không', 35000, 'Phờ_gà.jpg', 1, NULL, NULL),
(20, 3, 'Cơm tấm', 'Không', 'Không', 25000, 'Cơm_tấm1.jpeg', 1, NULL, NULL),
(28, 12, 'Bún riêu cua', 'Không', 'Không', 35000, 'Bún_riêu.jpg', 1, NULL, NULL),
(29, 12, 'Bún mắm', 'Không', 'Không', 35000, 'Bún_mắm.jpg', 1, NULL, NULL),
(35, 18, 'CoCa', 'Nước uống có ga', 'Không', 15000, 'CoCa.jpg', 1, NULL, NULL),
(36, 18, 'String', 'Nước uống có ga', 'Không', 15000, 'Sting.jpg', 1, NULL, NULL),
(37, 18, 'Pepsi', 'Nước uống có ga', 'Không', 15000, 'Pepsi.jpg', 1, NULL, NULL),
(38, 18, '7up', 'Nước uống có ga', 'Không', 15000, '7up.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguyenlieu`
--

CREATE TABLE `nguyenlieu` (
  `nl_id` int(11) UNSIGNED NOT NULL,
  `nl_ten` varchar(100) NOT NULL,
  `nl_dvt` varchar(50) NOT NULL,
  `nl_tinhtrang` int(10) NOT NULL,
  `nl_slcl` float NOT NULL,
  `nl_slsd` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nguyenlieu`
--

INSERT INTO `nguyenlieu` (`nl_id`, `nl_ten`, `nl_dvt`, `nl_tinhtrang`, `nl_slcl`, `nl_slsd`) VALUES
(7, 'Gạo', 'kilogam', 1, 18, 10.5),
(8, 'Thịt heo', 'kilogam', 1, 8.95, 1.05),
(9, 'Cà chua', 'kilogam', 1, 3.7, 5.5),
(10, 'Dưa leo', 'Kilogam', 1, 3.7, 5.5),
(11, 'Thịt gà', 'kilogam', 1, 6.9, 11.9),
(12, 'Bún gạo', 'kilogam', 1, 19.55, 0.45),
(13, 'Thịt bò', 'kilogam', 1, 10.5, 0),
(14, 'Giá đỗ', 'kilogam', 1, 9.1, 0.7),
(15, 'Bánh phở', 'kilogam', 1, 10, 0.3),
(16, 'Xà lách', 'kilogam', 1, 10, 0),
(17, 'Sting', 'lon', 1, 19, 2),
(18, 'Pepsi', 'lon', 1, 23, 2),
(20, 'Cua đồng', 'kilogam', 1, 2.9, 1.05),
(21, 'Cá lóc', 'kilogam', 1, 5, 0.3),
(22, 'Tép', 'kilogam', 1, 5, 0.3),
(23, 'Coca', 'lon', 1, 18, 2),
(24, '7up', 'lon', 1, 16, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `ncc_id` int(11) UNSIGNED NOT NULL,
  `ncc_ten` varchar(100) NOT NULL,
  `ncc_sdt` varchar(20) NOT NULL,
  `ncc_email` varchar(100) NOT NULL,
  `ncc_diachi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`ncc_id`, `ncc_ten`, `ncc_sdt`, `ncc_email`, `ncc_diachi`) VALUES
(11, 'Vựa gạo', '0914549833', 'gao@gmail.com', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, chợ Xuân Khánh'),
(12, 'Lò bún', '0914549822', 'bun@gmail.com', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, chợ Xuân Khánh'),
(13, 'Chợ Xuân Khánh', '0914549811', 'choxuankhanh@gmail.com', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, chợ Xuân Khánh'),
(14, 'Công ty TNHH Bạch Đằng', '02923846934', 'bachdang@gamil.com', 'Thành phố Cần Thơ , Quận Cái Răng , Phường Lê Bình, 605A');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `nv_id` int(10) UNSIGNED NOT NULL,
  `nv_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nv_matkhau` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nv_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nv_sdt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nv_hinhanh` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nv_diachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nv_tinhtrang` int(10) NOT NULL,
  `nv_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`nv_id`, `nv_email`, `nv_matkhau`, `nv_ten`, `nv_sdt`, `nv_hinhanh`, `nv_diachi`, `nv_tinhtrang`, `nv_token`, `created_at`, `updated_at`) VALUES
(1, 'thanhhieu090701@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Võ Thanh Hiếu', '1234567890', 'avatar.png', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, Đường 30/4', 1, NULL, NULL, NULL),
(2, 'nvphucvu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên phục vụ', '1234567890', 'avatar_user1.png', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, Đường 3/2', 1, '', NULL, NULL),
(3, 'nvbep@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên phục bếp', '1234567890', 'Đầu_bếp_1.jpg', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, Đường 3/2', 1, '', NULL, NULL),
(8, 'nvphucvu2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên phục vụ 2', '914549851', 'avatar_user1.png', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, đường 3/2', 1, NULL, NULL, NULL),
(10, 'nvphucvu1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên phục vụ 1', '914549811', 'avatar_user1.png', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, đường 3/2', 1, NULL, NULL, NULL),
(11, 'nvphucvu3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên phục vụ 3', '914549800', 'avatar_user1.png', 'Tỉnh Cà Mau , Thành phố Cà Mau , Phường 5, đường Phan Ngọc Hiển', 1, NULL, NULL, NULL),
(12, 'nvbep1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên bếp 1', '914549111', 'Đầu_bếp_2.jpg', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, đường 3/2', 1, NULL, NULL, NULL),
(13, 'nvbep2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên bếp 2', '914549112', 'Đầu_bếp_3.jpg', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, đường 3/2', 1, NULL, NULL, NULL),
(14, 'nvbep3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên bếp 3', '914549113', 'Đầu_bếp_4.jpg', 'Thành phố Cần Thơ , Quận Ninh Kiều , Phường Xuân Khánh, đường 3/2', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phienlamviec`
--

CREATE TABLE `phienlamviec` (
  `phienlamviec_id` int(11) UNSIGNED NOT NULL,
  `nv_id` int(11) UNSIGNED NOT NULL,
  `phienlamviec_tt` int(10) NOT NULL,
  `phienlamviec_dt` int(20) NOT NULL,
  `phienlamviec_tc` int(20) NOT NULL,
  `phienlamviec_gc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phienlamviec_tgbd` datetime NOT NULL,
  `phienlamviec_tgkt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phienlamviec`
--

INSERT INTO `phienlamviec` (`phienlamviec_id`, `nv_id`, `phienlamviec_tt`, `phienlamviec_dt`, `phienlamviec_tc`, `phienlamviec_gc`, `phienlamviec_tgbd`, `phienlamviec_tgkt`) VALUES
(79, 1, 1, 15000, 0, NULL, '2023-11-24 16:58:50', '2023-11-24 16:59:59'),
(80, 1, 1, 45000, 50000, NULL, '2023-11-24 17:00:07', '2023-11-24 17:03:20'),
(81, 1, 1, 230000, 0, NULL, '2023-11-24 18:00:19', '2023-11-25 18:43:28'),
(82, 1, 1, 260000, 0, NULL, '2023-11-25 18:44:22', '2023-11-25 23:14:45'),
(83, 1, 1, 140000, 0, NULL, '2023-11-25 23:14:57', '2023-11-26 01:22:43'),
(84, 1, 1, 180000, 0, NULL, '2023-11-26 22:35:43', '2023-12-01 00:13:00'),
(85, 1, 1, 35000, 150000, NULL, '2023-12-01 00:55:06', '2023-12-01 01:18:55'),
(86, 1, 1, 0, 0, NULL, '2023-12-01 01:19:07', '2023-12-03 23:47:52'),
(87, 1, 1, 35000, 0, NULL, '2023-12-07 00:01:21', '2023-12-09 14:43:38'),
(88, 1, 1, 65000, 0, NULL, '2023-12-09 15:27:43', '2023-12-09 21:15:42'),
(89, 8, 1, 85000, 0, NULL, '2023-10-17 01:19:07', '2023-10-17 23:47:52'),
(90, 8, 1, 50000, 0, NULL, '2023-09-12 01:19:07', '2023-09-12 23:47:52'),
(91, 8, 1, 35000, 0, NULL, '2023-08-14 01:19:07', '2023-08-14 23:47:52'),
(92, 8, 1, 35000, 0, NULL, '2023-07-10 01:19:07', '2023-07-10 23:47:52'),
(93, 8, 1, 75000, 0, NULL, '2023-06-09 01:19:07', '2023-06-09 23:47:52'),
(94, 8, 1, 75000, 0, NULL, '2023-05-08 01:19:07', '2023-05-08 23:47:52'),
(95, 8, 1, 50000, 0, NULL, '2023-04-07 01:19:07', '2023-04-07 23:47:52'),
(96, 8, 1, 40000, 0, NULL, '2023-03-06 01:19:07', '2023-03-06 23:47:52'),
(97, 8, 1, 85000, 0, NULL, '2023-01-04 01:19:07', '2023-01-04 23:47:52'),
(98, 8, 1, 50000, 0, NULL, '2023-02-05 01:19:07', '2023-02-05 23:47:52'),
(99, 1, 1, 905000, 0, NULL, '2023-12-10 22:19:20', '2023-12-11 19:46:25'),
(100, 1, 1, 40000, 50000, NULL, '2023-12-11 19:46:53', '2023-12-12 00:13:36'),
(101, 1, 1, 50000, 0, NULL, '2023-12-12 01:42:44', '2023-12-12 15:25:37'),
(102, 1, 1, 610000, 50000, NULL, '2023-12-12 15:25:55', '2023-12-12 20:09:30'),
(103, 1, 1, 100000, 50000, NULL, '2023-12-12 20:11:24', '2023-12-12 20:26:12'),
(104, 1, 1, 210000, 0, NULL, '2023-12-12 23:13:41', '2023-12-13 11:03:02'),
(105, 1, 1, 25000, 0, NULL, '2023-12-13 12:33:12', '2023-12-13 12:46:46'),
(106, 1, 0, 145000, 50000, NULL, '2023-12-13 13:45:30', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhaphang`
--

CREATE TABLE `phieunhaphang` (
  `pnh_id` int(11) UNSIGNED NOT NULL,
  `nv_id` int(11) UNSIGNED NOT NULL,
  `pnh_ngaylapphieu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pnh_thanhtien` int(20) NOT NULL,
  `pnh_ghichu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phieunhaphang`
--

INSERT INTO `phieunhaphang` (`pnh_id`, `nv_id`, `pnh_ngaylapphieu`, `pnh_thanhtien`, `pnh_ghichu`) VALUES
(66, 1, '2023-11-29 16:28:58', 2700000, 'Không'),
(67, 1, '2023-11-24 08:17:48', 270000, 'Không'),
(68, 1, '2023-11-29 16:28:20', 150000, 'Không'),
(76, 1, '2023-11-28 18:59:00', 800000, 'Không'),
(77, 1, '2023-11-30 19:03:00', 1600000, 'Không'),
(78, 1, '2023-12-08 14:03:00', 2140000, 'Không'),
(79, 1, '2023-12-08 14:27:00', 280000, 'Không'),
(80, 1, '2023-12-12 08:45:00', 1600000, 'Không'),
(81, 1, '2023-12-13 04:31:00', 280000, 'Không'),
(82, 1, '2023-12-13 06:57:00', 270000, 'Không'),
(83, 1, '2023-12-28 03:44:00', 1600000, 'không');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `quyen_id` int(11) NOT NULL,
  `quyen_ten` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`quyen_id`, `quyen_ten`) VALUES
(1, 'admin'),
(2, 'nhanvien_pv'),
(3, 'nhanvien_bep');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongke`
--

CREATE TABLE `thongke` (
  `thongke_id` int(11) NOT NULL,
  `thongke_ngay` date NOT NULL,
  `thongke_dt` int(20) NOT NULL,
  `thongke_cp` int(20) NOT NULL,
  `thongke_sl` int(20) NOT NULL,
  `thongke_thd` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thongke`
--

INSERT INTO `thongke` (`thongke_id`, `thongke_ngay`, `thongke_dt`, `thongke_cp`, `thongke_sl`, `thongke_thd`) VALUES
(1, '2023-10-05', 7000000, 270000, 10, 5),
(2, '2023-10-06', 8000000, 0, 20, 7),
(3, '2023-09-27', 8000000, 0, 20, 7),
(4, '2023-09-30', 8000000, 0, 20, 7),
(5, '2023-08-30', 10000000, 0, 20, 7),
(6, '2023-07-30', 11000000, 0, 16, 8),
(7, '2023-06-30', 10500000, 0, 13, 9),
(8, '2023-05-30', 11000000, 0, 14, 10),
(9, '2022-04-06', 11050000, 0, 15, 10),
(10, '2023-03-30', 10250000, 0, 15, 10),
(11, '2023-02-02', 11250000, 0, 18, 12),
(12, '2023-01-02', 11500000, 0, 18, 13),
(25, '2023-10-30', 430000, 5400000, 14, 4),
(40, '2023-10-31', 105000, 270000, 5, 3),
(43, '2023-11-04', 165000, 0, 5, 3),
(44, '2023-11-06', 60000, 0, 2, 1),
(45, '2023-11-08', 0, 0, 0, 0),
(46, '2023-11-09', 0, 0, 0, 0),
(47, '2023-11-10', 25000, 0, 1, 1),
(48, '2023-11-11', 195000, 0, 6, 2),
(49, '2023-11-12', 22500, 0, 1, 1),
(50, '2023-11-13', 183000, 0, 8, 8),
(51, '2023-11-14', 120000, 0, 5, 2),
(52, '2023-11-15', 0, 0, 0, 0),
(53, '2023-11-17', 90000, 0, 4, 2),
(54, '2023-11-18', 0, 0, 0, 0),
(55, '2023-11-19', 75000, 50000, 3, 2),
(56, '2023-11-20', 570000, 0, 26, 17),
(57, '2023-11-22', 130000, 0, 6, 3),
(58, '2023-11-24', 105000, 670000, 3, 2),
(59, '2023-11-25', 250000, 0, 10, 4),
(60, '2023-11-26', 125000, 0, 5, 2),
(61, '2023-11-29', 0, 881000, 0, 0),
(63, '2023-12-01', 140000, 3350000, 4, 4),
(64, '2023-12-08', 35000, 2420000, 1, 1),
(65, '2023-12-10', 65000, 0, 3, 1),
(66, '2023-12-11', 40000, 50000, 2, 1),
(67, '2023-12-12', 309000, 1700000, 17, 5),
(68, '2022-01-03', 11500000, 0, 18, 13),
(69, '2022-02-02', 11250000, 0, 18, 12),
(70, '2022-03-09', 10250000, 0, 15, 10),
(71, '2022-05-04', 11000000, 0, 14, 10),
(72, '2022-06-08', 10500000, 0, 13, 9),
(73, '2022-07-14', 11000000, 0, 16, 8),
(74, '2023-08-30', 10000000, 0, 20, 7),
(75, '2022-09-15', 8000000, 0, 20, 7),
(76, '2022-10-07', 8000000, 0, 20, 7),
(77, '2022-11-09', 11000000, 0, 14, 10),
(78, '2022-12-08', 11000000, 0, 14, 10),
(79, '2023-04-06', 10250000, 0, 15, 10),
(80, '2022-08-03', 11050000, 0, 15, 10),
(81, '2023-12-13', 270000, 600000, 10, 4),
(82, '2023-12-17', 40000, 0, 2, 1),
(83, '2023-12-21', 35000, 0, 1, 1),
(84, '2023-12-27', 35000, 0, 1, 1),
(85, '2023-12-28', 0, 1600000, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinnhan`
--

CREATE TABLE `tinnhan` (
  `tn_id` bigint(11) NOT NULL,
  `nv_id_tntu` int(11) UNSIGNED NOT NULL,
  `nv_id_tnden` int(11) UNSIGNED NOT NULL,
  `tn_tinnhan` text NOT NULL,
  `tn_daxem` tinyint(4) NOT NULL,
  `tn_thoigian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tinnhan`
--

INSERT INTO `tinnhan` (`tn_id`, `nv_id_tntu`, `nv_id_tnden`, `tn_tinnhan`, `tn_daxem`, `tn_thoigian`) VALUES
(522, 3, 1, 'Quản lý ơi, bếp hết nguyên liệu gạo rồi ?', 1, '2023-11-25 16:24:18'),
(523, 3, 1, 'Nhập thêm các nguyên liệu đi', 1, '2023-11-25 16:24:18'),
(524, 1, 3, 'Ok để quản lý nhập thêm', 1, '2023-11-25 16:24:27'),
(525, 3, 2, 'ALo', 1, '2023-12-21 05:28:39'),
(526, 3, 1, 'Alo món cơm gà không đủ nguyên liệu', 1, '2023-12-13 06:50:25'),
(527, 1, 3, 'ok để kêu khách hàng đổi món', 1, '2023-12-13 06:50:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`baiviet_id`);

--
-- Chỉ mục cho bảng `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`ban_id`);

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`binhluan_id`),
  ADD KEY `sp_id` (`ma_id`,`khachhang_id`),
  ADD KEY `binhluan_ibfk_2` (`khachhang_id`);

--
-- Chỉ mục cho bảng `ctdinhluong`
--
ALTER TABLE `ctdinhluong`
  ADD PRIMARY KEY (`ctdl_id`),
  ADD KEY `dl_id` (`dl_id`,`nl_id`),
  ADD KEY `ctdinhluong_ibfk_2` (`nl_id`);

--
-- Chỉ mục cho bảng `cthoadon`
--
ALTER TABLE `cthoadon`
  ADD PRIMARY KEY (`cthoadon_id`),
  ADD KEY `hoadon_id` (`hoadon_id`,`ma_id`),
  ADD KEY `cthoadon_ibfk_2` (`ma_id`);

--
-- Chỉ mục cho bảng `ctphienlamviec`
--
ALTER TABLE `ctphienlamviec`
  ADD PRIMARY KEY (`ctphien_id`),
  ADD KEY `phienlamviec_id` (`phienlamviec_id`);

--
-- Chỉ mục cho bảng `ctphieunhaphang`
--
ALTER TABLE `ctphieunhaphang`
  ADD PRIMARY KEY (`ctnh_id`),
  ADD KEY `pnh_id` (`pnh_id`,`ncc_id`,`nl_id`),
  ADD KEY `nl_id` (`nl_id`),
  ADD KEY `ncc_id` (`ncc_id`);

--
-- Chỉ mục cho bảng `ctquyen`
--
ALTER TABLE `ctquyen`
  ADD PRIMARY KEY (`ctquyen_id`),
  ADD KEY `admin_admin_id` (`quyen_id`,`nv_id`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`danhmuc_id`);

--
-- Chỉ mục cho bảng `datban`
--
ALTER TABLE `datban`
  ADD PRIMARY KEY (`datban_id`),
  ADD KEY `ban_id` (`ban_id`,`khachhang_id`),
  ADD KEY `khachhang_id` (`khachhang_id`);

--
-- Chỉ mục cho bảng `dinhluong`
--
ALTER TABLE `dinhluong`
  ADD PRIMARY KEY (`dl_id`),
  ADD KEY `sp_id` (`ma_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  ADD PRIMARY KEY (`gg_id`);

--
-- Chỉ mục cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD PRIMARY KEY (`hinhanh_id`),
  ADD KEY `sp_id` (`ma_id`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`hoadon_id`),
  ADD KEY `admin_id` (`nv_id`,`phienlamviec_id`,`ban_id`,`khachhang_id`),
  ADD KEY `hoadon_ibfk_2` (`khachhang_id`),
  ADD KEY `hoadon_ibfk_3` (`ban_id`),
  ADD KEY `hoadon_ibfk_4` (`phienlamviec_id`),
  ADD KEY `gg_id` (`gg_id`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`khachhang_id`);

--
-- Chỉ mục cho bảng `mailsettings`
--
ALTER TABLE `mailsettings`
  ADD PRIMARY KEY (`mail_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `monan`
--
ALTER TABLE `monan`
  ADD PRIMARY KEY (`ma_id`),
  ADD KEY `danhmuc_id` (`danhmuc_id`);

--
-- Chỉ mục cho bảng `nguyenlieu`
--
ALTER TABLE `nguyenlieu`
  ADD PRIMARY KEY (`nl_id`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`ncc_id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`nv_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `phienlamviec`
--
ALTER TABLE `phienlamviec`
  ADD PRIMARY KEY (`phienlamviec_id`),
  ADD KEY `admin_id` (`nv_id`);

--
-- Chỉ mục cho bảng `phieunhaphang`
--
ALTER TABLE `phieunhaphang`
  ADD PRIMARY KEY (`pnh_id`),
  ADD KEY `admin_id` (`nv_id`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`quyen_id`);

--
-- Chỉ mục cho bảng `thongke`
--
ALTER TABLE `thongke`
  ADD PRIMARY KEY (`thongke_id`);

--
-- Chỉ mục cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD PRIMARY KEY (`tn_id`),
  ADD KEY `nv_id_tntu` (`nv_id_tntu`,`nv_id_tnden`),
  ADD KEY `nv_id_tnden` (`nv_id_tnden`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `baiviet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `ban`
--
ALTER TABLE `ban`
  MODIFY `ban_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `binhluan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `ctdinhluong`
--
ALTER TABLE `ctdinhluong`
  MODIFY `ctdl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT cho bảng `cthoadon`
--
ALTER TABLE `cthoadon`
  MODIFY `cthoadon_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1444;

--
-- AUTO_INCREMENT cho bảng `ctphienlamviec`
--
ALTER TABLE `ctphienlamviec`
  MODIFY `ctphien_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `ctphieunhaphang`
--
ALTER TABLE `ctphieunhaphang`
  MODIFY `ctnh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT cho bảng `ctquyen`
--
ALTER TABLE `ctquyen`
  MODIFY `ctquyen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `danhmuc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `datban`
--
ALTER TABLE `datban`
  MODIFY `datban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT cho bảng `dinhluong`
--
ALTER TABLE `dinhluong`
  MODIFY `dl_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  MODIFY `gg_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `hinhanh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `hoadon_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `khachhang_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `mailsettings`
--
ALTER TABLE `mailsettings`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `monan`
--
ALTER TABLE `monan`
  MODIFY `ma_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `nguyenlieu`
--
ALTER TABLE `nguyenlieu`
  MODIFY `nl_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `ncc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `nv_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phienlamviec`
--
ALTER TABLE `phienlamviec`
  MODIFY `phienlamviec_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `phieunhaphang`
--
ALTER TABLE `phieunhaphang`
  MODIFY `pnh_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `quyen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `thongke`
--
ALTER TABLE `thongke`
  MODIFY `thongke_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  MODIFY `tn_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=528;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`ma_id`) REFERENCES `monan` (`ma_id`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`khachhang_id`) REFERENCES `khachhang` (`khachhang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `ctdinhluong`
--
ALTER TABLE `ctdinhluong`
  ADD CONSTRAINT `ctdinhluong_ibfk_1` FOREIGN KEY (`dl_id`) REFERENCES `dinhluong` (`dl_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ctdinhluong_ibfk_2` FOREIGN KEY (`nl_id`) REFERENCES `nguyenlieu` (`nl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cthoadon`
--
ALTER TABLE `cthoadon`
  ADD CONSTRAINT `cthoadon_ibfk_1` FOREIGN KEY (`hoadon_id`) REFERENCES `hoadon` (`hoadon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cthoadon_ibfk_2` FOREIGN KEY (`ma_id`) REFERENCES `monan` (`ma_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `ctphienlamviec`
--
ALTER TABLE `ctphienlamviec`
  ADD CONSTRAINT `ctphienlamviec_ibfk_1` FOREIGN KEY (`phienlamviec_id`) REFERENCES `phienlamviec` (`phienlamviec_id`);

--
-- Các ràng buộc cho bảng `ctphieunhaphang`
--
ALTER TABLE `ctphieunhaphang`
  ADD CONSTRAINT `ctphieunhaphang_ibfk_1` FOREIGN KEY (`pnh_id`) REFERENCES `phieunhaphang` (`pnh_id`),
  ADD CONSTRAINT `ctphieunhaphang_ibfk_2` FOREIGN KEY (`nl_id`) REFERENCES `nguyenlieu` (`nl_id`),
  ADD CONSTRAINT `ctphieunhaphang_ibfk_3` FOREIGN KEY (`ncc_id`) REFERENCES `nhacungcap` (`ncc_id`);

--
-- Các ràng buộc cho bảng `ctquyen`
--
ALTER TABLE `ctquyen`
  ADD CONSTRAINT `ctquyen_ibfk_1` FOREIGN KEY (`quyen_id`) REFERENCES `nhanvien` (`nv_id`);

--
-- Các ràng buộc cho bảng `datban`
--
ALTER TABLE `datban`
  ADD CONSTRAINT `datban_ibfk_1` FOREIGN KEY (`ban_id`) REFERENCES `ban` (`ban_id`),
  ADD CONSTRAINT `datban_ibfk_2` FOREIGN KEY (`khachhang_id`) REFERENCES `khachhang` (`khachhang_id`);

--
-- Các ràng buộc cho bảng `dinhluong`
--
ALTER TABLE `dinhluong`
  ADD CONSTRAINT `dinhluong_ibfk_1` FOREIGN KEY (`ma_id`) REFERENCES `monan` (`ma_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD CONSTRAINT `hinhanh_ibfk_1` FOREIGN KEY (`ma_id`) REFERENCES `monan` (`ma_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`nv_id`) REFERENCES `nhanvien` (`nv_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`khachhang_id`) REFERENCES `khachhang` (`khachhang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hoadon_ibfk_3` FOREIGN KEY (`ban_id`) REFERENCES `ban` (`ban_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hoadon_ibfk_4` FOREIGN KEY (`phienlamviec_id`) REFERENCES `phienlamviec` (`phienlamviec_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hoadon_ibfk_5` FOREIGN KEY (`gg_id`) REFERENCES `giamgia` (`gg_id`);

--
-- Các ràng buộc cho bảng `monan`
--
ALTER TABLE `monan`
  ADD CONSTRAINT `monan_ibfk_1` FOREIGN KEY (`danhmuc_id`) REFERENCES `danhmuc` (`danhmuc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phienlamviec`
--
ALTER TABLE `phienlamviec`
  ADD CONSTRAINT `phienlamviec_ibfk_1` FOREIGN KEY (`nv_id`) REFERENCES `nhanvien` (`nv_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phieunhaphang`
--
ALTER TABLE `phieunhaphang`
  ADD CONSTRAINT `phieunhaphang_ibfk_1` FOREIGN KEY (`nv_id`) REFERENCES `nhanvien` (`nv_id`);

--
-- Các ràng buộc cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD CONSTRAINT `tinnhan_ibfk_1` FOREIGN KEY (`nv_id_tntu`) REFERENCES `nhanvien` (`nv_id`),
  ADD CONSTRAINT `tinnhan_ibfk_2` FOREIGN KEY (`nv_id_tnden`) REFERENCES `nhanvien` (`nv_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
