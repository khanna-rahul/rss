<?php

namespace App\Acme;

use SimplePie;

class Feed {

	protected $simplepie;

	protected $feedUrl = [];

	protected $cache_options;

	public function __construct($config = []) {
		if(empty($config))
		{
			$this->cache_options = array (
				'storage' => storage_path() . '/framework/cache',
				'life' => 3600,
				'disabled' => false
			);
		}
		else
		{
			$this->cache_options = $config;
		}
	}

	protected function initalize($url)
	{

		if (!is_array($url))
		{
			$this->feedUrl[] = $url;
		}
		else
		{
			$this->feedUrl = $url;
		}
	}

	protected function configureCache() {
	    if ($this->cache_options['disabled']) {
	      	$this->simplepie->enable_cache(false);
	    }
	    else {
	      	$this->simplepie->set_cache_location($this->cache_options['storage']);
	      	$this->simplepie->set_cache_duration($this->cache_options['life']);
	    }
	}

	public function fetch($url, $config = [])
	{
		$this->initalize($url);
		$this->simplepie = new SimplePie();
		$this->simplepie->set_feed_url($this->feedUrl);
		$this->simplepie->enable_order_by_date(false);
		$this->configureCache();
		$this->simplepie->init();
		$this->simplepie->handle_content_type();
    	return $this->simplepie;
	}

}

?>