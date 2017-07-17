<?php
    include "sms.class.php";

    $options = array(
	    'smsType'      => 'normal', 
	    'signName'     => '海鲜商城009', 
	    'recNum'       => '13859251427', 
	    'templateCode' => 'SMS_77425032', 
    );

    $req = new Sms('24547288', 'de45a021511d5e88712d3380b739f5c0'); // appKey, secretKey
    $resp = $req->sendSms($options);

    function dump($var) {
    	echo '<pre>';
    	print_r($var);
    	echo '</pre>';
    }

    if(!empty($resp->result)) {
    	dump($resp->result);
    } else {
    	dump($resp);
		echo $resp->msg;
		echo '<br/>';
		echo $resp->code;
		echo '<br/>';
	    echo $resp->sub_code;
	    echo '<br/>';
	    echo $resp->sub_msg;    	
    }
?>