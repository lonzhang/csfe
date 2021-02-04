<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsfeApps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE `csfe_apps` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID (Primary Key)',
  `app_title` VARCHAR(191) NOT NULL DEFAULT '' COMMENT 'app display name',
  `app_icon` VARCHAR(191) NOT NULL DEFAULT '' COMMENT 'app display icon',
  `app_description` VARCHAR(191) NOT NULL DEFAULT '' COMMENT 'app description',
  `app_active` TINYINT(4) NOT NULL DEFAULT 0 COMMENT '0:disable,1:active',
  `app_permission_path` VARCHAR(191) NOT NULL DEFAULT '' COMMENT 'related permission',
  `created_at` DATETIME NOT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='App Table';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
