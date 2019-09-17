<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;

class GoodsController extends Controller
{
    public function getGoodsInfo(){
        $goodsModel = new Goods();
        $page_size = 10;
        $goodsInfo = $goodsModel->paginate($page_size);
        dd($goodsInfo);
    }
}
