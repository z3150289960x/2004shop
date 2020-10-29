<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return view('index.index');
    }
    public function login(){
        return view('login.login');
    }
    public function register(){
        return view('login.register');
    }
    //商品展示
    public function shop(){
        $name = request()->name??'';
        $where = [];
        if($name){
            $where[]=['goods_name','like',"%$name%"];
        }
        $data = Goods::limit(50)->where($where)->paginate(12);
        $query = request()->all();  //搜索
//        dd($data);
        return view('shop.shop',['data'=>$data,'query'=>$query]);
    }
//    商品详情
    public function goods($id){
//        echo 111;die;
        $data = Goods::find($id);
//        dd($data);
        return view('goods.goods',['data'=>$data]);
    }
//    购物车
    public function cart($id){
        $data = Goods::find($id);
        return view('cart.cart',['data'=>$data]);
    }
//    支付
    public function pay(){
//        echo 111;die;
        return view('pay.pay');
    }

    //抽奖
    public function prize(){

        //判断是否登录
        $data=session('key','zhangsan');
        session(['key'=>'value']);
        echo $data;
//        $u_id = session()->get('u_id');
////        dd($u_id);
//        if(empty($u_id)){
//            $response = [
//                'errno' => 400003,
//                'msg'   => '未登录'
//            ];
//
//            return $response;
//        }
//        echo 1111;
        $rand = mt_rand(1,10);
//        $prize = 0;
        if($rand==8){
            echo '一等奖苹果一斤';
        }elseif($rand==6){
            echo '二等奖苹果半斤';
        }elseif($rand >=1 && $rand <5){
            echo '三等奖';
        }else{
            echo '感谢参与';
        }
//        $data =[
//            'errno'=> 0,
//            'msg'=> 'ok',
//            'data' => [
//                'prize'=>$prize
//            ]
//        ];
        return $rand;
    }

}
