<?php

namespace App\Http\Controllers;

use App\Providers\AppMenuServiceProvider;
use Request;

class AppMenuController extends Controller
{
	/**
     * 获取列表数据
     * 创建人：Leon
     */
    public function lists(){
        return (new AppMenuServiceProvider())->getLists();
    }

    /**
     * 获取单行数据（通过id）
     * 创建人：Leon
     */
    public function item(){
        return (new AppMenuServiceProvider())->getItem(request('id'));
    }

    /**
     * 创建单行数据
     * 创建人：Leon
     */
    public function create(){
        return (new AppMenuServiceProvider())->createItem(request()->all());;
    }

    /**
     * 更新单行数据
     * 创建人：Leon
     */
    public function update(){
    	return (new AppMenuServiceProvider())->updateItem(request()->all());;
    }

    /**
     * 删除单行数据
     * 创建人：Leon
     */
    public function delete(){
    	return (new AppMenuServiceProvider())->deleteItem(request('id'));
    }
}
