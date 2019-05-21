<?php

namespace App\Http\Controllers\PassPort;

use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    //
    public function login(){
        return view('passport.login');
    }

    public function logininfo(Request $request)
    {
        $account=$request->input('name');
        $pwd=$request->input('pwd');
        if (empty($account) || empty($pwd)){
            $response=[
                'status' =>500,
                'msg' => '账号或密码不能为空'
            ];
        }
        $data=UserModel::where(['u_name'=>$account])->first();
        if ($account!=$data['u_name']){
            $response=[
                'status' =>501,
                'msg' => '账号不存在'
            ];
        }else if (password_verify($pwd,$data['u_pwd'])==false){
            $response=[
                'status' =>502,
                'msg' => '密码有误'
            ];
        }else{
            $token = substr(md5(time().mt_rand(1,99999)),10,10);
            setcookie('uid',$data['u_id'],time()+86400,'/','mengli2426.club',false,true);
            setcookie('token',$token,time()+86400,'/','mengli2426.club',false,true);

            $request->session()->put('u_token',$token);
            $request->session()->put('uid',$data->u_id);
            $key='str:u:token:'.$data->u_id;
            Redis::del($key);
            Redis::hset($key,'android',$token);
            $response=[
                'status' =>200,
                'msg' => '登录成功',
                'token'=>$token,
                'user' => $account
            ];
        }
        return json_encode($response);
    }

    public function user(Request $request){
        $info=$request->get('is_login');
        if ($info == 0){
            echo "未登录";
            header("Refresh:3;url=/Passport");
        }else{
            echo "个人中心";
        }

    }
}
