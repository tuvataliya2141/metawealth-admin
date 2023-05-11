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
use Geocoder\Query\GeocodeQuery;
use Geocoder\Provider\Nominatim\Nominatim;
use Http\Client\Curl\Client as CurlClient;

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

        $data = $this->getData();

        $totalWealth = $data['totalWealth'];
        $user = $data['user'];
        $myAge = $data['myAge'];
        $startYear = $data['startYear'];
        $endYear = $data['endYear'];
        $wealthData = $data['wealthData'];
        $statement = $data['statement'];
        $clientDetail = $data['clientDetail'];
        $incomes = $data['incomes'];
        $events = $data['events'];
        $totalWealth = $data['totalWealth'];
        $userAge = $data['userAge'];
        $rateReturn = $data['rateReturn'];
        $wealthIncomes = $data['wealthIncomes'];
        $incomeChart = $data['incomeChart'];
        $wealthEvents = $data['wealthEvents'];
        $eventsChart = $data['eventsChart'];
        $eventsLineChart = $data['eventsLineChart'];

        return view('user.home', compact(['totalWealth', 'user', 'myAge', 'startYear', 'endYear', 'wealthData', 'statement', 'clientDetail', 'incomes', 'events', 'totalWealth', 'userAge', 'rateReturn', 'wealthIncomes', 'incomeChart', 'wealthEvents', 'eventsChart', 'eventsLineChart']));
    }

    public function changeRiskRate(Request $request) {
        $user = User::where('id', auth()->user()->id)->first();
        $user->risk_rate = $request->risk_rate;
        $user->update();

        return true;
    }

    public function booking(Request $request) {
        $data = $this->getData();

        $totalWealth = $data['totalWealth'];
        $user = $data['user'];
        $myAge = $data['myAge'];
        $startYear = $data['startYear'];
        $endYear = $data['endYear'];
        $wealthData = $data['wealthData'];
        $statement = $data['statement'];
        $clientDetail = $data['clientDetail'];
        $incomes = $data['incomes'];
        $events = $data['events'];
        $totalWealth = $data['totalWealth'];
        $userAge = $data['userAge'];
        $rateReturn = $data['rateReturn'];
        $wealthIncomes = $data['wealthIncomes'];
        $incomeChart = $data['incomeChart'];
        $wealthEvents = $data['wealthEvents'];
        $eventsChart = $data['eventsChart'];
        $eventsLineChart = $data['eventsLineChart'];

        return view('user.booking', compact(['totalWealth', 'user', 'myAge', 'startYear', 'endYear', 'wealthData', 'statement', 'clientDetail', 'incomes', 'events', 'totalWealth', 'userAge', 'rateReturn', 'wealthIncomes', 'incomeChart', 'wealthEvents', 'eventsChart', 'eventsLineChart']));
    }

    public function personalDetails($id) {
        $data = $this->getData();

        $totalWealth = $data['totalWealth'];
        $user = $data['user'];
        $myAge = $data['myAge'];
        $startYear = $data['startYear'];
        $endYear = $data['endYear'];
        $wealthData = $data['wealthData'];
        $statement = $data['statement'];
        $clientDetail = $data['clientDetail'];
        $incomes = $data['incomes'];
        $events = $data['events'];
        $totalWealth = $data['totalWealth'];
        $userAge = $data['userAge'];
        $rateReturn = $data['rateReturn'];
        $wealthIncomes = $data['wealthIncomes'];
        $incomeChart = $data['incomeChart'];
        $wealthEvents = $data['wealthEvents'];
        $eventsChart = $data['eventsChart'];
        $eventsLineChart = $data['eventsLineChart'];
        
        $client = [];

        $clientPersonalDetails = PersonalDetails::where('user_id', $id)->orderBy('id', 'ASC')->get();        
        $client['self'] = $clientPersonalDetails[0];
        $client['spouse'] = isset($clientPersonalDetails[1]) ? $clientPersonalDetails[1] : '';


        return view('user.personalDetails', compact(['client', 'totalWealth', 'user', 'myAge', 'startYear', 'endYear', 'wealthData', 'statement', 'clientDetail', 'incomes', 'events', 'totalWealth', 'userAge', 'rateReturn', 'wealthIncomes', 'incomeChart', 'wealthEvents', 'eventsChart', 'eventsLineChart']));
    }

    public function updatePersonalDetails(Request $request) {
        $findVal = 0;
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'gender' => 'required',
        ]);

        $pd = PersonalDetails::where('user_id', '!=', $request->user_id)->get();

        if($pd) {
            foreach($pd as $value) {
                if($value->phone != null || $value->phone != '') {
                    $phone = decrypt($value->phone);
                    $email = decrypt($value->email);
                    if($phone == $request->phone) {
                        $findVal = 1;
                    } elseif($email == $request->email) {
                        $findVal = 1;
                    }
                }
            }
        }

        if($findVal == 0) {
            $user=User::where('id', $request->user_id)->first();
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->update();

            $selfDetails = PersonalDetails::where('id', $request->self_id)->where('user_id', $request->user_id)->first();

            if($selfDetails) {
                if ($request->address != NULL) {
                    $latLng = $this->getLatLng($request->address);
                    if($latLng != null) {
                        $latitude = $latLng[0];
                        $longitude = $latLng[1];
                    }
                }

                $selfDetails->first_name = isset($request->first_name) ? encrypt($request->first_name) : NULL;
                $selfDetails->last_name = isset($request->last_name) ? encrypt($request->last_name) : NULL;
                $selfDetails->phone = isset($request->phone) ? encrypt($request->phone) : NULL;
                $selfDetails->email = isset($request->email) ? encrypt($request->email) : NULL;
                $selfDetails->dob = isset($request->dob) ? encrypt($request->dob) : NULL;
                $selfDetails->gender = isset($request->gender) ? encrypt($request->gender) : NULL;
                $selfDetails->status = encrypt('self');
                $selfDetails->joint_plan = isset($request->joint_profile) ? encrypt($request->joint_profile) : NULL;
                $selfDetails->marital_status = isset($request->marital_status) ? encrypt($request->marital_status) : NULL;
                $selfDetails->retired = isset($request->retired) ? encrypt($request->retired) : NULL;
                $selfDetails->address = isset($request->address) ? encrypt($request->address) : NULL;
                $selfDetails->latitude = isset($latitude) ? encrypt($latitude) : NULL;
                $selfDetails->longitude = isset($longitude) ? encrypt($longitude) : NULL;
                $selfDetails->city = isset($request->city) ? encrypt($request->city) : NULL;
                $selfDetails->province = isset($request->province) ? encrypt($request->province) : NULL;
                $selfDetails->postal_code = isset($request->postal_code) ? encrypt($request->postal_code) : NULL;
                $selfDetails->is_child = ($request->have_child == 1) ? encrypt('yes') : 'no';
                $selfDetails->child_tot = isset($request->child) ? encrypt($request->child) : NULL;
                $selfDetails->update();
            }
            
            if($request->marital_status == 'married' && isset($request->spouse_id)) {
                $spouseDetails = PersonalDetails::where('id', $request->spouse_id)->where('user_id', $request->user_id)->first();

                if($spouseDetails){
                    $spouseDetails->first_name = isset($request->p_first_name) ? encrypt($request->p_first_name) : NULL;
                    $spouseDetails->last_name = isset($request->p_last_name) ? encrypt($request->p_last_name) : NULL;
                    $spouseDetails->phone = isset($request->p_phone) ? encrypt($request->p_phone) : NULL;
                    $spouseDetails->email = isset($request->p_email) ? encrypt($request->p_email) : NULL;
                    $spouseDetails->dob = isset($request->p_dob) ? encrypt($request->p_dob) : NULL;
                    $spouseDetails->gender = isset($request->p_gender) ? encrypt($request->p_gender) : NULL;
                    $spouseDetails->status = encrypt('spouse');
                    $spouseDetails->marital_status = isset($request->p_marital_status) ? encrypt($request->p_marital_status) : NULL;
                    $spouseDetails->retired = isset($request->p_retired) ? encrypt($request->p_retired) : NULL;
                    $spouseDetails->address = isset($request->p_address) ? encrypt($request->p_address) : NULL;
                    $spouseDetails->is_child = ($request->have_child == 1) ? encrypt('yes') : 'no';
                    $spouseDetails->child_tot = isset($request->child) ? encrypt($request->child) : NULL;
                    $spouseDetails->update();
                }
            } elseif($request->marital_status == 'unmarried' && isset($request->spouse_id)) {
                $spouseDetails = PersonalDetails::where('id', $request->spouse_id)->where('user_id', $request->user_id)->first();
                if($spouseDetails) {
                    $spouseDetails->delete();
                }
            } elseif(!isset($request->spouse_id) && $request->marital_status == 'married') {
                PersonalDetails::create([
                    'user_id' => $request->user_id,
                    'first_name' => isset($request->p_first_name) ? encrypt($request->p_first_name) : NULL,
                    'last_name' => isset($request->p_last_name) ? encrypt($request->p_last_name) : NULL,
                    'phone' => isset($request->p_phone) ? encrypt($request->p_phone) : NULL,
                    'email' => isset($request->p_email) ? encrypt($request->p_email) : NULL,
                    'dob' => isset($request->p_dob) ? encrypt($request->p_dob) : NULL,
                    'gender' => isset($request->p_gender) ? encrypt($request->p_gender) : NULL,
                    'status' => encrypt('spouse'),
                    'marital_status' => isset($request->p_marital_status) ? encrypt($request->p_marital_status) : NULL,
                    'retired' => isset($request->p_retired) ? encrypt($request->p_retired) : NULL,
                    'address' => isset($request->p_address) ? encrypt($request->p_address) : NULL,
                    'is_child' => ($request->have_child == 1) ? encrypt('yes') : 'no',
                    'child_tot' => isset($request->child) ? encrypt($request->child) : NULL,
                ]);
            }
            
            return redirect()->back()->with('success', 'Data updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Phone number is already registered, please try again with different phone no.!');
        }
    }

    public function profile(Request $request) {
        $data = $this->getData();

        $totalWealth = $data['totalWealth'];
        $user = $data['user'];
        $myAge = $data['myAge'];
        $startYear = $data['startYear'];
        $endYear = $data['endYear'];
        $wealthData = $data['wealthData'];
        $statement = $data['statement'];
        $clientDetail = $data['clientDetail'];
        $incomes = $data['incomes'];
        $events = $data['events'];
        $totalWealth = $data['totalWealth'];
        $userAge = $data['userAge'];
        $rateReturn = $data['rateReturn'];
        $wealthIncomes = $data['wealthIncomes'];
        $incomeChart = $data['incomeChart'];
        $wealthEvents = $data['wealthEvents'];
        $eventsChart = $data['eventsChart'];
        $eventsLineChart = $data['eventsLineChart'];

        return view('user.profile', compact(['totalWealth', 'user', 'myAge', 'startYear', 'endYear', 'wealthData', 'statement', 'clientDetail', 'incomes', 'events', 'totalWealth', 'userAge', 'rateReturn', 'wealthIncomes', 'incomeChart', 'wealthEvents', 'eventsChart', 'eventsLineChart']));
    }

    public function getData() {
        $data = [];        
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

<<<<<<< HEAD
        $birthday = isset($personalDetails[0]->dob) ? Carbon::createFromFormat('Y-m-d', decrypt($personalDetails[0]->dob)) : NULL;
=======
        if (isset($personalDetails[0]->dob)) {
            $birthday = Carbon::createFromFormat('Y-m-d', decrypt($personalDetails[0]->dob));
        } else {
            $birthday = null;
        }
>>>>>>> 42779b4fbf6daf6510f81254501b8a63d5a07da2
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
                $userAge = ($birthday != NULL) ? $birthday->diffInYears(Carbon::now()) : 0;
            }
            if (isset($WealthManagementData->rate_return) && ($WealthManagementData->rate_return != null || $WealthManagementData->rate_return != '')) {
                $rateReturn = $WealthManagementData->rate_return;
            } else {
                $rateReturn = 0;
            }
        } else {
            $totalWealth = 0;
            $rateReturn = 0;
            $userAge = ($birthday != NULL) ? $birthday->diffInYears(Carbon::now()) : 0;
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

        $myAge = ($birthday != NULL) ? $birthday->diffInYears(Carbon::now()) : 0;
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
        if($WealthManagementData) {
            $netWorth = NetWorthRankings::where('net_worth', '>=', $WealthManagementData->total_wealth)->limit(1)->get();
            if(count($netWorth) > 0) {
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
            }
            $totalWealth = $WealthManagementData->total_wealth;
        } else {
            $statement = 'Your net worth percentile is <strong><span class="text-primary">0%</span></strong>';
            $totalWealth = 0;
        }


        $data = [
            'totalWealth' => $totalWealth,
            'user' => $user,
            'myAge' => $myAge,
            'startYear' => $startYear,
            'endYear' => $endYear,
            'wealthData' => $wealthData,
            'statement' => $statement,
            'clientDetail' => $clientDetail,
            'incomes' => $incomes,
            'events' => $events,
            'totalWealth' => $totalWealth,
            'userAge' => $userAge,
            'rateReturn' => $rateReturn,
            'wealthIncomes' => $wealthIncomes,
            'incomeChart' => $incomeChart,
            'wealthEvents' => $wealthEvents,
            'eventsChart' => $eventsChart,
            'eventsLineChart' => $eventsLineChart
        ];

        return $data;
    }
    
    public function getLatLng($address) {
        $httpClient = new CurlClient();
        $provider = new Nominatim($httpClient, 'https://nominatim.openstreetmap.org', 'metawealthinc');
        try {
            $results = $provider->geocodeQuery(GeocodeQuery::create($address));
            $lat = $results->first()->getCoordinates()->getLatitude();
            $lng = $results->first()->getCoordinates()->getLongitude();
            return [$lat, $lng];
        } catch(Exception $e) {
            return "null";
        }
    }
}
