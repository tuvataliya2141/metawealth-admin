<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PersonalDetails;
use App\Models\AssignAdvisor;
use App\Models\Events;
use App\Models\OtherEvents;
use App\Models\Incomes;
use App\Models\WealthManagement;
use App\Models\Location;
use App\Http\Controllers\MailController;
use App\Models\CrmClients;
use Exception;
use Illuminate\Validation\Rule;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Provider\Nominatim\Nominatim;
use Http\Client\Curl\Client as CurlClient;
use Carbon\Carbon;

class AdvisorController extends Controller
{
    public function index() {
        $users = AssignAdvisor::where('advisor_id', auth()->user()->id)->join('users', 'users.id', '=', 'assign_advisors.user_id')->get();

        return view('advisor.home', compact(['users']));
    }

    // Clients
    public function allClients() {
        // $clients = AssignAdvisor::select('users.*', 'personal_details.*', 'users.status as user_status')
        //         ->where('advisor_id', auth()->user()->id)
        //         ->where('users.role', 0)
        //         ->join('users', 'users.id', '=', 'assign_advisors.user_id')
        //         ->join('personal_details', 'users.id', '=', 'personal_details.user_id')
        //         ->get();
        $clients = AssignAdvisor::select('crm_clients.*')
                ->where('advisor_id', auth()->user()->id)
                ->where('crm_clients.clients', 'no')
                ->join('crm_clients', 'crm_clients.id', '=', 'assign_advisors.user_id')
                ->get();
        // dd($clients);
        $assignedUser = AssignAdvisor::pluck('user_id')->toArray();

        if(count($assignedUser) > 0) {
            $users = User::where('role', 0)->whereNotIn('id', $assignedUser)->get();
        } else {
            $users = User::where('role', 0)->get();
        }

        return view('advisor.clients.index', compact(['clients', 'users']));
    }

    public function advisorAllLeads() {
        $clients = AssignAdvisor::select('users.*', 'personal_details.*', 'users.status as user_status')
                ->where('advisor_id', auth()->user()->id)
                ->where('users.role', 0)
                ->join('users', 'users.id', '=', 'assign_advisors.user_id')
                ->join('personal_details', 'users.id', '=', 'personal_details.user_id')
                ->get();

        $assignedUser = AssignAdvisor::pluck('user_id')->toArray();

        if(count($assignedUser) > 0) {
            $users = User::where('role', 0)->whereNotIn('id', $assignedUser)->get();
        } else {
            $users = User::where('role', 0)->get();
        }
        // dd($clients);
        return view('advisor.clients.leadsList', compact(['clients', 'users']));
    }

    public function addClient() {
        return view('advisor.clients.addClient');
    }

