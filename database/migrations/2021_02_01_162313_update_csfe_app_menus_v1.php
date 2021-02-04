<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCsfeAppMenusV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `csfe_app_menus`   
  ADD COLUMN `apm_level` CHAR(1) DEFAULT '1'  NOT NULL   COMMENT 'menu level' AFTER `apm_url`,
  ADD COLUMN `apm_father_id` INT(10) DEFAULT 0  NOT NULL   COMMENT 'related this.id' AFTER `apm_level`;");
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
