<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalDetails;
use App\Models\AssignAdvisor;
use App\Models\Events;
use App\Models\OtherEvents;
use App\Models\Incomes;
use App\Models\WealthManagement;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verifUser']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $advisor = null;
        $user = auth()->user();
        $eventsChart = app('App\Http\Controllers\AdminController')->getEventsChartData($user->id);        
        $eventsLineChart = app('App\Http\Controllers\AdminController')->getEventsLineChartData($user->id);
        $incomeChart = app('App\Http\Controllers\AdminController')->getIncomeChartData($user->id);

        $personalDetails = PersonalDetails::where('user_id', $user->id)->get();
        $checkAdvisor = AssignAdvisor::where('user_id', $user->id)->first();

        if($checkAdvisor) {
            $advisor = PersonalDetails::where('user_id', $checkAdvisor->advisor_id)->first();
        }
        $clientDetail['user'] = $user;
        $clientDetail['personalDetails'] = $personalDetails;
        $clientDetail['advisor'] = $advisor;

        $birthday = Carbon::createFromFormat('Y-m-d', decrypt($personalDetails[0]->dob));
        $incomes = Incomes::all();
        $events = Events::all();

        $WealthManagementData = WealthManagement::select('total_wealth', 'age', 'rate_return')->where('user_id', $user->id)->first();
        if ($WealthManagementData) {
            if (isset($WealthManagementData->total_wealth) && ($WealthManagementData->total_wealth != null || $WealthManagementData->total_wealth != '')) {
                $totalWealth = $WealthManagementData->total_wealth;
            } else {
                $totalWealth = 0;
            }
            if (isset($WealthManagementData->age) && ($WealthManagementData->age != null || $WealthManagementData->age != '')) {
                $userAge = $WealthManagementData->age;
            } else {                
                $userAge = $birthday->diffInYears(Carbon::now());
            }
            if (isset($WealthManagementData->rate_return) && ($WealthManagementData->rate_return != null || $WealthManagementData->rate_return != '')) {
                $rateReturn = $WealthManagementData->rate_return;
            } else {
                $rateReturn = 0;
            }
        } else {
            $totalWealth = 0;
            $rateReturn = 0;
            $userAge = $birthday->diffInYears(Carbon::now());
        }

        $wealthIncomes = WealthManagement::select('wealth_management.*', 'incomes.name')->
                        where('wealth_management.user_id', $user->id)->
                        where('wealth_management.income_name', '!=', 'NULL')->
                        where('wealth_management.income_budget', '!=', 'NULL')->
                        where('wealth_management.income_year', '!=', 'NULL')->
                        join('incomes', 'wealth_management.income_name', '=', 'incomes.id')->
                        get();

        $wealthEvents = WealthManagement::where('user_id', $user->id)->
                        where('event_name', '!=', 'NULL')->
                        where('event_budget', '!=', 'NULL')->
                        where('event_year', '!=', 'NULL')->
                        where('event_start_year', '!=', 'NULL')->
                        where('event_end_year', '!=', 'NULL')->
                        get();

        foreach ($wealthEvents as $wealthEvent) {
            if ($wealthEvent->is_other_event == 1) {
                $eventNameData = OtherEvents::where('id', $wealthEvent->event_name)->first();
                if ($eventNameData) {
                    $eventName = $eventNameData->name;
                }
            } else {
                $eventNameData = Events::where('id', $wealthEvent->event_name)->first();
                if ($eventNameData) {
                    $eventName = $eventNameData->name;
                }
            }
            $wealthEvent['eventName'] = $eventName;
        }

        return view('user.home', compact(['clientDetail', 'incomes', 'events', 'totalWealth', 'userAge', 'rateReturn', 'wealthIncomes', 'incomeChart', 'wealthEvents', 'eventsChart', 'eventsLineChart']));
    }
}