    public function storeClient(Request $request) {
        $findVal = 0;
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required | unique:users',
            'dob' => 'required',
            'gender' => 'required',
            'password' => 'required|confirmed',
        ]);

        $birthday = Carbon::createFromFormat('Y-m-d', $request->dob);
        $age = $birthday->diffInYears(Carbon::now());

        $pd = PersonalDetails::all();

        if($pd) {
            foreach($pd as $value) {
                if($value->phone != null || $value->phone != '') {
                    $phone = decrypt($value->phone);
                    if($phone == $request->phone) {
                        $findVal = 1;
                    }
                }
            }
        }

        if($findVal == 0) {
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'role' => 0,
                'email' => $request->email,
                'status' => 1,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {
                $details =[
                    'user' => [
                        'user_id' => encrypt($user->id),
                        'email' => $user->email,
                        'password' => $request->password,
                        'img' => env('LOGO'),
                    ],
                    'view' => 'mails.welcomeWithVerification'
                ];

                $result = (new MailController)->send($details);

                if($result) {
                    $latLng = $this->getLatLng($request->address);
                    if($latLng != null) {
                        $latitude = $latLng[0];
                        $longitude = $latLng[1];
                    }

                    $personalDetails = PersonalDetails::create([
                        'user_id' => $user->id,
                        'first_name' => isset($request->first_name) ? encrypt($request->first_name) : NULL,
                        'last_name' => isset($request->last_name) ? encrypt($request->last_name) : NULL,
                        'phone' => isset($request->phone) ? encrypt($request->phone) : NULL,
                        'email' => isset($request->email) ? encrypt($request->email) : NULL,
                        'dob' => isset($request->dob) ? encrypt($request->dob) : NULL,
                        'gender' => isset($request->gender) ? encrypt($request->gender) : NULL,
                        'status' => encrypt('self'),
                        'joint_plan' => isset($request->joint_profile) ? encrypt($request->joint_profile) : NULL,
                        'marital_status' => isset($request->marital_status) ? encrypt($request->marital_status) : NULL,
                        'retired' => isset($request->retired) ? encrypt($request->retired) : NULL,
                        'address' => isset($request->address) ? encrypt($request->address) : NULL,
                        'latitude' => isset($latitude) ? encrypt($latitude) : NULL,
                        'longitude' => isset($longitude) ? encrypt($longitude) : NULL,
                        'city' => isset($request->city) ? encrypt($request->city) : NULL,
                        'province' => isset($request->province) ? encrypt($request->province) : NULL,
                        'postal_code' => isset($request->postal_code) ? encrypt($request->postal_code) : NULL,
                        'is_child' => ($request->have_child == 1) ? encrypt('yes') : 'no',
                        'child_tot' => isset($request->child) ? encrypt($request->child) : NULL,
                    ]);

                    if ($request->marital_status == 'married') {
                        PersonalDetails::create([
                            'user_id' => $user->id,
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
                    
                    if($personalDetails) {
                        $this->addLivingExpenses($user->id, $age);
                        AssignAdvisor::create([
                            'user_id' => $user->id,
                            'advisor_id' => auth()->user()->id,
                        ]);
                        return redirect()->route('advisorAllClients')->with('success', 'Data added successfully!');
                    }
                }
            }
        } else {
            return redirect()->back()->with('error', 'Phone number is already registered, please try again with different phone no.!');
        }
    }

    public function updateClient($id) {
        $client = CrmClients::where('id', $id)->first();
        return view('advisor.clients.updateClient', compact(['client']));
    }

    public function editCRMClient(Request $request) {
        $request->validate([
            'date_contact' => 'required',
            'mode_contact' => 'required',
            'notes_from_contact' => 'required',
            'followup_date' => 'required',
            'status' => 'required',
            'followup_notification' => 'required',
            'followup_notification_email' => 'required',
        ]);

        $crmClients = CrmClients::where('id', $request->id)->first();
        $crmClients->date_of_contact = isset($request->date_contact) ? $request->date_contact : null;
        $crmClients->mode_of_contact = isset($request->mode_contact) ? $request->mode_contact : null;
        $crmClients->notes_from_contact = isset($request->notes_from_contact) ? $request->notes_from_contact : null;
        $crmClients->followup_date = isset($request->followup_date) ? $request->followup_date : null;
        $crmClients->status = isset($request->status) ? $request->status : null;
        $crmClients->followup_notification = isset($request->followup_notification) ? $request->followup_notification : 0;
        $crmClients->followup_notification_email = isset($request->followup_notification_email) ? $request->followup_notification_email : 0;
        $crmClients->clients = isset($request->client) ? $request->client : 'no';
        $crmClients->update();
        return redirect()->route('advisorAllClients')->with('success', 'Cliens Updated successfully!');
    }

    public function statusUpdateAdvisor($id) {
        $client = CrmClients::where('id', $id)->first();
        if($client){
            $user = new User;
            $user->name = $client->first_name . ' ' . $client->last_name;
            $user->role = 0;
            $user->email  = $client->email;
            $user->password  = Hash::make($client->phone_number);
            $user->status  = 1;
            $user->save();
            $details =[
                'user' => [
                    'user_id' => encrypt($user->id),
                    'email' => $user->email,
                    'img' => env('LOGO'),
                ],
                'view' => 'mails.verifyAccount'
            ];
    
            $result = (new MailController)->send($details);
            $latLng = $this->getLatLng($client->address);
            if($latLng != null) {
                $latitude = $latLng[0];
                $longitude = $latLng[1];
            }
            if($result){
                $personalDetails = new PersonalDetails;
                $personalDetails->user_id = $user->id;
                $personalDetails->first_name = isset($client->first_name) ? encrypt($client->first_name) : NULL;
                $personalDetails->last_name = isset($client->last_name) ? encrypt($client->last_name) : NULL;
                $personalDetails->dob = isset($client->birth_date) ? encrypt($client->birth_date) : NULL;
                $personalDetails->gender = isset($client->gender) ? encrypt($client->gender) : NULL;
                $personalDetails->phone = isset($client->phone_number) ? encrypt($client->phone_number) : NULL;
                $personalDetails->email = isset($client->email) ? encrypt($client->email) : NULL;
                $personalDetails->address = isset($client->address) ? encrypt($client->address) : NULL;
                $personalDetails->latitude = isset($latitude) ? encrypt($latitude) : NULL;
                $personalDetails->longitude = isset($longitude) ? encrypt($longitude) : NULL;
                $personalDetails->status = encrypt('self');
                $personalDetails->save();
            }
            // dd($client);
            $client->clients = 'yes';
            $client->update();
        }
        return true;
    }
    
    public function updateLeads($id) {
        $client = [];

        $clientPersonalDetails = PersonalDetails::where('user_id', $id)->orderBy('id', 'ASC')->get();        
        $client['self'] = $clientPersonalDetails[0];
        $client['spouse'] = isset($clientPersonalDetails[1]) ? $clientPersonalDetails[1] : '';

        return view('advisor.clients.updateLeads', compact(['client']));
    }

    public function editClient(Request $request) {
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
                $latLng = $this->getLatLng($request->address);
                if($latLng != null) {
                    $latitude = $latLng[0];
                    $longitude = $latLng[1];
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
            
            return redirect()->route('advisorAllClients')->with('success', 'Data updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Phone number is already registered, please try again with different phone no.!');
        }
    }

    public function deleteClient($id) {
        $personalDetails = PersonalDetails::where('user_id', $id)->get();
        if($personalDetails) {
            foreach($personalDetails as $personalDetail) {
                $personalDetail->delete();
            }
        }

        $client = User::where('id', $id)->first();
        if($client) {
            $client->delete();
        }

        return true;
    }

    public function assignAdvisor(Request $request) {
        $advisor=User::where('id', $request->advisor_id)->where('role', 3)->first();
        $user=User::where('id', $request->client_id)->where('role', 0)->first();

        if($advisor) {
            if($user) {
                $assignedAdvisor = AssignAdvisor::where('user_id', $request->client_id)->first();

                if($assignedAdvisor) {
                    $assignedAdvisor->advisor_id = $request->advisor_id;
                    if($assignedAdvisor->update()) {
                        $data = [
                            'success' => true,
                            'message'=> 'User assigned successfully!'
                        ];

                        return response()->json($data);    
                    }
                } else {
                    AssignAdvisor::create([
                        'user_id' => $request->client_id,
                        'advisor_id' => $request->advisor_id,
                    ]);
                    
                    $data = [
                        'success' => true,
                        'message'=> 'User assigned successfully!'
                    ];                  
                    return response()->json($data);
                }
            } else {
                $data = [
                    'success' => false,
                    'message'=> 'User not found!'
                ];                  
                return response()->json($data);
            }
        } else {
            $data = [
                'success' => false,
                'message'=> 'Advisor not found!'
            ];                  
            return response()->json($data);
        }
    }

    public function unAssignAdvisor($id) {
        AssignAdvisor::where('user_id', $id)->delete();

        return redirect()->route('advisorAllClients')->with('success', 'User unassigned successfully!');
    }

    public function viewClient($id) {

        $eventsChart = $this->getEventsChartData($id);

        $incomeChart = $this->getIncomeChartData($id);

        $allAdvisors = User::where('users.role', 3)
                        ->join('personal_details', 'users.id', '=', 'personal_details.user_id')
                        ->get();

        $advisor = NULL;
        $user = User::where('id', $id)->first();
        $personalDetails = PersonalDetails::where('user_id', $id)->get();
        $checkAdvisor = AssignAdvisor::where('user_id', $id)->first();
        // dd($checkAdvisor);
        if($checkAdvisor) {
            $advisor = PersonalDetails::where('user_id', $checkAdvisor->advisor_id)->first();
        }
        $clientDetail['user'] = $user;
        $clientDetail['personalDetails'] = $personalDetails;
        $clientDetail['advisor'] = $advisor;

        $birthday = Carbon::createFromFormat('Y-m-d', decrypt($personalDetails[0]->dob));

        $incomes = Incomes::all();

        $events = Events::all();

        $WealthManagementData = WealthManagement::select('total_wealth', 'age', 'rate_return')->where('user_id', $id)->first();
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
                        where('wealth_management.user_id', $id)->
                        where('wealth_management.income_name', '!=', 'NULL')->
                        where('wealth_management.income_budget', '!=', 'NULL')->
                        where('wealth_management.income_year', '!=', 'NULL')->
                        join('incomes', 'wealth_management.income_name', '=', 'incomes.id')->
                        get();

        $wealthEvents = WealthManagement::where('user_id', $id)->
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
        // dd($clientDetail);
        return view('advisor.clients.view', compact(['clientDetail', 'incomes', 'events', 'totalWealth', 'userAge', 'rateReturn', 'wealthIncomes', 'incomeChart', 'wealthEvents', 'eventsChart', 'allAdvisors']));
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
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function editClientsEvent($id) {
        $wealthManagement = WealthManagement::where('id', $id)->first();

        if($wealthManagement->is_other_event == 1) {
            $otherEventName = OtherEvents::where('id', $wealthManagement->event_name)->first();
            $wealthManagement->eventName = $otherEventName->name;
        }

        if($wealthManagement){
            return response()->json([
                'status' => true,
                'data' => $wealthManagement
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function deleteClientsEvent($id) {
        WealthManagement::where('id', $id)->delete();
        
        return true;
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

    public function editClientsIncome($id) {
        $wealthManagement = WealthManagement::where('id', $id)->first();

        if($wealthManagement){
            return response()->json([
                'status' => true,
                'data' => $wealthManagement
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function deleteClientIncome($id) {
        WealthManagement::where('id', $id)->delete();
        
        return true;
    }

    public function getEventsChartData($id) {
        $wealth_data = WealthManagement::orderBy('id', 'ASC')->where('user_id', $id)->where('event_name', '!=', '')->get();
        $total_wealth_data = WealthManagement::orderBy('total_wealth', 'ASC')->where('user_id', $id)->first();

        $year = date("Y"); 
        $sum_of_year = array();

        $totalYearOfRecord = [];
        $lagacy =  $totalValue = $i = $totalWealthData = 0;

        if ($total_wealth_data && $total_wealth_data->total_wealth > 0 && count($wealth_data) > 0) {
            foreach ($wealth_data as $key => $value) {
                foreach(json_decode($value->devide_year) as $divYear => $yearValue){
                    $totalValue += $yearValue;
                    if(array_key_exists($divYear,$totalYearOfRecord)){
                        $totalYearOfRecord[$divYear] = (float)$totalYearOfRecord[$divYear] + (float)$yearValue;
                    }else{
                        $totalYearOfRecord[$divYear] = (float)$totalValue;
                    }
                    $totalValue = 0;
                }
                $totalWealthData += $value->total_wealth;
            }

            $i = 1;
            $pv_of_year_short_term_value = $pv_of_year_mid_term_value = $pv_of_year_long_term_value = $total_short_year_count = $total_mid_year_count = $total_long_year_count = $count = 0;
            $pv = [];
            $rate_return = ($value->rate_return) ? ($value->rate_return / 100) : 0.05;

            foreach ($totalYearOfRecord as $key => $grandTotalOfAllEvent) {
                if ($i <= 3) {
                    $pv[$key] = ($grandTotalOfAllEvent) / (pow((1 + $rate_return) , $count));
                    $pv_of_year_short_term_value += ($grandTotalOfAllEvent) / (pow((1 + $rate_return) , $count));
                    $total_short_year_count++;
                }
                if ($i >= 4 && $i <= 10) {
                    $pv[$key] = ($grandTotalOfAllEvent) / (pow((1 + $rate_return) , $count));
                    $pv_of_year_mid_term_value += ($grandTotalOfAllEvent) / (pow((1 + $rate_return) , $count));
                    $total_mid_year_count++;
                }
                if ($i >= 11) {
                    $pv[$key] = ($grandTotalOfAllEvent) / (pow((1 + $rate_return) , $count));
                    $pv_of_year_long_term_value += ($grandTotalOfAllEvent) / (pow((1 + $rate_return) , $count));
                    $total_long_year_count++;
                }                
                $i++;
                $count++;
            }
            
            if ($pv_of_year_short_term_value > 0 || $pv_of_year_mid_term_value > 0 || $pv_of_year_long_term_value > 0) {
                $lagacy = $total_wealth_data->tot_wealth - $pv_of_year_short_term_value - $pv_of_year_mid_term_value - $pv_of_year_long_term_value;
            }

            $pv_of_year_short_term_value = number_format((float)$pv_of_year_short_term_value, 2, '.', '');
            $pv_of_year_mid_term_value = number_format((float)$pv_of_year_mid_term_value, 2, '.', '');
            $pv_of_year_long_term_value = number_format((float)$pv_of_year_long_term_value, 2, '.', '');
            if ($lagacy <= 0) {
                $lagacy = 0;
            } else {
                $lagacy = number_format((float)$lagacy, 2, '.', '');
            }

            $shortTermAllocation = ($pv_of_year_short_term_value * 100) / $total_wealth_data->total_wealth;
            $midTermAllocation = ($pv_of_year_mid_term_value * 100)  / $total_wealth_data->total_wealth;
            $longTermAllocation = ($pv_of_year_long_term_value * 100) / $total_wealth_data->total_wealth;
            $lagacyAllocation = 100 - $shortTermAllocation - $midTermAllocation - $longTermAllocation;

            $Data = [
                'pv_of_year_short_term' => $pv_of_year_short_term_value,
                'pv_of_year_mid_term' => $pv_of_year_mid_term_value,
                'pv_of_year_long_term' => $pv_of_year_long_term_value,
                'lagacy' => $lagacy,
                'chartData' => [
                    'short_term_allocation' => number_format((float)$shortTermAllocation, 2, '.', ''),
                    'mid_term_allocation' => number_format((float)$midTermAllocation, 2, '.', ''),
                    'long_term_allocation' => number_format((float)$longTermAllocation, 2, '.', ''),
                    'lagacy_allocation' => number_format((float)$lagacyAllocation, 2, '.', '')
                ]
            ];            
        } else {
            $Data = [
                'pv_of_year_short_term' => '',
                'pv_of_year_mid_term' => '',
                'pv_of_year_long_term' => '',
                'lagacy' => '',
                'chartData' => [
                    'short_term_allocation' => '',
                    'mid_term_allocation' => '',
                    'long_term_allocation' => '',
                    'lagacy_allocation' => ''
                ]
            ];
        }

        $pie_data = [
            'data' => $Data
        ];

        return $pie_data;

    }

    public function getIncomeChartData($id) {
        $wealth_data = WealthManagement::orderBy('income_year','ASC')->where('user_id',$id)->where('income_name','!=','')->get();
        $total_wealth_data = WealthManagement::orderBy('total_wealth','ASC')->where('user_id',$id)->first();

        $year = date("Y"); 
        $sum_of_year = array();

        foreach ($wealth_data as $key => $value) {   
            if($year==$value->event_end_year)
            {

                if (array_key_exists($year, $sum_of_year)) {
                    $sum_of_year[$year] = (int)$sum_of_year[$year] + (int)$value->income_budget;
                }else{
                    $sum_of_year[$year] = (int)$value->income_budget;

                }

            }
            else
            {
                $year++;
                $sum_of_year[$year] = (int)$value->income_budget;
               
            }
           
        }
    
        $i=1;
        $pv_of_year_short_term = 0;
        $pv_of_year_long_term = 0;

        foreach ($sum_of_year as $key => $value) 
        { 
            
            if($i<=3)
            {
                if( $pv_of_year_short_term != ''){
                    $pv_of_year_short_term = $pv_of_year_short_term + ($sum_of_year[$key])/ pow( (1+(5/100)), ($i-1));
                    
                }else{
                    $pv_of_year_short_term = ($sum_of_year[$key])/ pow( (1+(5/100)), ($i-1));
                }
            }
            if($i>3)
            {
                if($pv_of_year_long_term != ''){
                    $pv_of_year_long_term = $pv_of_year_long_term + ($sum_of_year[$key])/ pow( (1+(5/100)), ($i-1));
                }else{
                    $pv_of_year_long_term = ($sum_of_year[$key])/ pow( (1+(5/100)), ($i-1));
                }
            }
            $i++;
        }
        $lagacy = '';
        $dataPoints1 = array();
        if($pv_of_year_short_term!='')
        {
            $lagacy = $total_wealth_data['total_wealth'] - ($pv_of_year_short_term + $pv_of_year_long_term);

            $graph_datas = WealthManagement::orderBy('income_budget','DESC')->where('user_id',$id)->get();
            $first_amount = $graph_datas[0]['income_budget'];

            $graph_datas1 = WealthManagement::where('user_id',$id)->sum('income_budget');
            $total_amount = $graph_datas1;

            $remaing_amount = $total_amount-$first_amount;

            $life_expectansy=84;

            $remaing_amount_num = $remaing_amount/$life_expectansy;

            for ($x=1; $x < $life_expectansy; $x++) 
            { 

                if($x==83)
                {
                    $dataPoints1[] = array("x"=>$x,"y"=>number_format((float)$total_amount, 2, '.', ''));
                }
                else
                {
                    $dataPoints1[] = array("x"=>$x,"y"=>number_format((float)$first_amount, 2, '.', ''));
                }
                $first_amount = $first_amount+$remaing_amount_num;
            }

        }

        $pv_of_year_short_term = number_format((float)$pv_of_year_short_term, 2, '.', ''); 
        $pv_of_year_long_term = number_format((float)$pv_of_year_long_term, 2, '.', ''); 
        if($lagacy <= 0){
            $lagacy = 0;
        }
        //$lagacy = number_format((float)$lagacy, 2, '.', '');
        $line_data = json_encode($dataPoints1, JSON_NUMERIC_CHECK);

        $line_chart_data = array(
            'line_data'        => $dataPoints1
        );

        return $line_chart_data;
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

    // Booking
    public function booking() {
        return view('advisor.booking.index');
    }

    // Map
    public function map() {
        $address_lat_long = [];
        $users = AssignAdvisor::select(['personal_details.*', 'users.*', 'personal_details.status as user_status'])
                ->where('assign_advisors.advisor_id', auth()->user()->id)
                ->where('users.role', '=', 0)
                ->where('personal_details.address', '!=', '')
                ->where('personal_details.latitude', '!=', '')
                ->where('personal_details.longitude', '!=', '')
                ->join('users', 'users.id', '=', 'assign_advisors.user_id')
                ->join('personal_details', 'users.id', '=', 'personal_details.user_id')
                ->get();

        // $users = User::select(['personal_details.*', 'users.*', 'personal_details.status as user_status'])->join('personal_details', 'users.id', '=', 'personal_details.user_id')
        //             ->where('users.role', '=', 0)
        //             ->where('personal_details.address', '!=', '')
        //             ->where('personal_details.latitude', '!=', '')
        //             ->where('personal_details.longitude', '!=', '')
        //             ->get();

        if(count($users) > 0) {
            foreach ($users as $user) {
                $status = isset($user->user_status) ? decrypt($user->user_status) : '';
                if($status != '' && $status == 'self') {
                    $address_lat_long[] = [\URL::to('/') . '/sub-admin/clients/view-client/' . $user->user_id, decrypt($user->latitude), decrypt($user->longitude), $user->name];
                }
            }
        }

        return view('advisor.map.index', compact(['address_lat_long']));
    }

    // Profile
    public function profile() {
        $profile = auth()->user();
        return view('advisor.profile.index', compact('profile'));
    }

    public function editProfile(Request $request) {
        $request->validate([
            'name' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if(isset($request->current_pass) && isset($request->password)) {
            $request->validate([
                'current_pass' => 'required',
                'password' => 'required | confirmed',
            ]);

            if(Auth::attempt(['email' => $request->email, 'password' => $request->current_pass])) {
                $user = User::where('email', $request->email)->first();
                $user->password = Hash::make($request->password);
                if ($user->update()) {
                    return redirect()->route('advisorProfile')->with('success', 'Password Changed Successfully.');
                }                    
            } else {
                return redirect()->route('advisorProfile')->with('error', 'Current password is wrong, Please try again.');
            }
        }

        $user = User::where('email', $request->email)->first();
        $user->name = $request->name;

        if ($user->update()) {
            return redirect()->route('advisorProfile')->with('success', 'Detaild Changed Successfully.');
        }
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
