<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsfeAppMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE `csfe_app_menus` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID (Primary Key)',
  `app_id` INT(10) NOT NULL COMMENT 'related csfe_apps.id',
  `apm_title` VARCHAR(191) NOT NULL DEFAULT '' COMMENT 'app menu display name',
  `apm_icon` VARCHAR(191) NOT NULL COMMENT 'app menu display icon',
  `apm_description` VARCHAR(191) NOT NULL DEFAULT '' COMMENT 'app menu description',
  `apm_url` VARCHAR(191) NOT NULL DEFAULT '' COMMENT 'related url',
  `created_at` DATETIME NOT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='App Menu Table';");
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
