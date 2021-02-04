<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Cache;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    /**
     * 处理认证尝试
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {
		$credentials = $request->only('email', 'password');
		
		//检查用户是否有效
		//if((new UsersServiceProvider())->checkDisable(request('email'))) return ['status'=>0, 'state'=>0 ,'message'=>"account no longer valid"];

		$res = Auth::attempt($credentials);
		if ($res) {
			// 认证通过．．．
			// return redirect()->intended('dashboard');

			return ['status'=>1,'message'=>'successful','type'=>Auth::user()->type,'default_language'=>Auth::user()->default_language];
		}else{
			return ['status'=>0,'state'=>1,'message'=>'Account does not match password'];
		}
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function logoutCustom(){
        return Auth::logout();
    }


    /**
     * 注册
     *
     * @return Response
     */
    public function register(Request $request)
    {
        if($request->isMethod('get')){
            return Inertia::render('Auth/Register');
        }elseif ($request->isMethod('post')){
            return (new UsersServiceProvider())->register(request()->all());
        }
    }

    public function getForgotPassword()
    {
        return Inertia::render('Auth/ForgotPassword');
    }


    /**
     * 修改密码页面
     */
    public function getChangePassword(Request $request)
    {
        $uuid = request('uuid');
        if(empty($uuid) || !Cache::get($uuid)){ //为空或者缓存标记为空  链接失效
            return view('errors.503');
        }else{
            $url = $request->url();
            $arr = UsersServiceProvider::urlsafe_b64decode($uuid);
            $arr = explode('+',$arr);
            $user_info = User::where('email',$arr[0])->first();
            //验证UUID
            if(md5($user_info->name.$user_info->password) != $arr[1]){
                echo '验证失败';exit;
            }
            $user_info->uuid = $uuid;
            return Inertia::render('Auth/ChangePassword', ['userInfo'=>$user_info]);
        }
    }

    /*
     * 修改密码提交
     * 此处是找回密码
     * Ethan
     */
    public function postChangePassword(UsersServiceProvider $providers){
        return $providers->postChangePassword();
    }


    /*
     * 发送邮件找回密码
     */
    public function emailRetrievePassword(){
        return (new UsersServiceProvider())->emailRetrievePassword();
    }


}
