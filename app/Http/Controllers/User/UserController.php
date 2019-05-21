<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Model\UsersModel;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
class UserController extends Controller{
    public function reg(){
        $data=file_get_contents('php://input');
        $data=json_decode($data,true);
        $name=$data['name'];
        $pass1=$data['pass1'];
        $pass2=$data['pass2'];
        $email=$data['email'];
        if(empty($name)){
            return json_encode(['code'=>1,'msg'=>'用户不能为空']);
        }
        if(empty($pass1)){
            return json_encode(['code'=>1,'msg'=>'密码不能为空']);
        }
        if(empty($pass2)){
            return json_encode(['code'=>1,'msg'=>'确认密码不能为空']);
        }
        if(empty($email)){
            return json_encode(['code'=>1,'msg'=>'邮箱不能为空']);
        }
        if($pass1!=$pass2){
            return json_encode(['code'=>1,'msg'=>'密码不一致']);
        }
        $na=UsersModel::where('nick_name',$name)->first();
        if($na){
            return json_encode(['code'=>1,'msg'=>'已经有此用户']);
        }
        $u=[
            'nick_name'=>$name,
            'pass'=>$pass1,
            'email'=>$email
        ];
        $add=UsersModel::insert($u);
        if($add){
            return json_encode(['code'=>0,'msg'=>'注册成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'注册失败']);
        }
    }
    public function login(){
        $data=file_get_contents('php://input');
        $data=json_decode($data,true);
        $name=$data['name'];
        $pass=$data['pass'];
        if(empty($name)){
            return json_encode(['code'=>1,'msg'=>'请填写用户名']);
        }
        if(empty($pass)){
            return json_encode(['code'=>1,'msg'=>'请填写密码']);
        }
        $na=UsersModel::where('nick_name',$name)->first();
        $uid=$na['uid'];
        if($na){
            if($pass==$na['pass']){
                $token = substr(md5(time().mt_rand(1,99999)),10,10);
                $redis_key = 'logs';
                $redis_keys='ui';
                Redis::set($redis_keys,$uid);
                Redis::expire($redis_keys,604800);
                Redis::set($redis_key,$token);
                Redis::expire($redis_key, 604800);
                $a=Redis::get($redis_key);
                return json_encode(['code'=>0,'msg'=>'登录成功','token'=>$token,'uid'=>$uid]);
            }else{
                return json_encode(['code'=>1,'msg'=>'密码不对']);
            }
        }else{
            return json_encode(['code'=>1,'msg'=>'没有此用户']);
        }
    }
}