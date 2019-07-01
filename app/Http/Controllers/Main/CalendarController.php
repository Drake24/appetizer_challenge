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
    /**
     * Displays main page
     *
     * @return view
     */
    public static function calendar() 
    {
    	return view('main');
    }

    /**
     * Displays main page
     *
     *  @param Request $request
     *  @return jsonObject $response;
     */
    public static function save(Request $request)
    {
    	// Instatiate global app response helper.
        $response = new AppResponse();

        // Convert string to array before manipulation.
        $params = Functions::toArray($request->input('form'));

        $data = [];

        $data['event_name']     = $params['event'];
        $data['event_start']    = Functions::convertDate($params['startDate']);
        $data['event_end']      = Functions::convertDate($params['endDate']);

        // Get Inteveral day from Start to End day
        $interval = DateInterval::createFromDateString('1 day');

        $period = new DatePeriod (
            Functions::toDate($data['event_start']), 
            $interval, 
            Functions::toDate($data['event_end']
        ));

        // Get days status flags
        $days = $params['checkedDates'];

        // Insert data based on the days required
        foreach ($period as $dt) {
            foreach ($days as $day) {
                if ($day == Functions::day($dt->format("Y-m-d"))) {
                    $data['event_start']    = Functions::convertDate($dt->format("Y-m-d"));
                    $data['event_end']      = Functions::convertDate($dt->format("Y-m-d"));
                    $data['event_days']     = Functions::day($dt->format("Y-m-d"));

                    Event::new($data);
                }
            }
        }

        // Get Stored data
        $response->data = Event::get();

        return $response->toJson();   	
    }
}
