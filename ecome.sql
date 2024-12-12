/*
 Navicat Premium Dump SQL

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : ecome

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 12/12/2024 15:32:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `carts_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of carts
-- ----------------------------
INSERT INTO `carts` VALUES (1, 10, '{\"7\":{\"name\":\"N\\u1ed3i c\\u01a1m \\u0111i\\u1ec7n Toshiba 2L\",\"price\":\"2990000\",\"image\":\"\\/storage\\/product\\/1\\/8ZLUxaImU7mAOsduiaPcHKZx24bmLsr2oxbW24d4.jpg\",\"quantity\":1,\"total\":2990000}}', '2024-12-10 13:50:48', '2024-12-11 03:06:24');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NOT NULL DEFAULT 0,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (17, 'Tủ lạnh', 0, 'tu-lanh', '2024-12-03 09:30:30', '2024-12-03 09:30:30', NULL);
INSERT INTO `categories` VALUES (18, 'TV', 0, 'tv', '2024-12-03 09:30:33', '2024-12-03 09:30:33', NULL);
INSERT INTO `categories` VALUES (19, 'Máy giặt', 0, 'may-giat', '2024-12-03 09:30:38', '2024-12-03 09:30:38', NULL);
INSERT INTO `categories` VALUES (20, 'TV Sony', 18, 'tv-sony', '2024-12-03 09:30:51', '2024-12-03 09:30:51', NULL);
INSERT INTO `categories` VALUES (21, 'Đồ dùng nhà bếp', 0, 'do-dung-nha-bep', '2024-12-03 09:31:04', '2024-12-03 09:31:04', NULL);
INSERT INTO `categories` VALUES (22, 'Nồi cơm Toshiba', 21, 'noi-com-toshiba', '2024-12-03 09:31:18', '2024-12-03 09:31:18', NULL);
INSERT INTO `categories` VALUES (23, 'Máy giặt Aqua', 19, 'may-giat-aqua', '2024-12-03 09:31:34', '2024-12-03 09:31:34', NULL);
INSERT INTO `categories` VALUES (24, 'Đồ dùng nhà tắm', 0, 'do-dung-nha-tam', '2024-12-08 00:54:19', '2024-12-08 00:54:48', NULL);
INSERT INTO `categories` VALUES (25, 'Máy nước nóng', 24, 'may-nuoc-nong', '2024-12-08 00:55:33', '2024-12-08 00:55:33', NULL);
INSERT INTO `categories` VALUES (26, 'TV Samsung Fullhd', 18, 'tv-samsung-fullhd', '2024-12-10 17:09:39', '2024-12-10 17:10:37', '2024-12-10 17:10:37');
INSERT INTO `categories` VALUES (27, 'Tủ lạnh Toshiba', 17, 'tu-lanh-toshiba', '2024-12-11 00:45:12', '2024-12-11 00:45:12', NULL);

-- ----------------------------
-- Table structure for invoice_details
-- ----------------------------
DROP TABLE IF EXISTS `invoice_details`;
CREATE TABLE `invoice_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` decimal(10, 2) NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(10, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_invoice_detail_invoice`(`invoice_id` ASC) USING BTREE,
  INDEX `fk_invoice_detail_product`(`product_id` ASC) USING BTREE,
  CONSTRAINT `fk_invoice_detail_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_invoice_detail_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 93 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of invoice_details
-- ----------------------------
INSERT INTO `invoice_details` VALUES (89, 113, 6, 'BRAVIA 3 Tivi LED Sony 4K', 16990000.00, 1, 16990000.00, '2024-12-11 01:48:29', '2024-12-11 01:48:29');
INSERT INTO `invoice_details` VALUES (90, 114, 6, 'BRAVIA 3 Tivi LED Sony 4K', 16990000.00, 1, 16990000.00, '2024-12-11 02:40:31', '2024-12-11 02:40:31');
INSERT INTO `invoice_details` VALUES (91, 115, 6, 'BRAVIA 3 Tivi LED Sony 4K', 16990000.00, 1, 16990000.00, '2024-12-11 02:41:38', '2024-12-11 02:41:38');
INSERT INTO `invoice_details` VALUES (92, 116, 7, 'Nồi cơm điện Toshiba 2L', 2990000.00, 1, 2990000.00, '2024-12-11 03:06:53', '2024-12-11 03:06:53');

-- ----------------------------
-- Table structure for invoices
-- ----------------------------
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `customer_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(10, 2) NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_invoice_user`(`user_id` ASC) USING BTREE,
  CONSTRAINT `fk_invoice_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 117 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of invoices
-- ----------------------------
INSERT INTO `invoices` VALUES (113, 10, 'Nam', '0344143909', 'Ba Vì', 16990000.00, 'Đã hủy', 'cash', '2024-12-11 01:48:29', '2024-12-11 02:34:56', NULL);
INSERT INTO `invoices` VALUES (114, 10, 'Nam', '0344143909', 'Ba Vì', 16990000.00, 'Đã đặt', 'cash', '2024-12-11 02:40:31', '2024-12-11 02:40:31', NULL);
INSERT INTO `invoices` VALUES (115, 10, 'Nam', '0344143909', 'Ba Vì', 16990000.00, 'Đã đặt', 'cash', '2024-12-11 02:41:38', '2024-12-11 02:41:38', NULL);
INSERT INTO `invoices` VALUES (116, 10, 'Nam', '0344143909', 'Ba Vì', 2990000.00, 'Đã xác nhận', 'cash', '2024-12-11 03:06:53', '2024-12-11 03:07:18', NULL);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menus
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2024_12_10_131847_create_carts_table', 1);

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_permissions_role_permission`(`permission_id` ASC) USING BTREE,
  INDEX `fk_permissions_role_role`(`role_id` ASC) USING BTREE,
  CONSTRAINT `fk_permissions_role_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_permissions_role_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 71 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES (5, 7, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (6, 8, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (7, 9, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (8, 10, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (13, 17, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (14, 18, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (15, 19, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (16, 20, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (17, 22, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (18, 23, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (19, 24, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (20, 25, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (21, 27, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (22, 28, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (23, 29, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (24, 30, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (25, 32, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (26, 33, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (27, 34, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (28, 35, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (36, 4, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (37, 2, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (38, 3, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (39, 5, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (41, 38, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (42, 39, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (43, 40, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (44, 12, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (45, 13, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (46, 14, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (47, 15, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (48, 2, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (49, 3, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (50, 4, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (51, 5, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (52, 7, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (53, 8, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (54, 9, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (55, 10, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (56, 12, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (57, 13, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (58, 14, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (59, 15, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (60, 17, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (61, 18, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (62, 19, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (63, 20, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (64, 22, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (65, 23, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (66, 24, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (67, 25, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (68, 38, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (69, 39, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (70, 40, 3, NULL, NULL);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT 0,
  `key_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'category', 'Danh mục', '2024-11-17 06:08:19', '2024-11-17 06:08:19', 0, '');
INSERT INTO `permissions` VALUES (2, 'listcategory', 'Xem danh sách Danh mục', '2024-11-17 06:08:19', '2024-11-17 06:08:19', 1, 'category_list');
INSERT INTO `permissions` VALUES (3, 'addcategory', 'Thêm Danh mục', '2024-11-17 06:08:19', '2024-11-17 06:08:19', 1, 'category_add');
INSERT INTO `permissions` VALUES (4, 'editcategory', 'Sửa Danh mục', '2024-11-17 06:08:19', '2024-11-17 06:08:19', 1, 'category_edit');
INSERT INTO `permissions` VALUES (5, 'deletecategory', 'Xóa Danh mục', '2024-11-17 06:08:19', '2024-11-17 06:08:19', 1, 'category_delete');
INSERT INTO `permissions` VALUES (6, 'menu', 'Menu', '2024-11-17 06:08:58', '2024-11-17 06:08:58', 0, '');
INSERT INTO `permissions` VALUES (7, 'listmenu', 'Xem danh sách Menu', '2024-11-17 06:08:58', '2024-11-17 06:08:58', 6, 'menu_list');
INSERT INTO `permissions` VALUES (8, 'addmenu', 'Thêm Menu', '2024-11-17 06:08:58', '2024-11-17 06:08:58', 6, 'menu_add');
INSERT INTO `permissions` VALUES (9, 'editmenu', 'Sửa Menu', '2024-11-17 06:08:58', '2024-11-17 06:08:58', 6, 'menu_edit');
INSERT INTO `permissions` VALUES (10, 'deletemenu', 'Xóa Menu', '2024-11-17 06:08:58', '2024-11-17 06:08:58', 6, 'menu_delete');
INSERT INTO `permissions` VALUES (11, 'product', 'Sản phẩm', '2024-11-17 06:09:07', '2024-11-17 06:09:07', 0, '');
INSERT INTO `permissions` VALUES (12, 'listproduct', 'Xem danh sách Sản phẩm', '2024-11-17 06:09:07', '2024-11-17 06:09:07', 11, 'product_list');
INSERT INTO `permissions` VALUES (13, 'addproduct', 'Thêm Sản phẩm', '2024-11-17 06:09:07', '2024-11-17 06:09:07', 11, 'product_add');
INSERT INTO `permissions` VALUES (14, 'editproduct', 'Sửa Sản phẩm', '2024-11-17 06:09:07', '2024-11-17 06:09:07', 11, 'product_edit');
INSERT INTO `permissions` VALUES (15, 'deleteproduct', 'Xóa Sản phẩm', '2024-11-17 06:09:07', '2024-11-17 06:09:07', 11, 'product_delete');
INSERT INTO `permissions` VALUES (16, 'slider', 'Slider', '2024-11-17 06:09:16', '2024-11-17 06:09:16', 0, '');
INSERT INTO `permissions` VALUES (17, 'listslider', 'Xem danh sách Slider', '2024-11-17 06:09:16', '2024-11-17 06:09:16', 16, 'slider_list');
INSERT INTO `permissions` VALUES (18, 'addslider', 'Thêm Slider', '2024-11-17 06:09:16', '2024-11-17 06:09:16', 16, 'slider_add');
INSERT INTO `permissions` VALUES (19, 'editslider', 'Sửa Slider', '2024-11-17 06:09:16', '2024-11-17 06:09:16', 16, 'slider_edit');
INSERT INTO `permissions` VALUES (20, 'deleteslider', 'Xóa Slider', '2024-11-17 06:09:16', '2024-11-17 06:09:16', 16, 'slider_delete');
INSERT INTO `permissions` VALUES (21, 'setting', 'Cài đặt', '2024-11-17 06:09:25', '2024-11-17 06:09:25', 0, '');
INSERT INTO `permissions` VALUES (22, 'listsetting', 'Xem danh sách Cài đặt', '2024-11-17 06:09:25', '2024-11-17 06:09:25', 21, 'setting_list');
INSERT INTO `permissions` VALUES (23, 'addsetting', 'Thêm Cài đặt', '2024-11-17 06:09:25', '2024-11-17 06:09:25', 21, 'setting_add');
INSERT INTO `permissions` VALUES (24, 'editsetting', 'Sửa Cài đặt', '2024-11-17 06:09:25', '2024-11-17 06:09:25', 21, 'setting_edit');
INSERT INTO `permissions` VALUES (25, 'deletesetting', 'Xóa Cài đặt', '2024-11-17 06:09:25', '2024-11-17 06:09:25', 21, 'setting_delete');
INSERT INTO `permissions` VALUES (26, 'user', 'Người dùng', '2024-11-17 06:09:35', '2024-11-17 06:09:35', 0, '');
INSERT INTO `permissions` VALUES (27, 'listuser', 'Xem danh sách Người dùng', '2024-11-17 06:09:35', '2024-11-17 06:09:35', 26, 'user_list');
INSERT INTO `permissions` VALUES (28, 'adduser', 'Thêm Người dùng', '2024-11-17 06:09:35', '2024-11-17 06:09:35', 26, 'user_add');
INSERT INTO `permissions` VALUES (29, 'edituser', 'Sửa Người dùng', '2024-11-17 06:09:35', '2024-11-17 06:09:35', 26, 'user_edit');
INSERT INTO `permissions` VALUES (30, 'deleteuser', 'Xóa Người dùng', '2024-11-17 06:09:35', '2024-11-17 06:09:35', 26, 'user_delete');
INSERT INTO `permissions` VALUES (31, 'role', 'Vai trò', '2024-11-17 06:09:44', '2024-11-17 06:09:44', 0, '');
INSERT INTO `permissions` VALUES (32, 'listrole', 'Xem danh sách Vai trò', '2024-11-17 06:09:44', '2024-11-17 06:09:44', 31, 'role_list');
INSERT INTO `permissions` VALUES (33, 'addrole', 'Thêm Vai trò', '2024-11-17 06:09:44', '2024-11-17 06:09:44', 31, 'role_add');
INSERT INTO `permissions` VALUES (34, 'editrole', 'Sửa Vai trò', '2024-11-17 06:09:44', '2024-11-17 06:09:44', 31, 'role_edit');
INSERT INTO `permissions` VALUES (35, 'deleterole', 'Xóa Vai trò', '2024-11-17 06:09:44', '2024-11-17 06:09:44', 31, 'role_delete');
INSERT INTO `permissions` VALUES (36, 'addpermission', 'Quyền', NULL, NULL, 0, 'permissionAdd');
INSERT INTO `permissions` VALUES (37, 'invoice', 'Hóa đơn', '2024-12-03 18:08:55', '2024-12-03 18:08:55', 0, '');
INSERT INTO `permissions` VALUES (38, 'listinvoice', 'Xem danh sách Hóa đơn', '2024-12-03 18:08:55', '2024-12-03 18:08:55', 37, 'invoice_list');
INSERT INTO `permissions` VALUES (39, 'editinvoice', 'Sửa Hóa đơn', '2024-12-03 18:08:55', '2024-12-03 18:08:55', 37, 'invoice_edit');
INSERT INTO `permissions` VALUES (40, 'deleteinvoice', 'Xóa Hóa đơn', '2024-12-03 18:08:55', '2024-12-03 18:08:55', 37, 'invoice_delete');

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_product_images_product`(`product_id` ASC) USING BTREE,
  CONSTRAINT `fk_product_images_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES (54, '/storage/product/1/Y6IlUlNOoeILM90zR24kokZ5wz28LvVdK0iD6gNM.jpg', 6, '2024-12-03 09:35:32', '2024-12-03 09:35:32', '10058015-Google_Tivi_LED_Sony_4K_55_inch_K-55S30_VN3-1.jpg');
INSERT INTO `product_images` VALUES (55, '/storage/product/1/5rAajMXTfo1prPQBx0958zd9mOCUDmMquY8jcQJj.jpg', 6, '2024-12-03 09:35:32', '2024-12-03 09:35:32', 'Google_Tivi_LED_Sony_4K_55_inch_K-55S30_VN3-2.jpg');
INSERT INTO `product_images` VALUES (56, '/storage/product/1/KbF2Dh3R6m3QQKZNIqJwIVuWAIAaO0QZ6kaCCrhL.jpg', 6, '2024-12-03 09:35:32', '2024-12-03 09:35:32', 'Google_Tivi_LED_Sony_4K_55_inch_K-55S30_VN3-3.jpg');
INSERT INTO `product_images` VALUES (57, '/storage/product/1/m9gop8R0IscMQbznG5J33jKWUuQt75h0jpJvBbfQ.jpg', 7, '2024-12-08 00:49:49', '2024-12-08 00:49:49', '10032712.jpg');
INSERT INTO `product_images` VALUES (58, '/storage/product/1/E0szB2apVf7BUd4p2seYUDXZ8QrPAhAR7oeLEpNU.jpg', 7, '2024-12-08 00:49:49', '2024-12-08 00:49:49', '10032712-noi-com-dien-toshiba-1l-rc-10nmfvn-wt-2_t5qh-vl.jpg');
INSERT INTO `product_images` VALUES (59, '/storage/product/1/dpU1HRaWwcXFGPL0Jsqwwu1EXi5ZFfEQEJIj6cVD.jpg', 7, '2024-12-08 00:49:49', '2024-12-08 00:49:49', '10032712-noi-com-dien-toshiba-1l-rc-10nmfvn-wt-3_1vz6-so_mqvu-gr.jpg');
INSERT INTO `product_images` VALUES (60, '/storage/product/1/ot9gw1gl3dQQieBav5rgmr1qRxofcwu9oLJIzC2D.jpg', 8, '2024-12-08 01:21:08', '2024-12-08 01:21:08', '10048692-may-giat-toshiba-8-5-kg-inverter-tw-bk95s3v-sk-1.jpg');
INSERT INTO `product_images` VALUES (61, '/storage/product/1/JNhEfJA1ebac4HnR54xrF8k1xZoxZp7iSwYGkYhw.jpg', 8, '2024-12-08 01:21:08', '2024-12-08 01:21:08', '10048692-may-giat-toshiba-8-5-kg-inverter-tw-bk95s3v-sk-2.jpg');
INSERT INTO `product_images` VALUES (62, '/storage/product/1/7NpZWl61AJalFUhdJyucV3r2CFkDACHeJ3zmLO4t.png', 10, '2024-12-08 09:59:22', '2024-12-08 09:59:22', 'anh-sp-1683512633.png');
INSERT INTO `product_images` VALUES (63, '/storage/product/1/TARMaG5BPx7jjlTeclp4HEMmES7RVXVhj3PfM5Kn.jpg', 11, '2024-12-10 08:18:25', '2024-12-10 08:18:25', '10020829-bep-hong-ngoai-sunhouse-shd6011-01.jpg');
INSERT INTO `product_images` VALUES (64, '/storage/product/1/jx1JxbpJtMttkaOabD3Hg0yHtqTyopRUqjn4xHwj.jpg', 11, '2024-12-10 08:18:25', '2024-12-10 08:18:25', '10020829-bep-hong-ngoai-sunhouse-shd6011-02.jpg');
INSERT INTO `product_images` VALUES (65, '/storage/product/1/ogWT8k7a7IQD5bOCQJ7mHVtit0YTqHwvMj8lGD1x.jpg', 11, '2024-12-10 08:18:25', '2024-12-10 08:18:25', '10020829-bep-hong-ngoai-sunhouse-shd6011-03.jpg');
INSERT INTO `product_images` VALUES (66, '/storage/product/1/hpp3BttGxxj7G2PtKZkb6LqN3qOrsotZSB4HNKoV.jpg', 12, '2024-12-10 17:17:20', '2024-12-10 17:17:20', '10019441-may-nuoc-nong-ferroli-qq-evo-te-01.jpg');
INSERT INTO `product_images` VALUES (67, '/storage/product/1/wDb7W1XSOnIepC8sjhmTQCflLUAcUZsCB7lDatlf.jpg', 12, '2024-12-10 17:17:20', '2024-12-10 17:17:20', '10019441-may-nuoc-nong-ferroli-qq-evo-te-02.jpg');
INSERT INTO `product_images` VALUES (68, '/storage/product/1/TX3fpHtHmIOZmzAiNxbdw5a4Bn6lBO8ufNi4VEUw.jpg', 12, '2024-12-10 17:17:20', '2024-12-10 17:17:20', '10019441-may-nuoc-nong-ferroli-qq-evo-te-05.jpg');
INSERT INTO `product_images` VALUES (69, '/storage/product/1/v3r3K2usnpmNdzyBCrgopdClafMcGVN84ZTSEk8h.jpg', 13, '2024-12-11 00:55:25', '2024-12-11 00:55:25', '10055719-tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-4.jpg');
INSERT INTO `product_images` VALUES (70, '/storage/product/1/R57B7uLKaKvp7AcIjGPNdXhOZpiVdAmKnUGEk2x3.jpg', 13, '2024-12-11 00:55:25', '2024-12-11 00:55:25', '10055719-tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-5.jpg');
INSERT INTO `product_images` VALUES (71, '/storage/product/11/b51clK8xWaBRVJG9t8beKpMhPSM85jIjDdrkPxpc.jpg', 14, '2024-12-11 03:03:49', '2024-12-11 03:03:49', '10032712-noi-com-dien-toshiba-1l-rc-10nmfvn-wt-2_t5qh-vl.jpg');

-- ----------------------------
-- Table structure for product_tags
-- ----------------------------
DROP TABLE IF EXISTS `product_tags`;
CREATE TABLE `product_tags`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_product_tags_product`(`product_id` ASC) USING BTREE,
  INDEX `fk_product_tags_tag`(`tag_id` ASC) USING BTREE,
  CONSTRAINT `fk_product_tags_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_tags_tag` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product_tags
-- ----------------------------
INSERT INTO `product_tags` VALUES (19, 7, 19, '2024-12-08 00:49:49', '2024-12-08 00:49:49');
INSERT INTO `product_tags` VALUES (20, 8, 20, '2024-12-08 01:21:08', '2024-12-08 01:21:08');
INSERT INTO `product_tags` VALUES (21, 9, 21, '2024-12-08 02:25:10', '2024-12-08 02:25:10');
INSERT INTO `product_tags` VALUES (22, 10, 21, '2024-12-08 09:59:22', '2024-12-08 09:59:22');
INSERT INTO `product_tags` VALUES (23, 11, 22, '2024-12-10 08:18:25', '2024-12-10 08:18:25');
INSERT INTO `product_tags` VALUES (24, 12, 23, '2024-12-10 17:17:20', '2024-12-10 17:17:20');
INSERT INTO `product_tags` VALUES (25, 13, 24, '2024-12-11 00:55:25', '2024-12-11 00:55:25');
INSERT INTO `product_tags` VALUES (26, 14, 25, '2024-12-11 03:03:49', '2024-12-11 03:03:49');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_image_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `feature_image_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `views-count` int NOT NULL DEFAULT 0,
  `quantity` decimal(10, 0) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_products_user`(`user_id` ASC) USING BTREE,
  INDEX `fk_products_category`(`category_id` ASC) USING BTREE,
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_products_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (6, 'BRAVIA 3 Tivi LED Sony 4K', '16990000', '/storage/product/1/LKB4UBlN7qqOTE2f0d5NpoTF53nbmhy4rbFT9KVZ.jpg', '<div class=\"featureContent featureContent_1col featureContent_1_image\">\r\n<h3 class=\"featureContent_title\">Thiết kế tinh tế, hiện đại đầy ấn tượng h&agrave;i h&ograve;a với mọi kh&ocirc;ng gian c&ugrave;ng m&agrave;n h&igrave;nh 55 inch</h3>\r\n<p class=\"featureContent_caption\"><a title=\"Google Tivi LED Sony 4K 55 inch K-55S30 VN3\" href=\"https://www.nguyenkim.com/google-tivi-led-sony-4k-55-inch-k-55s30-vn3.html\" target=\"_blank\" rel=\"noopener noreferrer\">Google Tivi LED Sony 4K 55 inch K-55S30 VN3</a>&nbsp;c&oacute; thiết kế hiện đại thu h&uacute;t mọi &aacute;nh nh&igrave;n, đường viền mỏng tinh xảo c&ugrave;ng ch&acirc;n đế chữ V vững chắc, n&acirc;ng đỡ m&agrave;n h&igrave;nh chắc chắn, ổn định, dễ d&agrave;ng bố tr&iacute; tr&ecirc;n kệ tủ, kệ tivi,... Với k&iacute;ch thước m&agrave;n h&igrave;nh l&ecirc;n đến&nbsp;<a href=\"https://www.nguyenkim.com/tivi/?features_hash=76-155037\" target=\"_blank\" rel=\"noopener noreferrer\">55 inch</a>&nbsp;ph&ugrave; hợp cho những kh&ocirc;ng gian như ph&ograve;ng kh&aacute;ch, ph&ograve;ng ngủ, ph&ograve;ng họp,...</p>\r\n<img class=\"imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Tivi/S30/google-tivi-led-sony-4k-55-inch-k-55s30-vn3%20(1).jpg\" alt=\"Google Tivi LED Sony 4K 55 inch K-55S30 VN3\" width=\"100%\" loading=\"lazy\"></div>\r\n<div class=\"featureContent featureContent_1col featureContent_1_image\">\r\n<h3 class=\"featureContent_title\">Trải nghiệm h&igrave;nh ảnh sắc n&eacute;t với độ ph&acirc;n giải 4K v&agrave; sống động nhờ&nbsp;c&ocirc;ng nghệ Triluminos Pro</h3>\r\n<p class=\"featureContent_caption\"><a title=\"tivi Sony\" href=\"https://www.nguyenkim.com/tivi-sony-vi/\">Tivi Sony</a>&nbsp;K-55S30 VN3 c&oacute; độ ph&acirc;n giải 4K cho h&igrave;nh ảnh sắc n&eacute;t để bạn cảm nhận h&igrave;nh ảnh được ch&acirc;n thực nhất qua mọi khung h&igrave;nh. Đồng thời với hơn 1 tỉ m&agrave;u sắc của c&ocirc;ng nghệ&nbsp;Triluminos Pro c&ugrave;ng bộ vi xử l&yacute;&nbsp;4K HDR Processor X1&nbsp;cho h&igrave;nh ảnh sống động v&agrave; rực rỡ với độ tương phản cao, t&aacute;i hiện ch&acirc;n thực mọi nội dung để bạn tận hưởng trọn vẹn qua từng khung h&igrave;nh.</p>\r\n<img class=\"imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Tivi/S30/google-tivi-led-sony-4k-43-inch-k-43s30-vn3-1.jpg\" alt=\"Google Tivi LED Sony 4K 55 inch K-55S30 VN3\" width=\"100%\" loading=\"lazy\"></div>\r\n<div class=\"featureContent featureContent_2col feature_txt-img\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">Chia sẻ nội dung từ điện thoại l&ecirc;n tivi th&ocirc;ng qua Chromecast, AirPlay 2</h3>\r\n<article class=\"featureContent_caption\">Bạn c&oacute; thể chia sẻ nội dung từ điện thoại l&ecirc;n tivi th&ocirc;ng qua Chromecast hoặc AirPlay 2 để tận hưởng nội dung kh&ocirc;ng giới hạn, cho trải nghiệm trọn vẹn hơn c&ugrave;ng với gia đ&igrave;nh v&agrave; bạn b&egrave;.</article>\r\n</div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Tivi/xr70/google-tivi-mini-led-sony-4k-75-inch-k-75xr70-vn3-3.jpg\" alt=\"Google Tivi LED Sony 4K 55 inch K-55S30 VN3\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_img-txt\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Tivi/xr70/google-tivi-mini-led-sony-4k-65-inch-k-65xr70-vn3-7.jpg\" alt=\"Google Tivi LED Sony 4K 55 inch K-55S30 VN3\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">Hệ điều h&agrave;nh Google Tivi với giao diện th&ocirc;ng minh dễ d&agrave;ng t&igrave;m kiếm</h3>\r\n<article class=\"featureContent_caption\">Tivi Sony 55 inch&nbsp;K-55S30 VN3&nbsp;sử dụng hệ điều h&agrave;nh Google Tivi với giao diện dễ sử dụng th&acirc;n thiện với người d&ugrave;ng c&ugrave;ng nhiều ứng dung c&oacute; sẵn như: Youtube, FPT Play, Netflix,... cho bạn thỏa sức kh&aacute;m ph&aacute; v&agrave; trải nghiệm v&ocirc; v&agrave;n những nội dung giải tr&iacute; kh&aacute;c nhau.</article>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_txt-img\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">C&ocirc;ng nghệ S-Master Digital Amplifier mang đến &acirc;m thanh b&ugrave;ng nổ</h3>\r\n<article class=\"featureContent_caption\">Google Tivi Sony 4K 55 inch&nbsp;K-55S30 VN3&nbsp;được trang bị c&ocirc;ng nghệ S-Master Digital Amplifier mang đến &acirc;m thanh sống động, b&ugrave;ng nổ v&agrave; mạnh mẽ như rạp chiếu phim để bạn c&oacute; thể tận hưởng mọi nội dung y&ecirc;u th&iacute;ch với cảm gi&aacute;c ch&acirc;n thực nhất ngay tại nh&agrave; được&nbsp;r&otilde;, to hơn v&agrave; kh&ocirc;ng bị r&egrave;.</article>\r\n</div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Tivi/S30/google-tivi-led-sony-4k-43-inch-k-43s30-vn3-4.jpg\" alt=\"Google Tivi LED Sony 4K 55 inch K-55S30 VN3\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_img-txt\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Tivi/S30/google-tivi-led-sony-4k-43-inch-k-43s30-vn3-3.jpg\" alt=\"Google Tivi LED Sony 4K 55 inch K-55S30 VN3\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">X-Balanced Speaker mang đến &acirc;m thanh ch&acirc;n thực v&agrave; r&otilde; n&eacute;t</h3>\r\n<article class=\"featureContent_caption\">X-Balanced Speaker được thiết kế với kiểu loa c&acirc;n bằng ph&ugrave; hợp với độ mỏng của tivi nhằm cải thiện chất lượng &acirc;m thanh được r&otilde; n&eacute;t v&agrave; sống động hơn cho bạn trải nghiệm ch&acirc;n thực qua từng giai điệu &acirc;m nhạc hay những thước phim h&agrave;nh động cuốn h&uacute;t, mang đến &acirc;m thanh trong r&otilde; với &acirc;m trầm mạnh mẽ.</article>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_txt-img\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">Điều khiển tivi bằng giọng n&oacute;i</h3>\r\n<article class=\"featureContent_caption\"><a title=\"Tivi\" href=\"https://www.nguyenkim.com/tivi/\">Tivi</a>&nbsp;Sony 4K 55 inch&nbsp;K-55S30 VN3&nbsp;c&oacute; thể được điều khiển bằng giọng n&oacute;i của bạn th&ocirc;ng qua&nbsp;c&acirc;u n&oacute;i \"OK google + c&acirc;u lệnh\" trực tiếp v&agrave;o tivi hoặc t&igrave;m kiếm bằng giọng n&oacute;i truyền thống bằng remote v&ocirc; c&ugrave;ng tiện lợi.</article>\r\n</div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Tivi/xr70/google-tivi-mini-led-sony-4k-65-inch-k-65xr70-vn3-8.jpg\" alt=\"Google Tivi LED Sony 4K 55 inch K-55S30 VN3\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n</div>', 1, 20, '2024-12-03 09:35:32', '2024-12-11 02:41:38', 'Google_Tivi_LED_Sony_4K_55_inch_K-55S30_VN3-2.jpg', NULL, 0, 86);
INSERT INTO `products` VALUES (7, 'Nồi cơm điện Toshiba 2L', '2990000', '/storage/product/1/8ZLUxaImU7mAOsduiaPcHKZx24bmLsr2oxbW24d4.jpg', '<p>Nồi cơm Toshiba 2L</p>', 1, 22, '2024-12-08 00:49:49', '2024-12-11 03:06:53', '10032712.jpg', NULL, 0, 6);
INSERT INTO `products` VALUES (8, 'Máy giặt Aqua 9kg', '7990000', '/storage/product/1/pvpKRIHsZZSCang2hTRnEisydIO8oo3oLCVCWU9T.jpg', '<p>M&aacute;y giặt Aqua 9kg</p>', 1, 23, '2024-12-08 01:21:08', '2024-12-10 09:32:57', '10048692-may-giat-toshiba-8-5-kg-inverter-tw-bk95s3v-sk-1.jpg', NULL, 0, 0);
INSERT INTO `products` VALUES (9, 'TV sony bravia 1', '1900000', NULL, '<p>TV sony 123</p>', 1, 20, '2024-12-08 02:25:10', '2024-12-08 09:58:33', NULL, '2024-12-08 09:58:33', 0, 1);
INSERT INTO `products` VALUES (10, 'TV Samsung', '21000000', '/storage/product/1/0xysZVQUoijhnZrzMhtooe93mcYD7cfcR8TCkANY.jpg', '<p>xxzx</p>', 1, 20, '2024-12-08 09:59:22', '2024-12-10 12:27:23', '10055297-google-tivi-sony-bravia-4k-55-inch-kd-55x80l-vn3-3.jpg', NULL, 0, 0);
INSERT INTO `products` VALUES (11, 'Bếp điện Sunhouse', '599000', '/storage/product/1/M276CoOv5FBLi55UI6iYYmqbZHxokwFSH3YgMR5w.jpg', '<p>Bếp điện Sunhouse</p>', 1, 22, '2024-12-10 08:18:25', '2024-12-10 12:28:31', '10020829-bep-hong-ngoai-sunhouse-shd6011-01.jpg', NULL, 0, 0);
INSERT INTO `products` VALUES (12, 'Máy nước nóng Ferroli QQ Evo', '3000000', '/storage/product/1/JDKtCjkrQU3L6LtEhMY6SvTZUvknDZqbpKJTHU1k.jpg', '<p>M&aacute;y nước n&oacute;ng Ferroli QQ Evo</p>', 1, 20, '2024-12-10 17:17:20', '2024-12-10 17:19:27', '10019441-may-nuoc-nong-ferroli-qq-evo-te-01.jpg', NULL, 0, 10);
INSERT INTO `products` VALUES (13, 'Tủ lạnh Toshiba Inverter 180 lít GR-RT234WE-PMV(52)', '5190000', '/storage/product/1/ArPGoWdXUQT3tEYnYthp2hfQMsMcpPxCz31Onz65.jpg', '<div class=\"featureContent featureContent_1col featureContent_1_image\">\r\n<div class=\"featureContent featureContent_1col featureContent_1_image\">\r\n<h3 class=\"featureContent_title\">T&iacute;ch hợp h&agrave;ng loạt c&ocirc;ng nghệ bảo quản thực phẩm ti&ecirc;n tiến</h3>\r\n<article class=\"featureContent_caption\">\r\n<p>Tủ lạnh Toshiba Inverter 180 l&iacute;t GR-RT234WE-PMV(52) kho&aacute;c tr&ecirc;n m&igrave;nh m&agrave;u kim loại x&aacute;m Sapphire hiện đại, lịch l&atilde;m, ph&ugrave; hợp với mọi loại kh&ocirc;ng gian nội thất. Kết hợp với đ&oacute; l&agrave; thiết kế tay cầm lấy cảm hứng từ d&aacute;ng kiếm Katana Nhật Bản tinh xảo, tạo điểm nhấn ấn tượng cho sản phẩm. Chưa dừng lại, chiếc tủ lạnh Toshiba 180l thế hệ mới n&agrave;y c&ograve;n được t&iacute;ch hợp h&agrave;ng loạt c&ocirc;ng nghệ th&ocirc;ng minh như: C&ocirc;ng nghệ PureBio giữ thực phẩm tươi sạch hơn, c&ocirc;ng nghệ tiết kiệm điện năng ORIGIN Inverter, ngăn đ&ocirc;ng mềm Cooling Zone bảo quản thực phẩm tươi sống nấu ngay kh&ocirc;ng cần r&atilde; đ&ocirc;ng v&agrave; hơn thế nữa. V&igrave; vậy,&nbsp;<a href=\"https://www.nguyenkim.com/tu-lanh-inverter-la-gi.html\">tủ lạnh Inverter</a>&nbsp;n&agrave;y hứa hẹn sẽ l&agrave; trợ thủ đắc lực g&oacute;p phần mang đến những bữa ăn ngon v&agrave; an to&agrave;n cho gia đ&igrave;nh bạn.</p>\r\n<p>&nbsp;</p>\r\n<img class=\"imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/dien-lanh/tu-lanh/Toshiba/GR-RT234WE-PMV(52)/tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-1%20(1).jpg\" alt=\"Tủ lạnh Toshiba Inverter - Thiết kế sang trọng\" width=\"100%\" loading=\"lazy\"></article>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_txt-img\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">Tay cầm d&aacute;ng kiếm Katana sang trọng, sắc n&eacute;t</h3>\r\n<article class=\"featureContent_caption\">\r\n<p><a href=\"https://www.nguyenkim.com/tu-lanh/\">Tủ lạnh</a>&nbsp;Toshiba 180l thiết kế tay cầm tinh tế v&agrave; sắc n&eacute;t, mang đến sự sang trọng nhờ lấy cảm hứng từ phong c&aacute;ch độc đ&aacute;o của lưỡi kiếm Katana - biểu tượng huyền thoại của Nhật Bản. Thiết kế n&agrave;y gi&uacute;p người d&ugrave;ng dễ d&agrave;ng cầm nắm cũng như rất thuận tiện cho việc vệ sinh.</p>\r\n</article>\r\n</div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/dien-lanh/tu-lanh/Toshiba/GR-RT234WE-PMV(52)/tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-1_1.jpg\" alt=\"Tủ lạnh Toshiba Inverter - thiết kế sang trọng\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_img-txt\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/dien-lanh/tu-lanh/Toshiba/GR-RT234WE-PMV(52)/tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-2.jpg\" alt=\"Tủ lạnh Toshiba Inverter - Khử m&ugrave;i, diệt khuẩn hiệu quả\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">Diệt khuẩn mạnh mẽ, loại bỏ m&ugrave;i h&ocirc;i kh&oacute; chịu</h3>\r\n<article class=\"featureContent_caption\">\r\n<p>Tủ lạnh Toshiba 180l t&iacute;ch hợp bộ lọc PureBio sử dụng Ag+ BIO c&oacute; khả năng loại bỏ triệt để c&aacute;c m&ugrave;i kh&oacute; chịu từ thực phẩm chứa c&aacute;c gốc Sulfur v&agrave; Nitrogen. Đồng thời, n&oacute; cũng c&oacute; khả năng khử m&ugrave;i v&agrave; diệt khuẩn mạnh mẽ trong suốt thời gian sử dụng, đảm bảo sức khỏe ăn uống cả nh&agrave; bạn.</p>\r\n<p><em>&gt;&gt; Xem th&ecirc;m:</em></p>\r\n<p><em>-&nbsp;<a href=\"https://www.nguyenkim.com/cong-nghe-khang-khuan-khu-mui-la-gi.html\">C&ocirc;ng Nghệ Kh&aacute;ng Khuẩn, Khử M&ugrave;i Tr&ecirc;n Tủ Lạnh L&agrave; G&igrave;?</a></em></p>\r\n<p><em>-&nbsp;<a href=\"https://www.nguyenkim.com/nhung-cong-nghe-khu-mui-bat-nhat-cua-cac-nha-hang-tu-lanh-noi-tieng.html\">Những c&ocirc;ng nghệ khử m&ugrave;i bật nhất của c&aacute;c nh&agrave; h&atilde;ng tủ lạnh nổi tiếng</a></em></p>\r\n</article>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_txt-img\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">C&ocirc;ng nghệ Origin Inverter tiết kiệm điện</h3>\r\n<article class=\"featureContent_caption\">C&ocirc;ng nghệ Origin Inverter hiện đại ứng dụng tr&ecirc;n cả m&aacute;y n&eacute;n v&agrave; quạt Inverter gi&uacute;p m&aacute;y tiết kiệm điện l&ecirc;n đến 50% v&agrave; thổi hơi lạnh một c&aacute;ch đều đặn, để l&agrave;m lạnh nhanh nhằm bảo vệ thực phẩm tối ưu. Đồng thời, c&ocirc;ng nghệ n&agrave;y c&ograve;n gi&uacute;p tủ vận h&agrave;nh &ecirc;m &aacute;i, kh&ocirc;ng l&agrave;m phiền đến sinh hoạt của gia đ&igrave;nh bạn.</article>\r\n<article class=\"featureContent_caption\">\r\n<p><em>&gt;&gt; Xem th&ecirc;m:</em></p>\r\n<p><em>-&nbsp;</em><em><a href=\"https://www.nguyenkim.com/tu-lanh-inverter-se-giup-giam-chi-phi-dien-nang-den-muc-nao.html\">Tủ lạnh Inverter sẽ gi&uacute;p giảm chi ph&iacute; điện năng đến mức n&agrave;o?</a></em></p>\r\n<p><em>-&nbsp;</em><em><a href=\"https://www.nguyenkim.com/tu-lanh-inverter-la-gi.html\">Tủ lạnh Inverter l&agrave; g&igrave;? Đ&acirc;y l&agrave; tất tần tật những điều bạn cần biết!</a></em></p>\r\n</article>\r\n</div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/dien-lanh/tu-lanh/Toshiba/GR-RT234WE-PMV(52)/tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-3.jpg\" alt=\"Tủ lạnh Toshiba - C&ocirc;ng nghệ Origin Inveter tiết kiệm điện\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_img-txt\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/dien-lanh/tu-lanh/Toshiba/GR-RT234WE-PMV(52)/tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-7.jpg\" alt=\"Tủ lạnh Toshiba Inverter - Ngăn đ&ocirc;ng lớn\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">Ngăn đ&ocirc;ng cực lớn 61 L - Trữ đ&ocirc;ng thực phẩm cho cả tuần</h3>\r\n<article class=\"featureContent_caption\"><a href=\"https://www.nguyenkim.com/tu-lanh-toshiba\">Tủ lạnh Toshiba</a>&nbsp;Inverter 180 l&iacute;t GR-RT234WE-PMV(52) cải tiến ngăn đ&ocirc;ng rộng r&atilde;i với dung t&iacute;ch lớn tới 61 l&iacute;t để người d&ugrave;ng c&oacute; thể trữ nhiều loại thực phẩm kh&aacute;c nhau, đi chợ một lần m&agrave; sử dụng được nhiều ng&agrave;y, tiết kiệm thời gian qu&yacute; b&aacute;u của m&igrave;nh.</article>\r\n<article class=\"featureContent_caption\">\r\n<p><em>&gt;&gt; Xem th&ecirc;m:&nbsp;</em></p>\r\n<p><em>-&nbsp;<a href=\"https://www.nguyenkim.com/cac-cong-nghe-bao-quan-thuc-pham-tren-tu-lanh.html\">Những c&ocirc;ng nghệ bảo quản thực phẩm tr&ecirc;n tủ lạnh người d&ugrave;ng n&ecirc;n biết</a></em></p>\r\n<em>-&nbsp;<a href=\"https://www.nguyenkim.com/tong-hop-cac-cach-bao-quan-thuc-pham.html\">Tổng hợp c&aacute;c c&aacute;ch bảo quản thực phẩm tươi ngon trong thời gian d&agrave;i</a></em></article>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_txt-img\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">Ngăn đ&ocirc;ng mềm&nbsp;Cooling Zone - Nấu ăn kh&ocirc;ng cần r&atilde; đ&ocirc;ng</h3>\r\n<article class=\"featureContent_caption\">\r\n<p>Thay v&igrave; l&agrave;m đ&oacute;ng băng cứng đến tận l&otilde;i l&agrave;m ph&aacute; vỡ cấu tr&uacute;c của thực phẩm,&nbsp;<a href=\"https://www.nguyenkim.com/ngan-dong-mem-la-gi-nhung-loi-ich-vuot-troi-cua-ngan-dong-mem.html\">ngăn đ&ocirc;ng mềm</a>&nbsp;Cooling Zone chỉ tạo một lớp băng mỏng tr&ecirc;n bề mặt thịt c&aacute; v&agrave; sử dụng nước b&ecirc;n trong ch&uacute;ng để h&igrave;nh th&agrave;nh c&aacute;c tinh thể băng si&ecirc;u nhỏ. Thực phẩm nhờ đ&oacute; bảo vệ được cấu tr&uacute;c của c&aacute;c tế b&agrave;o, khi chế biến th&igrave; c&oacute; thể cắt th&aacute;i, tẩm ướp ngay kh&ocirc;ng cần phải r&atilde; đ&ocirc;ng n&ecirc;n giữ nguy&ecirc;n c&aacute;c chất dinh dưỡng v&agrave; hương vị thơm ngon vốn c&oacute;.</p>\r\n<em>&gt;&gt; Xem th&ecirc;m:&nbsp;<a href=\"https://www.nguyenkim.com/nhung-dieu-ban-chua-biet-ve-ngan-cap-dong-mem-ultra-cooling-zone.html\">Những Điều Bạn Chưa Biết Về Ngăn Cấp Đ&ocirc;ng Mềm Ultra Cooling Zone</a></em></article>\r\n</div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/dien-lanh/tu-lanh/Toshiba/GR-RT234WE-PMV(52)/tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-ngan-dong-mem.jpg\" alt=\"Tủ lạnh Toshiba Inverter - Ngăn đ&ocirc;ng mềm cooling zone\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_img-txt\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/dien-lanh/tu-lanh/Toshiba/GR-RT234WE-PMV(52)/tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-6.jpg\" alt=\"Tủ lạnh Toshiba Inverter - c&ocirc;ng nghệ l&agrave;m lạnh đa chiều\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">L&agrave;m lạnh đa chiều gi&uacute;p thực phẩm tươi l&acirc;u hơn</h3>\r\n<article class=\"featureContent_caption\">\r\n<p>Hệ thống&nbsp;<a href=\"https://www.nguyenkim.com/tat-tan-tat-ve-cong-nghe-lam-lanh-da-chieu-tren-tu-lanh.html\">l&agrave;m lạnh đa chiều</a>&nbsp;trang bị b&ecirc;n trong tủ lạnh Toshiba 180l gi&uacute;p tỏa nhiệt đều khắp khoang tủ, đồng thời giữ nhiệt độ ổn định để bảo quản thực phẩm tươi ngon trong thời gian d&agrave;i.</p>\r\n<em>&gt;&gt; Xem th&ecirc;m:&nbsp;<a href=\"https://www.nguyenkim.com/13-cong-nghe-va-tien-ich-tu-lanh-danh-cho-ban.html\">Điểm mặt c&aacute;c c&ocirc;ng nghệ v&agrave; tiện &iacute;ch thường gặp tr&ecirc;n tủ lạnh</a></em></article>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_txt-img\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">Kệ cửa tối ưu, ngăn chứa rau lớn</h3>\r\n<article class=\"featureContent_caption\">Kệ cửa tủ lạnh Toshiba 180l thiết kế rộng r&atilde;i v&agrave; c&oacute; sức chứa lớn, c&oacute; thể chứa khoảng 6 chai nước dung t&iacute;ch 1.5l để bạn c&oacute; thể lưu trữ nhiều loại nước m&aacute;t hơn. Ngo&agrave;i ra, ngăn rau ri&ecirc;ng biệt với dung t&iacute;ch đến 12l gi&uacute;p bạn lưu trữ nhiều loại thực phẩm c&oacute; k&iacute;ch thước lớn như sầu ri&ecirc;ng hay c&aacute;c loại rau kh&aacute;c.</article>\r\n</div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/dien-lanh/tu-lanh/Toshiba/GR-RT234WE-PMV(52)/tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-4.jpg\" alt=\"Tủ lạnh Toshiba Inverter 180 l&iacute;t GR-RT234WE-PMV(52) kệ k&iacute;nh chịu lực\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n</div>\r\n<div class=\"featureContent featureContent_2col feature_img-txt\">\r\n<div class=\"featureContent_col-1\">\r\n<div class=\"featureContent_col_wrap\"><img class=\"img_feature imagelazyload\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/dien-lanh/tu-lanh/Toshiba/GR-RT234WE-PMV(52)/tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-5.jpg\" alt=\"Tủ lạnh Toshiba Inverter 180 l&iacute;t GR-RT234WE-PMV(52) kệ k&iacute;nh chịu lực\" width=\"100%\" loading=\"lazy\"></div>\r\n</div>\r\n<div class=\"featureContent_col-2\">\r\n<div class=\"featureContent_col_wrap\">\r\n<h3 class=\"featureContent_title\">Khay k&iacute;nh linh hoạt, chịu lực tốt</h3>\r\n<article class=\"featureContent_caption\">Kệ tủ lạnh Toshiba 180l thiết kế linh hoạt c&oacute; khả năng điều chỉnh vị tr&iacute;, tạo điều kiện thuận lợi trong việc lưu trữ c&aacute;c loại thực phẩm c&oacute; k&iacute;ch thước kh&aacute;c nhau. Kệ cũng chịu lực tốt để bạn y&ecirc;n t&acirc;m lưu trữ c&aacute;c thực phẩm trọng lượng nặng.</article>\r\n</div>\r\n</div>\r\n</div>', 1, 27, '2024-12-11 00:55:25', '2024-12-11 00:55:25', '10055719-tu-lanh-toshiba-inverter-gr-rt234we-pmv-52-1_cvdb-w6.jpg', NULL, 0, 15);
INSERT INTO `products` VALUES (14, 'Nồi cơm To', '2100000', '/storage/product/11/SprDHV54l1Jt7VLaUy3uH74yT9P0SDzAMP4CGkFz.jpg', '<p>Noi com</p>', 11, 22, '2024-12-11 03:03:49', '2024-12-11 03:03:49', '10032712-noi-com-dien-toshiba-1l-rc-10nmfvn-wt-3_1vz6-so_mqvu-gr.jpg', NULL, 0, 14);

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_role_user_user`(`user_id` ASC) USING BTREE,
  INDEX `fk_role_user_role`(`role_id` ASC) USING BTREE,
  CONSTRAINT `fk_role_user_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_user_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES (1, 1, 1, NULL, NULL);
INSERT INTO `role_user` VALUES (8, 11, 3, NULL, NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'host', 'Chủ cửa hàng', '2024-11-17 06:12:23', '2024-11-17 06:12:23');
INSERT INTO `roles` VALUES (3, 'staff', 'Nhân viên', '2024-11-17 09:17:44', '2024-11-17 09:17:44');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `config_key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_input` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for sliders
-- ----------------------------
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sliders
-- ----------------------------
INSERT INTO `sliders` VALUES (6, 'Panasonic', 'Panasonic', '/storage/slider/1/DJkoImky13kEvHswjH84MQiZW3TFtCsNrmgGtTEZ.jpg', 'panasonictv.jpg', '2024-12-09 06:16:17', '2024-12-09 06:16:17', NULL);

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES (19, '.noi com', '2024-12-08 00:49:49', '2024-12-08 00:49:49');
INSERT INTO `tags` VALUES (20, 'maygiat', '2024-12-08 01:21:08', '2024-12-08 01:21:08');
INSERT INTO `tags` VALUES (21, 'tv', '2024-12-08 02:25:10', '2024-12-08 02:25:10');
INSERT INTO `tags` VALUES (22, 'noicom', '2024-12-10 08:18:25', '2024-12-10 08:18:25');
INSERT INTO `tags` VALUES (23, 'sanphamhot', '2024-12-10 17:17:20', '2024-12-10 17:17:20');
INSERT INTO `tags` VALUES (24, 'toshibahotdeal', '2024-12-11 00:55:25', '2024-12-11 00:55:25');
INSERT INTO `tags` VALUES (25, 'noicomdeal', '2024-12-11 03:03:49', '2024-12-11 03:03:49');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Quân', 'quazkd@gmail.com', NULL, '$2y$12$YWGAzWB7MZ77ogMfrhgvVeAB8f6DyaMUxCOJFMHTo/8S2Ou.FXIMq', NULL, NULL, '2024-12-03 18:10:23', NULL, NULL, NULL);
INSERT INTO `users` VALUES (10, 'Nam', 'nam@gmail.com', NULL, '$2y$12$WkMxix95YffNDk7GOtLU5.pqJ3qJuGG7aGmuyL0znkJE12GsSWliC', NULL, '2024-12-08 14:57:06', '2024-12-08 14:57:06', NULL, '0344143909', 'Ba Vì');
INSERT INTO `users` VALUES (11, 'Nam1', 'nam1@gmail.com', NULL, '$2y$12$IbYgcNnkQzUhFKGHlzoEreedA4yDKN74fg0LsIZfXOjZPu4TPgzXu', NULL, '2024-12-08 14:58:14', '2024-12-11 02:07:07', NULL, '0344143909', 'Ba Vì');

SET FOREIGN_KEY_CHECKS = 1;
