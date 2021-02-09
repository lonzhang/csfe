<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AppMenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
*/
//登录
Route::post('/login',[AuthController::class, 'login']);
//退出登录
Route::get('/logout',[AuthController::class, 'logout']);

//页面路由
Route::group(['middleware' => 'auth:sanctum'], function () {
	Route::get('/', function () {
		return Inertia::render('Dashboard');
	})->name('/');

	Route::get('/dashboard', function () {
		return Inertia::render('Dashboard');
	})->name('dashboard');

	Route::get('/home', function () {
		return Inertia::render('Home/Index');
	})->name('home');

	//Business unit列表页
    Route::get('/business-units', function () {
		return Inertia::render('Security/BusinessUnits/Index');
	})->name('business_units_list');

	//teams列表页
	Route::get('/teams', function () {
		return Inertia::render('Security/Teams/Index');
	})->name('teams_list');

	Route::get('/apps', function () {
		return Inertia::render('Application/Apps');
	})->name('application_apps');

	Route::get('/apps/edit', function () {
		return Inertia::render('Application/AppsEdit');
	})->name('application_apps_edit');

	Route::get('/user', function () {
		return Inertia::render('Security/User/Index');
	})->name('user_list');

	Route::get('/user/edit', function () {
		return Inertia::render('Security/User/Edit');
	})->name('user_list_edit');

	Route::get('/apps/select-component', function () {
	    return Inertia::render('Application/SelectComponent');
	})->name('application_apps_select_component');
});

//数据提交接口
Route::group(['middleware' => 'auth:sanctum'], function () {
	//创建App,参数：表单数据
	Route::post('/app/create', [ApplicationController::class, 'create']);
	//更改App,参数：表单数据
	Route::post('/app/update', [ApplicationController::class, 'update']);
	//删除App,参数：id
	Route::post('/app/delete', [ApplicationController::class, 'delete']);

	//创建App_Menu,参数：表单数据
	Route::post('/app-menu/create', [AppMenuController::class, 'create']);
	//更改App_Menu,参数：表单数据
	Route::post('/app-menu/update', [AppMenuController::class, 'update']);
	//删除App_Menu,参数：id
	Route::post('/app-menu/delete', [AppMenuController::class, 'delete']);
});

//数据获取接口
Route::group(['middleware' => 'auth:sanctum'], function () {
	//获取App列表数据,参数：无
	Route::get('/app/lists', [ApplicationController::class, 'lists']);
	//获取App单条数据,参数：id
	Route::get('/app/item', [ApplicationController::class, 'item']);
	//获取单个App关联的Menu组装数据,参数：id
	Route::get('/app/app-menu', [ApplicationController::class, 'appMenu']);

	//获取App_Menu列表数据,参数：无
	Route::get('/app-menu/lists', [AppMenuController::class, 'lists']);
	//获取App_Menu单条数据,参数：id
	Route::get('/app-menu/item', [AppMenuController::class, 'item']);

	//获取基础缓存数据
	Route::get('/common/base-data', [CommonController::class, 'baseData']);
});
