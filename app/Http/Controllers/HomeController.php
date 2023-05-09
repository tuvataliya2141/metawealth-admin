<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalDetails;
use App\Models\AssignAdvisor;
use App\Models\Events;
use App\Models\OtherEvents;
use App\Models\Incomes;
use App\Models\User;
use App\Models\WealthManagement;
use App\Models\NetWorthRankings;
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

        $myAge = $birthday->diffInYears(Carbon::now());
        $startYear = Carbon::now()->year;
        $endYear = $startYear + 20;

        $wealthData = WealthManagement::orderBy('id', 'ASC')->where('user_id', $user->id)->where('event_name', '!=', '')->get();

        foreach ($wealthData as $wealth) {
            if ($wealth->is_other_event == 1) {
                $eventNameData = OtherEvents::where('id', $wealth->event_name)->first();
                if ($eventNameData) {
                    $eventName = $eventNameData->name;
                }
            } else {
                $eventNameData = Events::where('id', $wealth->event_name)->first();
                if ($eventNameData) {
                    $eventName = $eventNameData->name;
                }
            }
            $wealth['eventName'] = $eventName;
        }

        $netWorth = NetWorthRankings::where('net_worth', '>=', $WealthManagementData->total_wealth)->limit(1)->get();
        $totalRecords = count($netWorth);

        if($totalRecords > 0) {            
            $i = 0;
            $statement = 'Your net worth percentile is ';
            foreach ($netWorth as $value) {
                $statement .= '<strong><span class="text-primary">'.$value->net_worth_percentile . '%</span></strong>';
            }
        } else {
            $statement = 'Your net worth percentile is <strong><span class="text-primary">0%</span></strong>';
        }

        return view('user.home', compact(['user', 'myAge', 'startYear', 'endYear', 'wealthData', 'statement', 'clientDetail', 'incomes', 'events', 'totalWealth', 'userAge', 'rateReturn', 'wealthIncomes', 'incomeChart', 'wealthEvents', 'eventsChart', 'eventsLineChart']));
    }

    public function changeRiskRate(Request $request) {
        $user = User::where('id', auth()->user()->id)->first();
        $user->risk_rate = $request->risk_rate;
        $user->update();

        return true;
    }
}
