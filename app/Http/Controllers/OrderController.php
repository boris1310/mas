<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function setOrder(Request $data){

        $order = new Order();
        $order->client_name = $data->client_name;
        $order->client_tel = $data->client_tel;
        $order->author = Auth::user()->name;
        $order->description = $data->description;
        $order->save();

       return Order::get()->last();

    }
}
