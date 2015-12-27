<?php

class Spotify
{
	public $data;
	public $type;
	public $function;
	public $value;
	public $user;
	public $homeip = "123.456.789"; // HOME IP (PORT 80 Default any other port define it ip:port)

	public function __construct($data)
	{
		$this->data = (object) json_decode($data);
		if(isset($this->data->request->type)){ $this->type = $this->data->request->type; }
		if(isset($this->data->session->user->userId)){ $this->user = $this->data->session->user->userId; }
		if(isset($this->data->request->intent->name)){ $this->name = $this->data->request->intent->name; }
		if(isset($this->data->request->intent->slots)){ $this->value = $this->data->request->intent->slots; }
	}

	public function sendResponse($responseText)
	{
		header('Content-Type: application/json;charset=UTF-8');
		$response = [
			'version' => '1.0',
			'response' => [
				'shouldEndSession' => true,
				'outputSpeech' => [
					'type' => 'PlainText',
					'text' => $responseText,
				],
			],
		];
		echo json_encode($response);
	}

	public function error()
	{
		$this->sendResponse("You didn't tell me what to ask!");
		exit();
	}

	public function spotify($command)
	{
		@file_get_contents("http://".$this->homeip."/?".$command, 0, stream_context_create(array('http' => array('timeout' => 0.1))));
	}

	public function spotifySearch($song)
	{
		$search = @json_decode(file_get_contents("https://api.spotify.com/v1/search?q=".urlencode($song)."&type=track&limit=1"), true);
		if(isset($search['tracks']['items'][0]['uri'])) {
			@file_get_contents("http://".$this->homeip."/?play=".$search['tracks']['items'][0]['uri'], 0, stream_context_create(array('http' => array('timeout' => 0.1))));
			$this->sendResponse("Playing: ".$search['tracks']['items'][0]['name']." by ".$search['tracks']['items'][0]['artists'][0]['name']);
		} else {
			$this->sendResponse("I couldn't find the song you requested.");
		}
	}

}
