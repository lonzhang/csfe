<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Table;
use DB;
use Cache;

/*
 * 表role_hsa_permissions操作常用方法封装
 */
class CsfeAppMenu extends Model
{
	use Table;
	
	function __construct(){
		if(Cache::has('bd_app_menu')){
			Cache::forget('bd_app_menu');
		}
    }
}
