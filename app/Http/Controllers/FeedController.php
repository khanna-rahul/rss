<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SimplePie;

class FeedController extends Controller
{
    public function index() 
    {
    	$feed = new SimplePie();
    	$feed->set_feed_url('http://simplepie.org/blog/feed/');
		$feed->enable_order_by_date(false);
		$feed->enable_cache(false);
		//$feed->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/cache');
		$feed->init();
		echo $feed->get_title();
    	return $feed;
    }
}
