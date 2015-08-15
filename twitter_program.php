
<!-- Properly displays embeded tweets -->
<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
 
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
 
  return t;
}(document, "script", "twitter-wjs"));</script>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Twitter Profile Demo using jQuery</title>
</head>
<body>
    
	<?php require_once('inc/twitter-api-php/TwitterAPIExchange.php');
    
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
            'oauth_access_token' => "1518228594-8tsEviMdjt8995nrcvO2SWouwcm2lzrvepsxqbp",
            'oauth_access_token_secret' => "3rsVrerDIQUCLOa2vurVn5xLH11a4kQgzRDI34NadJwix",
            'consumer_key' => "U7NAPYCT7V8ezv1qrSj3oPf6f",
            'consumer_secret' => "vX1JAeXs84rH5r9rXYpSWM13aHdtkeoC1ymiRdckm9vlvkYWVw"
        );
        
		$screen_name = 'tay_humphreys';
		$user_id = '343110644';
		
        /** Sets up tweet_list fetcher **/
        $list_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $list_api = new TwitterAPIExchange($settings);
		
		$embedded_api = new TwitterAPIExchange($settings);
		$embedded_url = 'https://api.twitter.com/1.1/statuses/oembed.json';
		
		for($page = 0; $page < 1; $page++)
		{
        	$list_getfield = '?count=200&page=' . $page . '&include_rts=false&user_id=' . $user_id . '&screen_name=' . $screen_name;
        
			$tweet_list = json_decode(
				$list_api->setGetfield($list_getfield)
				->buildOauth($list_url, 'GET')
				->performRequest(),
				true
			);  
		
		
			foreach($tweet_list as &$tweet)
			{
	
    			$embedded_getfield = '?align=left&id=' . $tweet['id_str'] 
					. '&url=https%3A%2F%2Ftwitter.com%2F' . $screen_name . '%2Fstatus%2F' . $tweet['id_str']
					. '&omit_script=true';
				
				$embedded_tweet = json_decode(
					$embedded_api->setGetfield($embedded_getfield)
					->buildOauth($embedded_url, 'GET')
					->performRequest(),
					true
				); 
				
				echo $embedded_tweet['html'];
     		}
		}
    ?>
    
    
    
    </body>
</html>

<!-- 
    		<div class = "one_tweet_wrap">
                <div class = "one_tweet">
                    <p class = "date"><?php //echo $one_tweet['created_at']?></p> 
                    <p class = "tweet_id"><?php //echo $one_tweet['id_str']; ?></p>
                    <p class = "raw_text"><?php //echo $one_tweet['text']; ?></p>
                </div>
            </div>
	<?php
		//	}
	//	}
	?>
    
    <style>
		.one_tweet {
			display: inline-block;
			background-color: #FF9;
			margin: 20px;
			padding: 10px;
		}
	
	</style>

	Fetch 5 tweets from tay:
    https://api.twitter.com/1.1/statuses/user_timeline.json?count=5&include_rts=false&user_id=343110644&screen_name=tay_humphreys

-->