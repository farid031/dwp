/*
 Navicat Premium Data Transfer

 Source Server         : PostgreSQL Local
 Source Server Type    : PostgreSQL
 Source Server Version : 130001
 Source Host           : localhost:5432
 Source Catalog        : dwp
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 130001
 File Encoding         : 65001

 Date: 02/10/2022 20:54:23
*/


-- ----------------------------
-- Table structure for customer_status
-- ----------------------------
DROP TABLE IF EXISTS "public"."customer_status";
CREATE TABLE "public"."customer_status" (
  "stat_cust_id" serial8,
  "stat_cust_label" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of customer_status
-- ----------------------------
INSERT INTO "public"."customer_status" VALUES (1, 'Qualified');
INSERT INTO "public"."customer_status" VALUES (3, 'Not Qualified');
INSERT INTO "public"."customer_status" VALUES (4, 'Draft');
INSERT INTO "public"."customer_status" VALUES (2, 'Waiting Manager Approval');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS "public"."customers";
CREATE TABLE "public"."customers" (
  "cust_id" serial8,
  "cust_name" text COLLATE "pg_catalog"."default",
  "cust_alamat" text COLLATE "pg_catalog"."default",
  "cust_pic_name" varchar(255) COLLATE "pg_catalog"."default",
  "cust_pic_telp" varchar(255) COLLATE "pg_catalog"."default",
  "cust_is_customer" bool,
  "cust_status" int8,
  "cust_created_by" int8,
  "cust_created_at" timestamp(6),
  "cust_updated_by" int8,
  "cust_updated_at" timestamp(6)
)
;

-- ----------------------------
-- Table structure for penawaran_detail
-- ----------------------------
DROP TABLE IF EXISTS "public"."penawaran_detail";
CREATE TABLE "public"."penawaran_detail" (
  "pen_det_id" serial8,
  "pen_det_id_head" int8,
  "pen_det_produk_id" int8,
  "pen_det_harga" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for penawaran_header
-- ----------------------------
DROP TABLE IF EXISTS "public"."penawaran_header";
CREATE TABLE "public"."penawaran_header" (
  "pen_id" serial8,
  "pen_cust_id" int8,
  "pen_created_by" int8,
  "pen_created_at" timestamp(6),
  "pen_updated_by" int8,
  "pen_updated_at" timestamp(6),
  "pen_is_approve" bool,
  "pen_approved_by" int8,
  "pen_approved_at" timestamp(6),
  "pen_reject_note" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for produk
-- ----------------------------
CREATE SEQUENCE "public"."produk_produk_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

SELECT setval('"public"."produk_produk_id_seq"', 6, true);

ALTER SEQUENCE "public"."produk_produk_id_seq"
OWNED BY "public"."produk"."produk_id";

DROP TABLE IF EXISTS "public"."produk";
CREATE TABLE "public"."produk" (
  "produk_id" int8 NOT NULL DEFAULT nextval('produk_produk_id_seq'::regclass),
  "produk_label" text COLLATE "pg_catalog"."default",
  "produk_harga" numeric(255),
  "produk_created_by" int8,
  "produk_created_at" timestamp(6),
  "produk_updated_by" int8,
  "produk_updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO "public"."produk" VALUES (3, 'Paket Hemat 5 Mbps', 200000, NULL, '2022-10-02 02:30:01', NULL, NULL);
INSERT INTO "public"."produk" VALUES (1, 'Paket Gamer 20 Mbps', 500000, NULL, '2022-10-01 13:32:24', NULL, '2022-10-02 02:30:07');
INSERT INTO "public"."produk" VALUES (5, 'Paket Internet 10 Mbps + TV Kabel', 350000, NULL, '2022-10-02 02:30:57', NULL, NULL);
INSERT INTO "public"."produk" VALUES (4, 'Paket Entertaiment 15 Mbps', 400000, NULL, '2022-10-02 02:30:31', 3, '2022-10-02 15:52:58');

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS "public"."user_role";
CREATE TABLE "public"."user_role" (
  "usr_role_id" serial8,
  "usr_role_name" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO "public"."user_role" VALUES (1, 'admin');
INSERT INTO "public"."user_role" VALUES (2, 'manager');
INSERT INTO "public"."user_role" VALUES (3, 'sales');

-- ----------------------------
-- Table structure for users
-- ----------------------------
CREATE SEQUENCE "public"."user_user_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

SELECT setval('"public"."user_user_id_seq"', 14, true);

ALTER SEQUENCE "public"."user_user_id_seq"
OWNED BY "public"."users"."user_id";

DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "user_id" int8 NOT NULL DEFAULT nextval('user_user_id_seq'::regclass),
  "user_username" text COLLATE "pg_catalog"."default",
  "user_pass" text COLLATE "pg_catalog"."default",
  "user_role_id" int8,
  "user_created_by" int8,
  "user_created_at" timestamp(6),
  "user_updated_by" int8,
  "user_updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (1, 'admin@smart.id', '$2a$04$clJRHH4L0mz4uIkDvhMVtOa6n.4.Jol.87.r8TBgrioW34Js7BU3i', 1, NULL, NULL, NULL, NULL);
INSERT INTO "public"."users" VALUES (2, 'manager@smart.id', '$2a$04$U5GjHFKSQZ6TSWrzthQANuk7am7BRB5AKoB2rdVSetT.l31udDQxy', 2, NULL, NULL, NULL, NULL);
INSERT INTO "public"."users" VALUES (3, 'sales_farid@smart.id', '$2a$04$3GzEFb1FMCfvudgHisSp9O90Mmd7qya3dgrLhD9WJlfq/WS1KVNP6', 3, NULL, NULL, NULL, NULL);
INSERT INTO "public"."users" VALUES (4, 'sales_dono@smart.id', '$2a$04$22E5tIZ1GssE0seEcbvWNuXiA8OeoMOKVwQXmv/piOdwxNCEYMvr.', 3, NULL, NULL, NULL, NULL);
INSERT INTO "public"."users" VALUES (14, 'sales_andri@smart.id', '$2y$10$WgCobpbeeuQma92I6CFWMeDqTUuD0SgR5NGrfcoeL/uuekLjeDa1.', 3, 1, '2022-10-02 15:34:10', 1, '2022-10-02 15:45:44');

-- ----------------------------
-- Primary Key structure for table customer_status
-- ----------------------------
ALTER TABLE "public"."customer_status" ADD CONSTRAINT "customer_status_pkey" PRIMARY KEY ("stat_cust_id");

-- ----------------------------
-- Primary Key structure for table customers
-- ----------------------------
ALTER TABLE "public"."customers" ADD CONSTRAINT "customer_pkey" PRIMARY KEY ("cust_id");

-- ----------------------------
-- Primary Key structure for table penawaran_detail
-- ----------------------------
ALTER TABLE "public"."penawaran_detail" ADD CONSTRAINT "penawaran_detail_pkey" PRIMARY KEY ("pen_det_id");

-- ----------------------------
-- Primary Key structure for table penawaran_header
-- ----------------------------
ALTER TABLE "public"."penawaran_header" ADD CONSTRAINT "penawaran_header_pkey" PRIMARY KEY ("pen_id");

-- ----------------------------
-- Primary Key structure for table penawaran_status
-- ----------------------------
ALTER TABLE "public"."penawaran_status" ADD CONSTRAINT "penawaran_status_pkey" PRIMARY KEY ("pen_status_id");

-- ----------------------------
-- Primary Key structure for table produk
-- ----------------------------
ALTER TABLE "public"."produk" ADD CONSTRAINT "produk_pkey" PRIMARY KEY ("produk_id");

-- ----------------------------
-- Primary Key structure for table user_role
-- ----------------------------
ALTER TABLE "public"."user_role" ADD CONSTRAINT "user_role_pkey" PRIMARY KEY ("usr_role_id");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "user_pkey" PRIMARY KEY ("user_id");

-- ----------------------------
-- Foreign Keys structure for table penawaran_detail
-- ----------------------------
ALTER TABLE "public"."penawaran_detail" ADD CONSTRAINT "pen_id" FOREIGN KEY ("pen_det_id_head") REFERENCES "public"."penawaran_header" ("pen_id") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "public"."penawaran_detail" ADD CONSTRAINT "prod_id" FOREIGN KEY ("pen_det_produk_id") REFERENCES "public"."produk" ("produk_id") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- ----------------------------
-- Foreign Keys structure for table penawaran_header
-- ----------------------------
ALTER TABLE "public"."penawaran_header" ADD CONSTRAINT "cust_id" FOREIGN KEY ("pen_cust_id") REFERENCES "public"."customers" ("cust_id") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- ----------------------------
-- Foreign Keys structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "usr_role" FOREIGN KEY ("user_role_id") REFERENCES "public"."user_role" ("usr_role_id") ON DELETE RESTRICT ON UPDATE RESTRICT;
