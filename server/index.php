<?php

require('spotify.class.php');
$Spotify = new Spotify(file_get_contents('php://input'));

if(isset($Spotify->data->request)) {

	if('IntentRequest' != $Spotify->type) {
    	$Spotify->error();
	}

	if($Spotify->name == "Play") {
		$Spotify->spotify("play");
		$Spotify->sendResponse("Spotify is now playing!");
		exit();
	} elseif($Spotify->name == "Pause") {
		$Spotify->spotify("pause");
		$Spotify->sendResponse("Song paused!");
		exit();
	} elseif($Spotify->name == "Unpause") {
		$Spotify->spotify("unpause");
		$Spotify->sendResponse("Song resumed!");
		exit();
	} elseif($Spotify->name == "Skip") {
		$Spotify->spotify("skip");
		$Spotify->sendResponse("Song skipped!");
		exit();
	} elseif($Spotify->name == "SearchSong") {
		$Spotify->spotifySearch($Spotify->value->SongName->value);
		exit();
	} else {
		$Spotify->sendResponse('Spotify didn\'t like that question!');
		exit();
	}

} else {
	$Spotify->error();
}
