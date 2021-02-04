<?php

namespace App\Providers;

use App\Models\user;
use App\Models\CsfeApp;
use App\Models\CsfeAppMenu;
use Cache;

/*
 * 系统各缓存方法封装
 */
class CacheServiceProvider
{
    /*
     *获取基础信息，首次会读取数据库并保存到缓存中（新建基础信息表后可在此处增加）
     *输出值：以各表中的code为键值进行全表保存
     *创建人：Leon
     */
    static function getBaseData($item = '')
    {
		//检查是否存在对应缓存,有则从缓存中读取，无则从数据库中读取并保存到缓存中
		$base_data=array();	
		
		switch ($item) {
			case '':
			case 'app_menu':
				//读取菜单列表
				$base_data['app_menu'] = Self::getAppMenuCache();
				if($item) break;
			default:
				break;
		}

    	return $base_data;
    }
	
	/*
     *获取菜单列表缓存
     *输出值：  Array
		(
		    [1] => Array
		        (
		            [id] => 1
		            [app_title] => CS-PAC Request Case/SO Case Workpage
		            [app_icon] => 
		            [app_description] => 
		            [app_active] => 1
		            [app_permission_path] => 
		            [created_at] => 2021-02-01T09:49:49.000000Z
		            [updated_at] => 2021-02-01T09:49:49.000000Z
		            [level_one] => Array
		                (
		                    [0] => Array
		                        (
		                            [id] => 1
		                            [app_id] => 1
		                            [apm_title] => Home
		                            [apm_icon] => 
		                            [apm_description] => 
		                            [apm_url] => request-case/home
		                            [apm_level] => 1
		                            [apm_father_id] => 0
		                            [created_at] => 2021-02-01T09:49:49.000000Z
		                            [updated_at] => 2021-02-01T09:49:49.000000Z
		                        )

		                    [1] => Array
		                        (
		                            [id] => 2
		                            [app_id] => 1
		                            [apm_title] => Request Case
		                            [apm_icon] => 
		                            [apm_description] => 
		                            [apm_url] => request-case/request-case
		                            [apm_level] => 1
		                            [apm_father_id] => 0
		                            [created_at] => 2021-02-01T09:49:50.000000Z
		                            [updated_at] => 2021-02-01T09:49:50.000000Z
		                        )
		                )

		        )

		    [2] => Array
		        (
		            [id] => 2
		            [app_title] => Customer Service Complaint
		            [app_icon] => 
		            [app_description] => 
		            [app_active] => 1
		            [app_permission_path] => 
		            [created_at] => 2021-02-01T09:49:49.000000Z
		            [updated_at] => 2021-02-01T09:49:49.000000Z
		            [level_one] => Array
		                (
		                    [0] => Array
		                        (
		                            [id] => 5
		                            [app_id] => 2
		                            [apm_title] => Home
		                            [apm_icon] => 
		                            [apm_description] => 
		                            [apm_url] => complaint/home
		                            [apm_level] => 1
		                            [apm_father_id] => 0
		                            [created_at] => 2021-02-01T09:49:50.000000Z
		                            [updated_at] => 2021-02-01T09:49:50.000000Z
		                            [level_two] => Array
		                                (
		                                    [0] => Array
		                                        (
		                                            [id] => 8
		                                            [app_id] => 2
		                                            [apm_title] => Test 1
		                                            [apm_icon] => 
		                                            [apm_description] => 
		                                            [apm_url] => complaint/test1
		                                            [apm_level] => 2
		                                            [apm_father_id] => 7
		                                            [created_at] => 2021-02-01T09:49:50.000000Z
		                                            [updated_at] => 2021-02-01T09:49:50.000000Z
		                                        )

		                                    [1] => Array
		                                        (
		                                            [id] => 9
		                                            [app_id] => 2
		                                            [apm_title] => Test 2
		                                            [apm_icon] => 
		                                            [apm_description] => 
		                                            [apm_url] => complaint/test2
		                                            [apm_level] => 2
		                                            [apm_father_id] => 7
		                                            [created_at] => 2021-02-01T09:49:50.000000Z
		                                            [updated_at] => 2021-02-01T09:49:50.000000Z
		                                        )

		                                )

		                        )

		                )

		        )
		)
     *创建人：Leon
     */
    static function getAppMenuCache()
    {
		//检查是否存在对应缓存，不存在则从数据库中获取并创建缓存
		if(!Cache::has('bd_app_menu')){
			$model = new CsfeApp;
			$apps = $model->where('app_active',1)->get();
			$menu = array();
			foreach($apps as $app){
				$menu[$app->id] = $app->toArray();
				$model_apm = new CsfeAppMenu;
				$level_ones = $model_apm->where('apm_level',1)->where('app_id',$app->id)->get();
				if($level_ones){
					foreach($level_ones as $level_one){
						$menu_level_one = $level_one->toArray();
						$level_twos = $model_apm->where('apm_level',2)->where('apm_father_id',$level_one->id)->get();
						foreach($level_twos as $level_two){
							$menu_level_one['level_two'][] = $level_two->toArray();
						}
						$menu[$app->id]['level_one'][] = $menu_level_one;
					}
				}
			}

			Cache::add('bd_app_menu',$menu, 1441);	
		}

    	return Cache::get('bd_app_menu');
    }
	
	/**
     * 清除缓存
	 * 创建人：Leon
     */
	static function cleanCache(){
		Cache::forget('bd_app_menu');

		return array('status'=>"1");
	}
	
}
