<?php

namespace App\Http\Controllers\PassPort;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class JieController extends Controller
{
    public function register(Request $request){
        $data=$request->input();
        $arr=Db::table('shop_user')->insert($data);
        var_dump($arr);
        //    $json_str=file_get_contents("php://input");
        //    echo "json_str:".$json_str;
    }
}
