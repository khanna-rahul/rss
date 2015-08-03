<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Acme\Feed as RSS;
use App\Feed;

class FeedController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$url = Feed::get()->toArray();
		return view('url', compact('url'));
	}

	public function postIndex(Request $request)
	{
		$this->validate($request, ['url' => 'required']);
		Feed::create($request->all());
		return redirect('/');
	}

	public function deleteUrl(Request $request)
	{
		$this->validate($request, ['id' => 'required|numeric']);
		Feed::where('id','=',$request->id)->delete();
		return response()->json([], 200);
	}

    public function fetch() 
    {
    	$result = new RSS();
    	$url = $this->get_url_only(Feed::get()->toArray());
    	$feed = $result->fetch($url);
    	$result = $feed->get_items();
    	return view('result', compact('result'));
    }

    private function get_url_only($array)
    {
    	$temp = array();
    	foreach($array as $arr)
    	{
    		$temp[] = $arr['url'];
    	}
    	return $temp;
    }
}
