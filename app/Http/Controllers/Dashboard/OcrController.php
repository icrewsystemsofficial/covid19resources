<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class OcrController extends Controller
{
    public function index()
    {
        $cookie = Cookie::get('parsetext');
        $data = json_decode($cookie);
        return view('dashboard.home.ocr.index')->with('data',$data);
    }


    public function getImage(Request $request)
    {
        // $image = request('image');
        // dd($image);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            return $this->uploadtoApi($image);
        } else {
            return 'please upload a file';
        }

    }

    public function uploadtoApi($image)
    {
        // dd($image);
        $response =  Http::withHeaders([
                    'apikey' => 'e85b6aed8f88957',
                    'OCREngine' => '2'
                ])->attach('attachment',file_get_contents($image), 'image.jpg')
                    ->post('https://api.ocr.space/parse/image/');

        foreach($response['ParsedResults'] as $pareValue) {
            $cookie = cookie('parsedText', $pareValue['ParsedText'],10);
            //notify()->success('Extracted text from the image, please check the description box', 'Yay!');
            return response()->json($pareValue['ParsedText']);
        }
    }


    public function generateText_getImage(Request $request)
    {
        // $image = request('image');
        // dd($image);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            return $this->generateText($image);
        } else {
            notify()->error('Please upload an image', 'Whoops');
            return back();
        }

    }


    public function generateText($image)
    {
        // dd($image);
        $response =  Http::withHeaders([
                    'apikey' => 'e85b6aed8f88957',
                    'OCREngine' => '2'
                ])->attach('attachment',file_get_contents($image), 'image.jpg')
                    ->post('https://api.ocr.space/parse/image/');

        foreach($response['ParsedResults'] as $pareValue) {
            $cookie = cookie('parsedText', $pareValue['ParsedText'],10);
            notify()->success('Extracted text from the image, please check the description box', 'Yay!');
            return redirect(route('home.add.resource'))->withCookie($cookie);
        }
    }


    // public function uploadtoApi($image)
    // {
    //     $response =  Http::withHeaders([
    //         'apikey' => 'e85b6aed8f88957'
    //     ])->attach('attachment',file_get_contents($image), 'image.jpg')
    //         ->post('https://api.ocr.space/parse/image');

    //     return $response;
    // }
}
