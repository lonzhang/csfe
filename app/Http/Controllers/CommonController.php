<?php

namespace App\Http\Controllers;

use App\Providers\CacheServiceProvider;
use Request;

class CommonController extends Controller
{
    /**
     * 获取app menu列表
     * 传入值：$language 字符串
     * 创建人：Leon
     */
    public function getAppMenu(){
        return CacheServiceProvider::getBaseData(request('type'));
    }
}
