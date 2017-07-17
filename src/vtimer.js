<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>

/****
    + ::vtimer::
    + ::description::发送sms请求，并对“获取验证码”按钮进行禁用30秒倒计时
    + =tech=禁用 prop('disabled', 'disabled');
    + =tech=启用 removeAttr('disabled');
    + =tech=请求发送sms $.get(sms_url, callback);
    + =tech=启动方法： vtimer.monitor(element, sms_url, callback);
*/ 

var vtimer = {
	count: 30,
	resetCount: function() {
		vtimer.count = 30;
	},
	resetBtnStatus: function(btn) {
		vtimer.resetCount();
		btn.removeAttr('disabled');
		btn.html('重新获取验证码');
	},
	continueTimer: function(btn) {
		btn.html(vtimer.count-- + '秒');
		vtimer.init(btn);	
	},
	init: function(btn) {
		window.setTimeout(function(){
			if(vtimer.count > 0) {
				vtimer.continueTimer(btn);
			}else{
				vtimer.resetBtnStatus(btn);
			}
		}, 1000);
	},
	monitor: function(el, sms_url, callback) {
		$(el).on('click',function(){
			var _self=$(this);
			vtimer.init(_self);
			_self.prop('disabled','disabled');
			_self.html(vtimer.count-- +'秒');
			// $.get(sms_url, callback);
		});
	}
};
vtimer.monitor('#getVeriCode','/smsdemo.php',function(data){

});