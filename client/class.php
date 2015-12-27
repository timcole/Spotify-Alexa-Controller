<?php

class Spotify
{
	public $port = 4370;
	public $hostname = "alexa.spotilocal.com";

	public $oauth;
	public $csrf;

	public function __construct($csrf)
	{
		$this->oauth = json_decode(file_get_contents('https://open.spotify.com/token'), true)['t'];
		$this->csrf = $csrf;
	}

	public function baseURL()
	{
		return "https://".$this->hostname.":".$this->port;
	}

	public function play($uri)
	{
		$opts['http']['method'] = 'GET';
		$opts['http']['header'] = "Origin: https://open.spotify.com\r\n";
		$pramas = array(
			'oauth' => $this->oauth,
			'csrf' => $this->csrf,
			'uri' => $uri,
			'context' => $uri
		);
		$context = stream_context_create($opts);
		file_get_contents($this->baseURL()."/remote/play.json?".http_build_query($pramas), false, $context);
	}

	public function skip($uri)
	{
		$this->play($uri);
	}

	public function pause()
	{
		$opts['http']['method'] = 'GET';
		$opts['http']['header'] = "Origin: https://open.spotify.com\r\n";
		$pramas = array(
			'oauth' => $this->oauth,
			'csrf' => $this->csrf,
			'pause' => 'true'
		);
		$context = stream_context_create($opts);
		file_get_contents($this->baseURL()."/remote/pause.json?".http_build_query($pramas), false, $context);
	}

	public function unpause()
	{
		$opts['http']['method'] = 'GET';
		$opts['http']['header'] = "Origin: https://open.spotify.com\r\n";
		$pramas = array(
			'oauth' => $this->oauth,
			'csrf' => $this->csrf,
			'pause' => 'false'
		);
		$context = stream_context_create($opts);
		file_get_contents($this->baseURL()."/remote/pause.json?".http_build_query($pramas), false, $context);
	}
}
