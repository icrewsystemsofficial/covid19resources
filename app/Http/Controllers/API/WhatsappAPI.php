<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Resource;
use App\Models\Whatsapp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Whatsapp as ModelsWhatsapp;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\WhatsappAuthentication;


class WhatsappAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["message" => "Whatsapp resource API operational"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'body' => 'required|min:10',
        //     'location' => 'required',
        //     'state' => 'required',
        //     'city' => 'required',
        //     'wa_phone' => 'required',
        //     'wa_name' => 'required',
        //     'status' => 'required',
        // ]);
        $rawdata = $request->json()->all();
        $data = json_decode($rawdata);
        // Log::info(json_encode($rawdata));
        // $whatsapp = new Whatsapp();
        // $whatsapp->title = $data["title"];
        // $whatsapp->body = $data["description"];
        // $whatsapp->location = $data["location"];
        // $whatsapp->state = $data["state"];
        // $whatsapp->city = $data["city"];
        // $whatsapp->wa_phone = $data["wa_phone"];
        // $whatsapp->wa_name = $data["wa_name"];
        // $whatsapp->status = 0;
        // $whatsapp->save();
            dd($request);
        return view('dashboard.static.about');
    }

 public function authenticate_old($phone) {

        if($phone == '') {
            $response['code'] = '201';
            $response['message'] = 'Phone number must be passed';

            return response($response);
        }

        $user = User::where('phone_number', $phone)->first();
        if($user) {
            $user->isPhoneVerified = 1;
            // $user->save();
            // return $user;

            $generated_uuid = Str::uuid();


            // $find_dupes = WhatsappAuthentication::where('uuid', $generated_uuid)->first();
            // if(!$find_dupes) {

            // }


            $authenticate = new WhatsappAuthentication;
            $authenticate->phone = $phone;
            $authenticate->token = $generated_uuid;
            $authenticate->user_id = $user->id;

            // $authenticate->save();

            $response['code'] = 200;
            $response['message'] = 'Phone number verified, token generated';
            $response['token'] = $generated_uuid;
            $response['verifiecation_url'] = route('api.whatsapp.verify_uuid', $generated_uuid);

            return $response;

        } else {
            $response['code'] = '202';
            $response['message'] = 'No users found with phone number '.$phone;
            return response($response);
        }
    }

    public function authenticate($email, $phone) {

        if($email == '') {
            $response['code'] = '201';
            $response['message'] = 'Email must be passed';

            return response($response);
        }

        $user = User::where('email', $email)->first();
        if($user) {

            if($user->phone_number != $phone) {
                $response['code'] = '201';
                $response['message'] = 'Phone number does not match the provided account';
                return response($response);
            } else {
                $generated_uuid = Str::uuid();

                // $find_dupes = WhatsappAuthentication::where('uuid', $generated_uuid)->first();
                // if(!$find_dupes) {

                // }

                $authenticate = new WhatsappAuthentication;
                $authenticate->phone = $phone;
                $authenticate->token = $generated_uuid;
                $authenticate->user_id = $user->id;

                $authenticate->save();

                $response['code'] = 200;
                $response['message'] = 'Phone number matches '.$user->name.'\'s records. Click the link to authenticate phone number';
                $response['token'] = $generated_uuid;
                $response['verifiecation_url'] = route('api.whatsapp.verify_uuid', $generated_uuid);
                $response['user'] = $user;
                return $response;
            }

        } else {
            $response['code'] = '202';
            $response['message'] = 'No users found with e-mail '.$email;
            return response($response);
        }
    }

    public function verify($token) {

        $response = array();

        $authentication = WhatsappAuthentication::where('token', $token)->first();
        if($authentication) {
            $response['code'] = '200';
            $response['message'] = 'Token identified, authenticating phone number';

            $user = User::find($authentication->user_id);
            $user->isPhoneVerified = 1;
            $user->save();

            return response($response);
        } else {
            $response['code'] = '201';
            $response['message'] = 'Invalid token';

            return response($response);
        }

    }
    
    public function change_status($id = '', $status = '') {
        $respone = array();
        if($id == '' || $status == '') {
            $respone['message'] = 'ID or STATUS was not passed with the request';
            $respone['type'] = 'error';
            return response($respone);
        }

        //TO:DO This needs to be made into some sort of STD class.
        $allowed_statuses = array('0', '1', '2', '3', '4');

        if(!in_array($status, $allowed_statuses)) {
            $respone['message'] = 'Unknown status type';
            $respone['type'] = 'error';
            return response($respone);
        }

        $whatsapp = ModelsWhatsapp::find($id);
        if(!$whatsapp) {
            $respone['message'] = 'Whatsapp Resource with ID not found';
            $respone['type'] = 'error';
            return response($respone);
        } else {
            $whatsapp->status = $status;
            $whatsapp->update();
            $respone['message'] = 'Whatsapp Resource was updated';
            $respone['type'] = 'success';
            return response($respone);
        }
}

    public function delete_whatsapp_resource($id) {
            $respone = array();
    
            ModelsWhatsapp::find($id)->delete();
            $respone['message'] = 'Whatsapp Resource was deleted';
            return response($respone);
        }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function stats() {
        $status = array();
        $status[] = Whatsapp::PENDING;
        $status[] = Whatsapp::VERIFIED;
        $status[] = Whatsapp::REFUTED;
        $status[] = Whatsapp::SPAM;
        $status[] = Whatsapp::INADEQUATE;
        $status[] = Whatsapp::DUPE;
        $status[] = Whatsapp::SCREENED;

        $response = array();
        $data = array();
        foreach($status as $status) {
            $whatsapp = Whatsapp::where('status', $status)->count();
            $response['count'] = $whatsapp;

            switch($status) {
                case 0:
                    $response['name'] = 'Pending';
                    $response['color'] = 'dark';
                    $response['gradient'] = 'bg-warning-gradient';
                    $response['icon'] = 'question';
                break;

                case 6:
                    $response['name'] = 'Screened';
                    $response['color'] = 'warning';
                    $response['gradient'] = 'bg-warning-gradient';
                    $response['icon'] = 'check';
                break;

                case 1:
                    $response['name'] = 'Verified';
                    $response['color'] = 'success';
                    $response['gradient'] = 'bg-success-gradient';
                    $response['icon'] = 'check-circle';
                break;

                case 2:
                    $response['name'] = 'Refuted';
                    $response['color'] = 'danger';
                    $response['gradient'] = 'bg-danger-gradient';
                    $response['icon'] = 'exclamation-triangle';
                break;

                case 3:
                    $response['name'] = 'Spam';
                    $response['color'] = 'dark';
                    $response['gradient'] = 'bg-dark';
                    $response['icon'] = 'times-circle';
                break;

                case 4:
                    $response['name'] = 'Inadequate Info';
                    $response['color'] = 'dark';
                    $response['gradient'] = 'bg-dark';
                    $response['icon'] = 'question';
                break;

                case 5:
                    $response['name'] = 'Retweet';
                    $response['color'] = 'primary';
                    $response['gradient'] = 'bg-gradient-primary';
                    $response['icon'] = 'check';
                break;


                default:
                    throw new Exception('Unknown status ID type provided');
                break;
            }

            $data[$status] = $response;
        }

        $data['total'] = Whatsapp::count();
        // $data['converted'] = Resource::where('tweet_id', '!=', null)->count();

        return $data;
    }
}
