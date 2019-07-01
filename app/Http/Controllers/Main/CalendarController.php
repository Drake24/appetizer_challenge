<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\Functions;
use App\Helpers\AppResponse;

use App\Models\Event;

use DateInterval;
use DatePeriod;
use Log;


class CalendarController extends Controller
{
    public static function calendar() 
    {
    	return view('main');
    }

    public static function save(Request $request)
    {
    	 // Instatiate global app response helper.
        $response = new AppResponse();

        // Convert string to array before validating.
        $params = Functions::toArray($request->input('form'));

        $data = [];

        $data['event_name']     = $params['event'];
        $data['event_start']    = Functions::convertDate($params['startDate']);
        $data['event_end']      = Functions::convertDate($params['endDate']);
        $data['event_days']     = Functions::toJson($params['checkedDates']);
        // Way gamit
        $dayDifference = Functions::dateDiff($data['event_start'], $data['event_end']);

        // Loop here base on days
        //Event::new($data);
        $days = $params['checkedDates'];

        foreach($days as $day) {
          
        }
        
        Log::info(Functions::day($params['startDate']));

        $interval = DateInterval::createFromDateString('1 day');

        $period = new DatePeriod(
            Functions::toDate($data['event_start']), 
            $interval, 
            Functions::toDate($data['event_end']
        ));

        foreach ($period as $dt) {
            Log::info("Type of Day");
            Log::info(Functions::day($dt->format("Y-m-d")));

        }

        $response->data = Event::get();
        // $response->data = Functions::dateDiff($data['event_start'], $data['event_end']);

        return $response->toJson();   	
    }
}
