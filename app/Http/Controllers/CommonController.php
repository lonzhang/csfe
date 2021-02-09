<?php

namespace App\Http\Controllers;

use App\Providers\CacheServiceProvider;
use Request;

class CommonController extends Controller
{
    /**
     * 获取基础数据列表
     * 创建人：Leon
     */
    public function baseData(){
        return CacheServiceProvider::getBaseData(request('type'));
    }
}
