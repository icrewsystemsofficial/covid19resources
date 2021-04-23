<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\City;
use App\Models\States;
use App\Models\Twitter;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwitterController extends Controller
{
    public function index() {
        return view('dashboard.admin.twitter.index', [
            'tweets' => Twitter::all(),
        ]);
    }

    public function manage($id) {

        $tweet = Twitter::find($id);
        if(!$tweet) {
            notify()->error('Tweet with given parameters were not found', 'Whoops');
            return redirect(route('admin.twitter.index'));
        }

        $resources = Resource::where('tweet_id', $id)->get();

        // Try to find other tweets by the same user.
        $other_tweets = Twitter::where('username', $tweet->username)->where('id', '!=', $id)->get();

        return view('dashboard.admin.twitter.manage', [
            'tweet' => $tweet,
            'other_tweets' => $other_tweets,
            'resources' => $resources,
            'categories' => Category::where('status', 1)->get(),
            'states' => States::all(),
        ]);
    }


    public function update() {
        dd(request()->input());
    }

    public function convert($id) {
        $tweet = Twitter::find($id);
        if(!$tweet) {
            notify()->error('Tweet with given parameters were not found', 'Whoops');
            return redirect(route('admin.twitter.index'));
        }

        // Try to find other tweets by the same user.
        $other_tweets = Twitter::where('username', $tweet->username)->where('id', '!=', $id)->get();

        return view('dashboard.admin.twitter.convert', [
            'tweet' => $tweet,
            'other_tweets' => $other_tweets,
            'categories' => Category::where('status', 1)->get(),
            'states' => States::all(),
        ]);
    }

    public function convert_save($id) {
        $tweet = Twitter::find($id);
        if(!$tweet) {
            notify()->error('Tweet with given parameters were not found', 'Whoops');
            return redirect(route('admin.twitter.index'));
        }

        // dd(request()->input());
        $resource = new Resource;
        $resource->category = request('category');
        $resource->title = request('name');
        $resource->body = request('body');
        $resource->phone = request('phone');
        $resource->url = request('url');
        $resource->author_id = request('author_id');
        $resource->verified = request('status');

        if(request('status') == 1) {
            $resource->verified_by = request('author_id');
        }

        $resource->tweet_id = $tweet->id;

        $city = City::where('name', request('city'))->first();
        if(!$city) {
            $resource->city = '* Unknown';
            $resource->district = '* Unknown';
            $resource->state = request('state');
        } else {
            $resource->city = $city->name;
            $resource->district = $city->district;
            $resource->state = $city->state;
        }

        $resource->landmark = request('landmark');
        $resource->save();

        notify()->success('Resource was successfully added', 'Yayy!');
        return redirect(route('admin.twitter.manage', $tweet->id));
    }

    public function delete($id) {
        Twitter::find($id)->delete();
        notify()->success('Tweet was successfully deleted', 'Hmmm okay');
        return redirect(route('admin.twitter.index'));
    }
}
