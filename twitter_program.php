

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
        
        /** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
		
		for($page = 0; $page < 16; $page++)
		{
        	$getfield = '?count=200&page=' . $page . '&include_rts=false&user_id=343110644&screen_name=tay_humphreys';
        
			$resulting_json = json_decode(
							$twitter->setGetfield($getfield)
                     		->buildOauth($url, $requestMethod)
                     		->performRequest(),
							true
						);  
		
		
			foreach($resulting_json as &$one_tweet)
			{
	?>	
    		<div class = "one_tweet_wrap">
                <div class = "one_tweet">
                    <p class = "date"><?php echo $one_tweet['created_at']?></p> 
                    <p class = "tweet_id"><?php echo $one_tweet['id_str']; ?></p>
                    <p class = "raw_text"><?php echo $one_tweet['text']; ?></p>
                </div>
            </div>
	<?php
			}
		}
	?>
    
    <style>
		.one_tweet {
			display: inline-block;
			background-color: #FF9;
			margin: 20px;
			padding: 10px;
		}
	
	</style>
    
</body>
</html>