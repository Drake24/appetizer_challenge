<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Event extends Model
{
	
    public static function new($event)
    {
    	DB::table('calendar')->insert([
    		'event_name' 	=> $event['event_name'],
		    'event_start' 	=> $event['event_start'],
		    'event_end' 	=> $event['event_end'],
		    'event_days'	=> $event['event_days']
		]);
    }

    public static function get()
    {
    	return DB::table('calendar')
    			->select('event_start as start', 'event_end as end', 'event_name as title')
    			->get();
    }
}
