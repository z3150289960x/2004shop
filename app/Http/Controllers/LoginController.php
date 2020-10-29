<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{
    public function index(){
//        $data = request()->all();
//        dd($data);
        $data = request()->except(['_token']);
//        dd($data);
        $res = Login::insert($data);
        if($res){
            return redirect('login');
        }
    }

    protected function webLogin($uid)
    {
        //将登录信息保存至session uid 与 token写入 seesion
        session(['uid'=>$uid]);
    }

    public function index1(Request $request){
        $login_name = $request->input('login_name');
        $pwd = $request->input('pwd');

        $user = Login::where(['login_name'=>$login_name])->first();
        if(!$user){
            echo "没有此用户";die;
        }
        $incrKey = 'incr:'.$user->u_id;

        $errorNum = Redis::get($incrKey);

        if($pwd != $user->pwd){
            if($errorNum >= 4){
                $expire = Redis::ttl($incrKey);
                if($expire < 60){
                    $errorTime = $expire.'秒';
                }elseif ($expire < 3600){
                    $min = intval($expire / 60);
                    $errorTime = $min.'分钟';
                }else{
                    $hour = intval($expire / 3600);
                    $min = intval(($expire - 3600) / 60);
                    $errorTime = $hour.'小时'.$min.'分钟';
                }
                echo '已锁定'.$errorTime.'后解锁';die;
            }

            if($errorNum < 5){
                Redis::incr($incrKey);
            }
            if($errorNum == null || $errorNum == 0){
                Redis::expire($incrKey,7200);
            }
            echo "密码不对,错误".($errorNum+1).'次';die;
        }else{
            if($errorNum >= 4){
                echo "已锁定";die;
            }
            Redis::del($incrKey);
        }

        if($user){
            return redirect('index');
        }
    }
}
