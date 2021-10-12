<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use Illuminate\Http\Request;

use DateTime;
use DateInterval;
use DatePeriod;

class DashboardController extends Controller
{
    //
    public function index(){

        $start_date = '2021-10-01';
        $end_date = date('Y-m-d');

         //create a list of dates from start date to end date
         $start_day = date('d', strtotime($start_date));
         $begin = new DateTime($start_date);
         $end = new DateTime($end_date);

         $interval = new DateInterval('P1D');
         $daterange = new DatePeriod($begin, $interval ,$end);

        $distinct_dates = $daterange;
        $days = array();
        $counts = array();
        $orders_counts = array();

        foreach($distinct_dates as $value){

            //get customer orders by date
            $the_date = $value->format('Y-m-d');

            //get new customers daily
            $orders_count = CustomerOrder::whereDate('created_at', $the_date)->count();
            
            $change_date = $value->format('d-m-Y');
            array_push($days, $change_date);
            array_push($orders_counts, $orders_count);
        }

        $dates = json_encode($days);
        $daily_orders = json_encode($orders_counts);
        return view('dashboard', compact('dates','daily_orders'));

    }
}
