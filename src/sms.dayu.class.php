<?php
class Sms
{
	protected $taoClient;
	protected $taoRequest;

    public function __construct($appkey, $appsecret) {
    	include "sdk/TopSdk.php";
    	date_default_timezone_set('Asia/Shanghai');

    	$this->taoClient = new TopClient;
    	$this->taoClient->appkey = $appkey;
    	$this->taoClient->secretKey = $appsecret; 
    	$this->taoRequest = new AlibabaAliqinFcSmsNumSendRequest;
    }

    public function sendSms($options) {
		$this->taoRequest->setSmsType( $options['smsType'] );
		$this->taoRequest->setSmsFreeSignName( $options['signName'] );
		$this->taoRequest->setSmsParam( "{\"code\":\"" . $this->veriCode()  . "\"}" );
		$this->taoRequest->setRecNum( $options['recNum'] );
		$this->taoRequest->setSmsTemplateCode( $options['templateCode'] );

		return (array) $this->taoClient->execute($this->taoRequest);
    }

    private function veriCode() {
    	return random_int(1000, 9999);
    }
}
?>