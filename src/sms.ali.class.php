<?php

/**
 * dependency:: aliyun_sdk
 * updated:: 2017.07.17
 */

$CORE_PATH = 'aliyun_sdk/api_sdk/aliyun-php-sdk-core/';
$LIB_PATH = 'aliyun_sdk/api_sdk/Dysmsapi/Request/V20170525/';

include $CORE_PATH.'Config.php';
include_once $LIB_PATH.'SendSmsRequest.php';    

class AliSms {
    //短信API产品名
    protected $product = "Dysmsapi";
    //短信API产品域名
    protected $domain = "dysmsapi.aliyuncs.com";
    //暂时不支持多Region
    protected $region = "cn-hangzhou";

    protected $accessKeyId = '';
    protected $accessKeySecret = '';  

    public function __construct($accessKey, $accessKeySecret) {
        $this->accessKeyId = $accessKey;
        $this->accessKeySecret = $accessKeySecret;
    }

    protected function getProfile() {
        $profile = DefaultProfile::getProfile($this->region, $this->accessKeyId, $this->accessKeySecret);
        DefaultProfile::addEndpoint($this->region, $this->region, $this->product, $this->domain);             
   
        return $profile;   
    }

    protected function getClient() {
        return new DefaultAcsClient($this->getProfile());
    }

    protected function getRequest() {
        return new Dysmsapi\Request\V20170525\SendSmsRequest;
    }

    public function sendSms(array $options) {
        $request = $this->getRequest();
        //必填-短信接收号码
        $request->setPhoneNumbers($options['recNum']);
        //必填-短信签名
        $request->setSignName($options['signName']);
        //必填-短信模板Code
        $request->setTemplateCode($options['tplCode']);
        //选填-假如模板中存在变量需要替换则为必填(JSON格式)
        $request->setTemplateParam("{\"code\":\"".$options['veriCode']."\"}");
        //选填-发送短信流水号
        $request->setOutId($options['outId']);            

        try{
            //发起访问请求
            $resp = $this->getClient()->getAcsResponse($request);
            return $resp;        
        }catch(\Exception $e) {
            return 'api错误: '.$e->getMessage();
        }        
    }
}  
?>