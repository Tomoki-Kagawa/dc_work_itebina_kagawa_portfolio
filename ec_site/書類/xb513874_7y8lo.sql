-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el7.remi
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2025 年 8 月 08 日 12:38
-- サーバのバージョン： 10.5.13-MariaDB-log
-- PHP のバージョン: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `xb513874_7y8lo`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_cart`
--

CREATE TABLE `ec_cart` (
  `cart_id` int(11) NOT NULL COMMENT 'カートid',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーid',
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `product_qty` int(11) NOT NULL COMMENT '商品数',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_favorite`
--

CREATE TABLE `ec_favorite` (
  `favorite_id` int(11) NOT NULL COMMENT 'お気に入りid',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーid',
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ec_favorite`
--

INSERT INTO `ec_favorite` (`favorite_id`, `user_id`, `product_id`, `create_date`, `update_date`) VALUES
(1, 1, 2, '2025-08-02 11:45:31', '2025-08-02 11:45:31'),
(2, 1, 3, '2025-08-02 11:45:34', '2025-08-02 11:45:34');

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_history`
--

CREATE TABLE `ec_history` (
  `history_id` int(11) NOT NULL COMMENT '購入id',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーid',
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ec_history`
--

INSERT INTO `ec_history` (`history_id`, `user_id`, `product_id`, `create_date`, `update_date`) VALUES
(1, 1, 1, '2025-08-02 11:46:13', '2025-08-02 11:46:13'),
(2, 4, 39, '2025-08-05 12:50:07', '2025-08-05 12:50:07'),
(3, 4, 2, '2025-08-05 12:50:07', '2025-08-05 12:50:07'),
(4, 4, 42, '2025-08-05 12:50:07', '2025-08-05 12:50:07');

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_image`
--

CREATE TABLE `ec_image` (
  `image_id` int(11) NOT NULL COMMENT '画像id',
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `image_name` varchar(256) NOT NULL COMMENT '画像名',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ec_image`
--

INSERT INTO `ec_image` (`image_id`, `product_id`, `image_name`, `create_date`, `update_date`) VALUES
(1, 1, 'アイス.png', '2025-07-25 21:17:57', '2025-07-25 21:17:57'),
(2, 2, 'コーヒー.png', '2025-07-25 21:18:53', '2025-07-25 21:18:53'),
(3, 3, 'コーラ.png', '2025-07-25 21:19:43', '2025-07-25 21:19:43'),
(4, 4, 'サンドイッチ.png', '2025-07-25 21:20:37', '2025-07-25 21:20:37'),
(5, 5, 'ショートケーキ.png', '2025-07-25 21:21:26', '2025-07-25 21:21:26'),
(6, 6, 'トースト.png', '2025-07-25 21:22:25', '2025-07-25 21:22:25'),
(7, 7, 'ハンバーグ.png', '2025-07-25 21:23:05', '2025-07-25 21:23:05'),
(8, 8, 'プリン.png', '2025-07-25 21:23:48', '2025-07-25 21:23:48'),
(9, 9, 'ミルク.png', '2025-07-25 21:24:50', '2025-07-25 21:24:50'),
(10, 10, 'メロンパン.png', '2025-07-25 21:25:37', '2025-07-25 21:25:37'),
(11, 11, 'ラーメン.png', '2025-07-25 21:26:23', '2025-07-25 21:26:23'),
(12, 12, '寿司.png', '2025-07-25 21:27:11', '2025-07-25 21:27:11'),
(13, 13, 'アケコン.png', '2025-07-25 21:27:57', '2025-07-25 21:27:57'),
(38, 38, 'GeorgiaEmerald.png', '2025-08-05 12:22:07', '2025-08-05 12:22:07'),
(39, 39, 'milk_lineup03.png', '2025-08-05 12:27:05', '2025-08-05 12:27:05'),
(40, 40, 'energy_bottle_img.png', '2025-08-05 12:31:21', '2025-08-05 12:31:21'),
(41, 41, 'GeogiaPremium.jpg', '2025-08-05 12:34:43', '2025-08-05 12:34:43'),
(42, 42, 'lineup_others_bottle_350.png', '2025-08-05 12:38:15', '2025-08-05 12:38:15'),
(43, 43, 'cola_bottle_img_2020.png', '2025-08-05 12:41:00', '2025-08-05 12:41:00'),
(44, 44, 'GeorgiaDoc.pdf', '2025-08-05 12:42:47', '2025-08-05 12:42:47'),
(46, 46, 'ジョージアブラック.jpg', '2025-08-05 12:47:19', '2025-08-05 12:47:19'),
(47, 47, 'GerogiaGrand.jpeg', '2025-08-05 12:47:55', '2025-08-05 12:47:55');

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_management`
--

CREATE TABLE `ec_management` (
  `management_id` int(11) NOT NULL COMMENT '管理人id',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーid',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ec_management`
--

INSERT INTO `ec_management` (`management_id`, `user_id`, `create_date`, `update_date`) VALUES
(1, 1, '2025-07-23 16:44:57', '2025-07-23 16:44:57');

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_order`
--

CREATE TABLE `ec_order` (
  `order_id` int(11) NOT NULL COMMENT '購入id',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーid',
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `product_qty` int(11) NOT NULL COMMENT '商品数',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ec_order`
--

INSERT INTO `ec_order` (`order_id`, `user_id`, `product_id`, `product_qty`, `create_date`, `update_date`) VALUES
(1, 1, 1, 1, '2025-08-02 11:46:13', '2025-08-02 11:46:13'),
(1, 4, 39, 1, '2025-08-05 12:50:07', '2025-08-05 12:50:07'),
(1, 4, 2, 1, '2025-08-05 12:50:07', '2025-08-05 12:50:07'),
(1, 4, 42, 1, '2025-08-05 12:50:07', '2025-08-05 12:50:07');

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_personal`
--

CREATE TABLE `ec_personal` (
  `personal_id` int(11) NOT NULL COMMENT '個人情報id',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーid',
  `personal_name` varchar(256) NOT NULL COMMENT '名前',
  `tel` varchar(256) NOT NULL COMMENT '電話番号',
  `address` varchar(256) NOT NULL COMMENT '住所',
  `email_address` varchar(256) NOT NULL COMMENT 'メールアドレス',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ec_personal`
--

INSERT INTO `ec_personal` (`personal_id`, `user_id`, `personal_name`, `tel`, `address`, `email_address`, `create_date`, `update_date`) VALUES
(1, 1, 'ec_admin', '000-0000-0000', '神奈川県', 'tomoki.career15@gmail.com', '2025-08-02 11:45:19', '2025-08-02 11:45:19');

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_product`
--

CREATE TABLE `ec_product` (
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `product_name` varchar(256) NOT NULL COMMENT '商品名',
  `product_description` text NOT NULL COMMENT '商品説明',
  `price` int(11) NOT NULL COMMENT '価格',
  `public_flg` tinyint(1) NOT NULL COMMENT '公開フラグ',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ec_product`
--

INSERT INTO `ec_product` (`product_id`, `product_name`, `product_description`, `price`, `public_flg`, `create_date`, `update_date`) VALUES
(1, 'アイス', 'ほどよい甘さとミルクのコクが魅力のなめらかバニラアイス。 厳選した素材で作られた、シンプルだからこそ飽きのこない味わい。 お子様のおやつや食後のデザートにぴったりの一品です。', 180, 1, '2025-07-25 21:17:57', '2025-08-02 11:51:00'),
(2, 'コーヒー', '香ばしく深い味わいが楽しめる、ボトルタイプの本格コーヒー。 スッキリとした飲み心地で、リフレッシュしたいときにぴったり。 仕事の合間や外出時にも持ち運びやすい便利なサイズです。', 150, 1, '2025-07-25 21:18:53', '2025-08-02 11:51:10'),
(3, 'コーラ', '糖分を気にする方にもおすすめ。 後味スッキリ、ゼロカロリーながらしっかりコーラの風味が楽しめます。 健康とおいしさの両立を目指した、スマートな炭酸飲料です。', 140, 1, '2025-07-25 21:19:43', '2025-07-25 21:19:43'),
(4, 'サンドイッチ', '食べやすくカットされた人気のサンドイッチセット。 たまご、トマト＆レタス、ハムなど定番の具材を詰め込みました。 朝食・ランチ・軽食にぴったり！ふんわり食感のパンでお子さまにもおすすめです。', 320, 1, '2025-07-25 21:20:37', '2025-08-02 11:51:16'),
(5, 'ショートケーキ', 'ふわふわのスポンジと、たっぷりの生クリーム、ジューシーないちごが織りなす王道のショートケーキ。 甘さ控えめで、素材の味をしっかり感じられる仕上がりです。 お誕生日や記念日など、特別な日のスイーツにもぴったりです。', 420, 1, '2025-07-25 21:21:26', '2025-08-02 11:51:19'),
(6, 'トースト', '冷凍庫に常備しておきたい、便利でおいしいピザトースト。 食パンに具材をたっぷりのせた状態で冷凍済みなので、トースターで焼くだけ！ 朝食にも軽食にも◎ 忙しいご家庭にぴったりです。', 280, 1, '2025-07-25 21:22:25', '2025-07-25 21:22:25'),
(7, 'ハンバーグ', 'ふっくらジューシーに仕上げた、王道の洋食ハンバーグ。 肉の旨みを閉じ込めた一品に、ケチャップベースのソースをたっぷりかけました。 ポテト・コーン・いんげん付きで、ボリュームも満足。夕食やお弁当のおかずにもぴったりです。', 580, 1, '2025-07-25 21:23:05', '2025-08-02 11:51:14'),
(8, 'プリン', '卵とミルクのやさしい味わいが広がる、なめらか食感の定番プリン。 甘さ控えめのカラメルが絶妙なアクセントに。 お子様から大人まで楽しめる、毎日食べたくなるおいしさです。', 200, 1, '2025-07-25 21:23:48', '2025-07-25 21:23:48'),
(9, 'ミルク', '新鮮な生乳を100%使用した、毎日飲みたい定番の牛乳。 コクのある味わいとすっきりとした後味で、飲みやすく仕上げました。 そのままはもちろん、コーヒーや料理・お菓子作りにもぴったりです。', 210, 1, '2025-07-25 21:24:50', '2025-07-25 21:24:50'),
(10, 'メロンパン', '外はサクサク、中はふんわり。昔ながらの王道メロンパン。 表面のビスケット生地にはほんのり甘みがあり、一口で幸せな気分に。 おやつや朝食にぴったりの、どこか懐かしい味わいをお楽しみください。', 160, 1, '2025-07-25 21:25:37', '2025-07-25 21:25:37'),
(11, 'ラーメン', '濃厚でクリーミーな豚骨スープが自慢の本格とんこつラーメン。 コシのある細麺にチャーシュー、ねぎ、きくらげ、紅しょうがのトッピング付き。 ご自宅で簡単に専門店の味を楽しめる、贅沢な一杯です。', 680, 1, '2025-07-25 21:26:23', '2025-07-25 21:26:23'),
(12, '寿司', '新鮮なネタを贅沢に盛り込んだ寿司盛り合わせセット。 マグロ、サーモン、いか、たまご、いくら、巻き寿司など、バラエティ豊かな12貫入り。 ご家庭で本格寿司店の味わいを楽しめる、特別な日の食卓にもぴったりの逸品です。', 1380, 1, '2025-07-25 21:27:11', '2025-08-02 11:50:15'),
(13, 'アケコン', 'レトロゲームや格ゲーをもっと楽しく。 使いやすいジョイスティックとカラフルなボタンが魅力のアーケードコントローラーです。 USB接続でかんたんにPCに繋げて、すぐにゲームプレイを楽しめます。 初めてのアケコンにもぴったりなシンプル設計です。', 12700, 1, '2025-07-25 21:27:57', '2025-07-30 21:54:02'),
(38, 'GeorgiaEmerald', '「ジョージア エメラルドマウンテンブレンド」は、厳選された高級豆「エメラルドマウンテン豆」と国産牛乳の王道バランスを味わうことができる、「ジョージア」ブランドを代表するロングセラーの缶コーヒーです。', 121, 1, '2025-08-05 12:22:07', '2025-08-05 12:22:07'),
(39, '紅茶花伝', '1992年2月に発売を開始した「紅茶花伝」は、厳選素材を使用し、ティーポットで淹れたような紅茶本来の味が楽しめる紅茶です。 「紅茶花伝」という名前は、有名な能の書物である“風姿花伝”をもじって名付けられました。', 0, 1, '2025-08-05 12:27:05', '2025-08-05 12:27:05'),
(40, 'energy', 'コカ・コーラ エナジーは、コカ・コーラブランド初の エナジードリンクです。2019年7月1日に発売されました。コカ・コーラならではのおいしさと爽快感に、エナジードリンクの刺激的な味わいを加えた製品です。﻿', 120, 1, '2025-08-05 12:31:21', '2025-08-05 12:31:21'),
(41, 'GeogiaPremium', '「ジョージア エメラルドマウンテンブレンド プレミアム」は、25周年を記念して発売された商品で、希少な高級豆「エメラルドマウンテン豆」を使用し、深みのある味わいが特徴です。また、「挽きたてアロマ製法」と「バリスタハンド製法」で、豆本来りの風味を活かした本格的な味わいを実現しています。﻿ 一方、「ジョージア ザ・プレミアム」は、よりリッチな味わいを追求した商品で、高級豆をブレンドし、なめらかな口当たが特徴です。﻿ これらの「プレミアム」シリーズは、通常のジョージアシリーズよりも、よりこだわりのあるコーヒー豆や製法を使用し、ワンランク上の味わいを提供することを目指しています。', 120, 1, '2025-08-05 12:34:43', '2025-08-05 12:34:43'),
(42, 'Aquerius', '「アクエリアス」のパッケージデザインの特徴は、2017年4月のパッケージリニューアルにて、ブランドの価値をよりわかりやすく伝えるため、製品価値である「水分・栄養補給」をウォータードロップのアイコンで表現した新デザインのパッケージグラフィックに一新しました。', -120, 1, '2025-08-05 12:38:15', '2025-08-05 12:38:15'),
(43, 'コカ・コーラ', 'コカ･コーラは、1886年、薬剤師のジョン・S・ペンバートン博士により、米国ジョージア州アトランタで誕生しました。以降120年以上にわたり、国境や文化を越えて世界中の人々に愛されており、その規模は200以上の国や地域に及びます。', 150, 1, '2025-08-05 12:41:00', '2025-08-05 12:41:00'),
(44, 'コカ・コーラ　ジョージアパンフレット', '商品パンフレットです。', 1000, 1, '2025-08-05 12:42:47', '2025-08-05 12:42:47'),
(46, 'ジョージアブラック', '苦みの無い軽やかで爽やかな飲み心地のブラックコーヒー​。ジョージア クリアブラック', 120, 1, '2025-08-05 12:47:19', '2025-08-05 12:47:19'),
(47, 'GerogiaGrand', '「ジョージア グラン 微糖」は、コカ・コーラ社が販売する缶コーヒー「ジョージア」ブランドの微糖コーヒーです。通常よりもコーヒー豆を30%多く使用し、深煎り焙煎で仕上げることで、しっかりとしたコーヒーの味わいと適度な甘さ、そして飲みごたえを追求した商品です。', 120, 0, '2025-08-05 12:47:55', '2025-08-05 12:47:55');

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_stock`
--

CREATE TABLE `ec_stock` (
  `stock_id` int(11) NOT NULL COMMENT '在庫id',
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `stock_qty` int(11) NOT NULL COMMENT '在庫数',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ec_stock`
--

INSERT INTO `ec_stock` (`stock_id`, `product_id`, `stock_qty`, `create_date`, `update_date`) VALUES
(1, 1, 64, '2025-07-25 21:17:57', '2025-08-02 11:46:13'),
(2, 2, 48, '2025-07-25 21:18:53', '2025-08-05 12:50:07'),
(3, 3, 59, '2025-07-25 21:19:43', '2025-08-02 11:35:32'),
(4, 4, 35, '2025-07-25 21:20:37', '2025-07-25 21:20:37'),
(5, 5, 27, '2025-07-25 21:21:26', '2025-07-31 13:31:53'),
(6, 6, 40, '2025-07-25 21:22:25', '2025-07-25 21:22:25'),
(7, 7, 45, '2025-07-25 21:23:05', '2025-07-25 21:23:05'),
(8, 8, 50, '2025-07-25 21:23:48', '2025-07-25 21:23:48'),
(9, 9, 50, '2025-07-25 21:24:50', '2025-07-25 21:24:50'),
(10, 10, 44, '2025-07-25 21:25:37', '2025-07-31 13:32:07'),
(11, 11, 27, '2025-07-25 21:26:23', '2025-07-31 13:33:08'),
(12, 12, 27, '2025-07-25 21:27:11', '2025-07-31 13:32:27'),
(13, 13, 5, '2025-07-25 21:27:57', '2025-08-02 10:07:10'),
(38, 38, 20, '2025-08-05 12:22:07', '2025-08-05 12:22:07'),
(39, 39, 19, '2025-08-05 12:27:05', '2025-08-05 12:50:07'),
(40, 40, 0, '2025-08-05 12:31:21', '2025-08-05 12:31:21'),
(41, 41, 21, '2025-08-05 12:34:43', '2025-08-05 12:34:43'),
(42, 42, 9, '2025-08-05 12:38:15', '2025-08-05 12:50:07'),
(43, 43, -20, '2025-08-05 12:41:00', '2025-08-05 12:41:00'),
(44, 44, 10, '2025-08-05 12:42:47', '2025-08-05 12:42:47'),
(46, 46, 20, '2025-08-05 12:47:19', '2025-08-05 12:47:19'),
(47, 47, 20, '2025-08-05 12:47:55', '2025-08-05 12:47:55');

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_user`
--

CREATE TABLE `ec_user` (
  `user_id` int(11) NOT NULL COMMENT 'ユーザーid',
  `user_name` varchar(256) NOT NULL COMMENT 'ユーザー名',
  `password` varchar(256) NOT NULL COMMENT 'パスワード',
  `create_date` datetime NOT NULL COMMENT '作成日',
  `update_date` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ec_user`
--

INSERT INTO `ec_user` (`user_id`, `user_name`, `password`, `create_date`, `update_date`) VALUES
(1, 'ec_admin', '$2y$10$7WrFb6srdzE1QTk523evIe4zjRsM8E5/Hdf1dCUaAck01/gM6FP16', '2025-07-23 16:44:57', '2025-07-23 16:44:57'),
(2, 'tomoki_kagawa', '$2y$10$mEovB8nHTk1PovbO4tIQ0OrJuCFizSnWX.KGMCX3Yn.ZOvfQScp.m', '2025-07-27 14:46:53', '2025-07-27 14:46:53'),
(3, 'itexebina', '$2y$10$wVvPooEJ67OjhLeUu1tgTOdYBh0BXGPZKI0Mbwy/IxG9EOmBvha9S', '2025-07-29 18:29:39', '2025-07-29 18:29:39'),
(4, 'user5', '$2y$10$5a4xd86LlEkyd4xfVWHSFOGA7GEqdOwp/KMuVmJNA5kj2C4tcvoaG', '2025-08-05 11:42:54', '2025-08-05 11:42:54');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `ec_cart`
--
ALTER TABLE `ec_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `ec_cart_user` (`user_id`) USING BTREE,
  ADD KEY `ec_cart_product` (`product_id`) USING BTREE;

--
-- テーブルのインデックス `ec_favorite`
--
ALTER TABLE `ec_favorite`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `ec_favorite_product` (`product_id`),
  ADD KEY `ec_favorite_user` (`user_id`);

--
-- テーブルのインデックス `ec_history`
--
ALTER TABLE `ec_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `f_purchase` (`user_id`),
  ADD KEY `ec_purchase_product` (`product_id`);

--
-- テーブルのインデックス `ec_image`
--
ALTER TABLE `ec_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- テーブルのインデックス `ec_management`
--
ALTER TABLE `ec_management`
  ADD PRIMARY KEY (`management_id`),
  ADD KEY `ec_management_user` (`user_id`);

--
-- テーブルのインデックス `ec_order`
--
ALTER TABLE `ec_order`
  ADD KEY `ec_order_user_id` (`user_id`),
  ADD KEY `ec_order_product_id` (`product_id`);

--
-- テーブルのインデックス `ec_personal`
--
ALTER TABLE `ec_personal`
  ADD PRIMARY KEY (`personal_id`),
  ADD KEY `ec_address` (`user_id`) USING BTREE;

--
-- テーブルのインデックス `ec_product`
--
ALTER TABLE `ec_product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- テーブルのインデックス `ec_stock`
--
ALTER TABLE `ec_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `product_id_INDEX` (`product_id`) USING BTREE;

--
-- テーブルのインデックス `ec_user`
--
ALTER TABLE `ec_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `ec_cart`
--
ALTER TABLE `ec_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'カートid', AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `ec_favorite`
--
ALTER TABLE `ec_favorite`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'お気に入りid', AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `ec_history`
--
ALTER TABLE `ec_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '購入id', AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `ec_image`
--
ALTER TABLE `ec_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '画像id', AUTO_INCREMENT=48;

--
-- テーブルの AUTO_INCREMENT `ec_management`
--
ALTER TABLE `ec_management`
  MODIFY `management_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理人id', AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `ec_personal`
--
ALTER TABLE `ec_personal`
  MODIFY `personal_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '個人情報id', AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `ec_product`
--
ALTER TABLE `ec_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品id', AUTO_INCREMENT=48;

--
-- テーブルの AUTO_INCREMENT `ec_stock`
--
ALTER TABLE `ec_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '在庫id', AUTO_INCREMENT=48;

--
-- テーブルの AUTO_INCREMENT `ec_user`
--
ALTER TABLE `ec_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ユーザーid', AUTO_INCREMENT=5;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `ec_cart`
--
ALTER TABLE `ec_cart`
  ADD CONSTRAINT `ec_cart_product` FOREIGN KEY (`product_id`) REFERENCES `ec_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ec_cart_user` FOREIGN KEY (`user_id`) REFERENCES `ec_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `ec_favorite`
--
ALTER TABLE `ec_favorite`
  ADD CONSTRAINT `ec_favorite_product` FOREIGN KEY (`product_id`) REFERENCES `ec_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ec_favorite_user` FOREIGN KEY (`user_id`) REFERENCES `ec_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `ec_history`
--
ALTER TABLE `ec_history`
  ADD CONSTRAINT `ec_purchase_product` FOREIGN KEY (`product_id`) REFERENCES `ec_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ec_purchase_user` FOREIGN KEY (`user_id`) REFERENCES `ec_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `ec_image`
--
ALTER TABLE `ec_image`
  ADD CONSTRAINT `ec_image_product` FOREIGN KEY (`product_id`) REFERENCES `ec_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `ec_management`
--
ALTER TABLE `ec_management`
  ADD CONSTRAINT `ec_management_user` FOREIGN KEY (`user_id`) REFERENCES `ec_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `ec_order`
--
ALTER TABLE `ec_order`
  ADD CONSTRAINT `ec_order_product_id` FOREIGN KEY (`product_id`) REFERENCES `ec_product` (`product_id`),
  ADD CONSTRAINT `ec_order_user_id` FOREIGN KEY (`user_id`) REFERENCES `ec_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `ec_personal`
--
ALTER TABLE `ec_personal`
  ADD CONSTRAINT `ec_personal_user` FOREIGN KEY (`user_id`) REFERENCES `ec_user` (`user_id`);

--
-- テーブルの制約 `ec_stock`
--
ALTER TABLE `ec_stock`
  ADD CONSTRAINT `ec_stock_product` FOREIGN KEY (`product_id`) REFERENCES `ec_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
