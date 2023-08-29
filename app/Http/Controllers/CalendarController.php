<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class CalendarController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(){
        $events = new Calendar;
        $events = $events->all();
        $evetns = count($events) > 1 ? $events : '';
        return view('calendar',compact($events));
    }

    public function saveDays(Request $request){
        $calendar = new Calendar;
        $calendar->calendar_date = $request->get('calendar_date');
        $calendar->save();
    }

    /**
     * Get all selected dates
     */
    public function getDates(){
        return Calendar::all();
    }

    /**
     * Get all days selected by month
     */
    public function getDaysByMonth($month){
        $calendar = new Calendar();
        return $calendar->where('month',$month)->get();
    }
    public function insertDays(Request $request){
        $dates = $request->datePicker;
    }
}
