<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    public function fromUser() {
    	
    	return $this->belongsTo(User::class, "from_user_id");
    }

    public function toUser() {
    	
    	return $this->belongsTo(User::class, "to_user_id");
    }

    public function message ($recipient, $message) {
    	// Specify your authentication credentials
    	$username   = "IDCS";
    	$apikey     = "200153fb364834500287ff097b4661810d182eb8be1afb65ed0d85101a109229";
    	// Specify the numbers that you want to send to in a comma-separated list
    	// Please ensure you include the country code (+254 for Kenya in this case)
    	$recipients = $recipient;
    	//$recipients = "+254703249349,+254735037177";
    	// And of course we want our recipients to know what we really do
    	$message    = $message;
    	// Create a new instance of our awesome gateway class
    	$gateway    = new AfricasTalkingGateway($username, $apikey);
    	/*************************************************************************************
    	  NOTE: If connecting to the sandbox:
    	  1. Use "sandbox" as the username
    	  2. Use the apiKey generated from your sandbox application
    	     https://account.africastalking.com/apps/sandbox/settings/key
    	  3. Add the "sandbox" flag to the constructor
    	  $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");
    	**************************************************************************************/
    	// Any gateway error will be captured by our custom Exception class below, 
    	// so wrap the call in a try-catch block
    	try 
    	{ 
    	  // Thats it, hit send and we'll take care of the rest. 
    	  $results = $gateway->sendMessage($recipients, $message);
    	            
    	  foreach($results as $result) {
    	    // status is either "Success" or "error message"
    	    echo " Number: " .$result->number;
    	    echo " Status: " .$result->status;
    	    echo " StatusCode: " .$result->statusCode;
    	    echo " MessageId: " .$result->messageId;
    	    echo " Cost: "   .$result->cost."\n";
    	  }
    	}
    	catch ( AfricasTalkingGatewayException $e )
    	{
    	  echo "Encountered an error while sending: ".$e->getMessage();
    	}
    }
}
