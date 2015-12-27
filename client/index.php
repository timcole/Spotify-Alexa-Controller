<?php

require('class.php');

$csrf = ""; // Spotify csrf
$Spotify = new Spotify($csrf);

$playlist = ""; // Default Playlist

if(isset($_GET['play']))  {
	if(empty($_GET['play'])) {
		$Spotify->play($playlist);
	} else {
		$Spotify->play($_GET['play']);
	}
} elseif(isset($_GET['skip'])) {
	$Spotify->skip($playlist);
} elseif(isset($_GET['pause'])) {
	$Spotify->pause();
} elseif(isset($_GET['unpause'])) {
	$Spotify->unpause();
}
