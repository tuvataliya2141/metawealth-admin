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
use App\Models\SupportTickets;
use App\Models\SupportTicketsReplies;
use Carbon\Carbon;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Provider\Nominatim\Nominatim;
use App\Events\NewMessageNotification;
use Http\Client\Curl\Client as CurlClient;
use App\Models\Message as ModelsMessage;

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

        if (isset($personalDetails[0]->dob)) {
            $birthday = Carbon::createFromFormat('Y-m-d', decrypt($personalDetails[0]->dob));
        } else {
            $birthday = null;
        }
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

    public function updateAge(Request $request) {
        $WealthManagementData = WealthManagement::select('total_wealth', 'age', 'rate_return')->where('user_id', $request->user_id)->first();
        if($WealthManagementData) {
            $WealthManagementData->age = $request->age;
            $WealthManagementData->update();
        } else {
            $this->addLivingExpenses($request->user_id, $request->age);
        }

        return true;
    }
    
    public function getLatLng($address) {
        $httpClient = new CurlClient();
        $provider = new Nominatim($httpClient, 'https://nominatim.openstreetmap.org', 'metawealthinc');
        try {
            $results = $provider->geocodeQuery(GeocodeQuery::create($address));
            $lat = $results->first()->getCoordinates()->getLatitude();
            $lng = $results->first()->getCoordinates()->getLongitude();
            return [$lat, $lng];
        } catch(\Exception $e) {
            return "null";
        }
    }

    public function supportTickets(Request $request) {
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

        $SupportTicketsList = SupportTickets::where('user_id', auth()->user()->id)->get();

        return view('user.support.support_tickets', compact(['totalWealth', 'user', 'myAge', 'startYear', 'endYear', 'wealthData', 'statement', 'clientDetail', 'incomes', 'events', 'totalWealth', 'userAge', 'rateReturn', 'wealthIncomes', 'incomeChart', 'wealthEvents', 'eventsChart', 'eventsLineChart', 'SupportTicketsList']));
    }

    public function addSupportTickets(Request $request) {
        $SupportTickets = new SupportTickets;
        if($request->file_name) {
            $file = $request->file_name;
            
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/uploads/', $name);
            $SupportTickets->files = $name;
        }
        $SupportTickets->code = random_int(100000, 999999).date('s');
        $SupportTickets->user_id = $request->userId;
        $SupportTickets->subject = $request->supportSubject;
        $SupportTickets->details = $request->supportDescription;
        $SupportTickets->status = 'pending';
        if($SupportTickets->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function viewSupport($id) {
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

        $SupportTickets = SupportTickets::where('id', $id)->first();
        $SupportTickets['replies'] = SupportTicketsReplies::where('ticket_id', $id)->orderBy('id', 'ASC')->get();

        return view('user.support.view', compact(['totalWealth', 'user', 'myAge', 'startYear', 'endYear', 'wealthData', 'statement', 'clientDetail', 'incomes', 'events', 'totalWealth', 'userAge', 'rateReturn', 'wealthIncomes', 'incomeChart', 'wealthEvents', 'eventsChart', 'eventsLineChart', 'SupportTickets']));
    }

    public function replySupportTickets(Request $request) {
        $SupportTickets = SupportTickets::where('id', $request->ticket_id)->first();
        $SupportTickets->status = 'pending';
        $SupportTickets->viewed = '0';
        $SupportTickets->update();
        
        $ticket_reply = new SupportTicketsReplies();
        if($request->file_name) {
            $file = $request->file_name;
            
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/uploads/', $name);
            $ticket_reply->files = $name;
        }
        $ticket_reply->ticket_id = $request->ticket_id;
        $ticket_reply->user_id = auth()->user()->id;
        $ticket_reply->details = $request->msg;

        if($ticket_reply->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function addLivingExpenses($userId, $age) {

        $livingExpenceData = WealthManagement::where('user_id', $userId)->where('event_name', 6)->first();

        if(!$livingExpenceData) {
            $years = [];
            $year = date("Y");

            for ($i = $age; $i <= 99; $i++) {
                $years[$year] = 100000;
                $year++;
            }

            $eYear = 99 - $age;
            $endYear = date("Y") + $eYear;

            $WealthManagement = new WealthManagement;
            $WealthManagement->user_id = $userId;
            $WealthManagement->event_name = 6;
            $WealthManagement->event_budget = 100000;
            $WealthManagement->event_year = date("Y");
            $WealthManagement->event_start_year = date("Y");
            $WealthManagement->event_end_year = $endYear;
            $WealthManagement->total_wealth = 0;
            $WealthManagement->age = $age;
            $WealthManagement->devide_year = json_encode($years);

            if($WealthManagement->save()) {
                return true;
            } else {
                return false;
            }
        }                
    }
    
    public function addClientsEvent(Request $request) {
        $interest = $downPayment = $isOtherEvent = 0;
        $spam_words = ["house", "home"];
        $expression = '/\b(?:' . implode($spam_words, "|") . ')\b/i';

        if ($request->event_name == 'other') {
            $otherEvent = OtherEvents::where('name', $request->other_event_name)->first();
            if ($otherEvent) {
                $eventName = $otherEvent->id;
            } else {                
                $otherEvent = OtherEvents::create([
                    'name' => $request->other_event_name,
                ]);
            }
            $eventName = $otherEvent->id;
            $isOtherEvent = 1;
        } else {
            $eventName = $request->event_name;            
        }

        if($request->event_end_year == $request->event_start_year){
            $total_year = 1;
        }else{
            $total_year = abs($request->event_end_year - $request->event_start_year + 1);
        }

        if($request->interest){
            $interest = $request->interest;
        }

        if($request->down_payment){
            $downPayment = $request->down_payment;
        }

        if(($request->event_name == 1) || ($request->other_event_name != null && preg_match($expression, $request->other_event_name))) {
            $index = 0;
            if ($interest == 0) {
                $years[$request->event_start_year] = (int)(str_replace(',', '', $request->event_amount));
                $down_payment = $downPayment;
            } else {
                if ($downPayment > 0 && $downPayment != '' && $downPayment != null) {
                    $down_payment = $downPayment;
                    $r = (int)$interest / 100;
                    $p = (int)(str_replace(',', '', $request->event_amount) - $down_payment);
                    $t = (int)$total_year;
                    $n = 12;

                    $final_amount = (($p) * ($r / $n) * pow((1 + ($r / $n)), ($n * $t)) / (pow((1 + ($r / $n)), ($n * $t)) - (1)));
                    $years = [];

                    for ($i = $request->event_start_year; $i <= $request->event_end_year; $i++) {
                        $finalValue = number_format((float)$final_amount, 2, '.', '') * 12;
                        if($index == 0){
                            $value = $finalValue + $down_payment;
                        }else{
                            $value = $finalValue;
                        }
                        $years[$i] = $value;
                        $index++;
                    }
                } else {
                    $r = (int)$interest / 100;
                    $p = (int)(str_replace(',', '', $request->event_amount));
                    $t = (int)$total_year;
                    $n = 12;

                    $final_amount = (($p) * ($r / $n) * pow((1 + ($r / $n)), ($n * $t)) / (pow((1 + ($r / $n)), ($n * $t)) - (1)));
                    $years = [];
                    $down_payment = null;

                    for ($i = $request->event_start_year; $i <= $request->event_end_year; $i++) {
                        $years[$i] = str_replace(',', '', $final_amount) * 12;
                    }
                }
            }
        } else {
            $index = 0;
            $years = [];
            $down_payment = $downPayment;

            if($down_payment > 0 && $down_payment != null){
                $eventBudget = str_replace(',', '', $request->event_amount);
                $finalValue = $eventBudget - $down_payment;
            }else{
                $finalValue = str_replace(',', '',$request->event_amount);
            }
            $eventfinalValue = $finalValue / $total_year;
            for ($i = $request->event_start_year; $i <= $request->event_end_year; $i++) {
                if($index == 0){
                    $value = $eventfinalValue +  $down_payment;
                }else{
                    $value = $eventfinalValue;
                }
                $years[$i] = $value;
                $index++;
            }
        }

        if (!isset($request->wealth_management_id) && ($request->wealth_management_id == null || $request->wealth_management_id == '')) {
            $WealthManagement = new WealthManagement;
            $WealthManagement->user_id = $request->user_id;
            $WealthManagement->event_name = $eventName;
            $WealthManagement->event_budget = str_replace(',', '', $request->event_amount);
            $WealthManagement->event_year = $request->event_start_year;
            $WealthManagement->event_start_year = $request->event_start_year;
            $WealthManagement->event_end_year = $request->event_end_year;
            $WealthManagement->interest =  $interest;
            $WealthManagement->down_payment = $down_payment;
            $WealthManagement->devide_year = json_encode($years);
            $WealthManagement->rate_return = $request->rate_return;
            $WealthManagement->total_wealth = str_replace(',', '', $request->total_wealth);
            $WealthManagement->age = $request->age;
            $WealthManagement->is_other_event = $isOtherEvent;
            
            if($WealthManagement->save()) {
                $updateTotalWealth = WealthManagement::where('user_id', $request->user_id)->get();
                foreach($updateTotalWealth as $wealth) {
                    $wealth->total_wealth = str_replace(',', '', $request->total_wealth);
                    $wealth->update();
                }
                return true;
            } else {
                return false;
            }
        } else {
            $wealthManagement = WealthManagement::where('id', $request->wealth_management_id)->first();
            if ($wealthManagement) {
                $wealthManagement->event_name = $eventName;
                $wealthManagement->event_budget = str_replace(',', '', $request->event_amount);
                $wealthManagement->event_year = $request->event_start_year;
                $wealthManagement->event_start_year = $request->event_start_year;
                $wealthManagement->event_end_year = $request->event_end_year;
                $wealthManagement->interest =  $interest;
                $wealthManagement->down_payment = $down_payment;
                $wealthManagement->devide_year = json_encode($years);
                $wealthManagement->rate_return = $request->rate_return;
                $wealthManagement->total_wealth = str_replace(',', '', $request->total_wealth);
                $wealthManagement->age = $request->age;
                $wealthManagement->is_other_event = $isOtherEvent;
            
                if($wealthManagement->save()) {
                    $updateTotalWealth = WealthManagement::where('user_id', $request->user_id)->get();
                    foreach($updateTotalWealth as $wealth) {
                        $wealth->total_wealth = str_replace(',', '', $request->total_wealth);
                        $wealth->update();
                    }
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function addClientsIncome(Request $request) {
        if(isset($request->interest)){
            $interest = $request->interest;
        }else{
            $interest = null;
        }

        if (!isset($request->wealth_management_id) && ($request->wealth_management_id == null || $request->wealth_management_id == '')) {
            $WealthManagement = new WealthManagement;
            $WealthManagement->user_id = $request->user_id;
            $WealthManagement->income_name = $request->income_name;
            $WealthManagement->income_budget = $request->income_amount;
            $WealthManagement->income_year = $request->income_year;
            $WealthManagement->total_wealth = $request->total_wealth;;
            $WealthManagement->age = $request->age;
            $WealthManagement->interest = $interest;
            $WealthManagement->rate_return = $request->rate_return;

            if($WealthManagement->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            $wealthManagement = WealthManagement::where('id', $request->wealth_management_id)->where('user_id', $request->user_id)->first();
        
            if($wealthManagement){
                $wealthManagement->income_name = $request->income_name;
                $wealthManagement->income_budget = $request->income_amount;
                $wealthManagement->income_year = $request->income_year;
                $wealthManagement->total_wealth = $request->total_wealth;;
                $wealthManagement->age = $request->age;
                $wealthManagement->interest = $interest;
                $wealthManagement->rate_return = $request->rate_return;
                $wealthManagement->update();
                return true;
            }
        }                
    }    

}
