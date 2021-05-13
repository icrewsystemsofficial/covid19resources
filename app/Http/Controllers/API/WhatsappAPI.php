<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Resource;
use App\Models\Whatsapp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $whatsapp = new Whatsapp;
        $whatsapp->title = request()->get('title');
        $whatsapp->body = request()->get('body');
        $whatsapp->location = request()->get('location');
        $whatsapp->state = request()->get('state');
        $whatsapp->city = request()->get('city');
        $whatsapp->wa_phone = request()->get('wa_phone');
        $whatsapp->wa_name = request()->get('wa_name');
        $whatsapp->status = 0;
        $whatsapp->create();

        return response()->json(["msg"=>"success"])
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
