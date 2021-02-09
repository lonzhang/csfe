<?php

namespace App\Http\Controllers;

use App\Providers\ApplicationServiceProvider;
use Request;

class ApplicationController extends Controller
{
	/**
     * 获取列表数据
     * 创建人：Leon
     */
    public function lists(){
        return (new ApplicationServiceProvider())->getLists();
    }

    /**
     * 获取单行数据（通过id）
     * 创建人：Leon
     */
    public function item(){
        return (new ApplicationServiceProvider())->getItem(request('id'));
    }

    /**
     * 创建单行数据
     * 创建人：Leon
     */
    public function create(){
        return (new ApplicationServiceProvider())->createItem(request()->all());;
    }

    /**
     * 更新单行数据
     * 创建人：Leon
     */
    public function update(){
    	return (new ApplicationServiceProvider())->updateItem(request()->all());;
    }

    /**
     * 删除单行数据
     * 创建人：Leon
     */
    public function delete(){
    	return (new ApplicationServiceProvider())->deleteItem(request('id'));
    }

    /**
     * 获取单个app下的menu数据
     * 创建人：Leon
     */
    public function appMenu(){
    	return (new ApplicationServiceProvider())->getAppMenu(request('id'));
    }
}
