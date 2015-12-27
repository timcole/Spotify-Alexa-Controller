Spotify Alexa (Amazon Echo) Controller
===================

##Client

####Edit index.php

1) edit `$csrf` on line `5` with your spotify csrf  
	- *To get your csrf go to a [Spotify embed page](https://embed.spotify.com/?uri=spotify:user:modesttim:playlist:6LDkyJy3v8tUgZTivg1NZP) and run this javascript in your console (Press F12) and paste:*
```
$.get('https://tpcaahshvs.spotilocal.com:4371/simplecsrf/token.json?&ref=&cors=').done(function(d){prompt('This is your token', d.token)});	
```

2) edit `$playlist` on line `8` with your main playlist's spotify uri
- *Looks like `spotify:user:modesttim:playlist:6LDkyJy3v8tUgZTivg1NZP`*

####Host on local webserver accessible by your main server.

##Server

####Edit spotify.class.php

1) edit `$homeip` on line `10` with your client IP address
	- *HOME IP (PORT 80 Default any other port define it ip:port)*

##Amazon Echo Application

[Alexa Skill Kit Console](https://developer.amazon.com/edw/home.html#/skills/list)

1) Intent Schema
```
{
  "intents": [
    {
      "intent": "Play",
      "slots": []
    },
    {
      "intent": "Pause",
      "slots": []
    },
    {
      "intent": "Skip",
      "slots": []
    },
    {
      "intent": "Unpause",
      "slots": []
    },
    {
      "intent": "SearchSong",
      "slots": [
        {
          "name": "SongName",
          "type": "AMAZON.US_FIRST_NAME"
        }
      ]
    }
  ]
}
```

1) Sample Utterances
```
Play to play
Pause to pause
Unpause to resume
Skip to skip this
SearchSong to play {SongName}
```

##TODO
- Add auto csrf detection