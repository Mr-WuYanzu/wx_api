<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;

class GoodsController extends Controller
{
    public function getGoodsInfo(){
        $goodsModel = new Goods();
        $page_size = 10;
        $page = $_POST['page']??1;
        $goodsInfo = $goodsModel->paginate($page_size);
        if($goodsInfo){
            return ['status'=>200,'msg'=>'ok','data'=>$goodsInfo];
        }else{
            return ['status'=>200,'msg'=>'ok','data'=>[]];
        }
    }
}
