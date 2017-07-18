<?php
    session_start();
    include 'sms.class.php';

    $accessKey = 'LTAI0vGysWdKWXmX';
    $accessSec = 'kNPemml39UunHXmx4Z8ZttPrghUh07';

    $options = array(
        'recNum' => '13859251427',
        'signName' => '国珍松花粉', // 参照阿里云后台：模板签名
        'tplCode' => 'SMS_77450035', // 参照阿里云后台：模板编码
        'veriCode' => random_int(100000, 999999),
        'outId' => '1234' // 可选
    );

    $resp = Alisms::setAccessKey($accessKey,$accessSec)->sendSms( $options );

    if($resp->Code && $resp->Code === 'OK') {
        $_SESSION['vericode'] = $options['veriCode'];
        echo '发送成功';
    }else{
        var_dump($resp);
    }           
?>