<?php

namespace App\Http\Controllers;

use App\Models\OrderService;
use Illuminate\Http\Request;

class OrderServicesController extends Controller
{
    public function setOrderServices(Request $data){
        $orderId = $data->OrderId;
        $record = $data->record;
        $mixing = $data->mixing;
        $lesson = $data->lesson;
        $rolik = $data->rolik;
        $arrangment = $data->arrangment;
        $services = [];
        if(!empty($record)){
            $services['record'] = $record;
        }

        if(!empty($mixing)){
            $services['mixing'] = $mixing;
        }

        if(!empty($lesson)){
            $services['lesson'] = $lesson;
        }

        if(!empty($rolik)){
            $services['rolik']= $rolik;
        }

        if(!empty($arrangment)){
            $services['arrangment']=$arrangment;
        }

        $orderServices = new OrderService();
        $orderServices->OrderId = $orderId;
        $orderServices->Properties = json_encode($services);
        $orderServices->save();

        return '{"status":true}';
    }
}
