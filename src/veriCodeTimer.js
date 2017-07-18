<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>

/****
    + ::veriCodeTimer::
    + ::description::发送sms请求，并对“获取验证码”按钮进行禁用30秒倒计时
    + =tech=禁用 prop('disabled', 'disabled');
    + =tech=启用 removeAttr('disabled');
    + =tech=请求发送sms $.get(sms_url, callback);
    + =tech=启动方法： vtimer.monitor(element, sms_url, callback);
*/ 

var veriCodeTimer = {
	count: 30,
	resetCount: function() {
		veriCodeTimer.count = 30;
	},
	resetBtnStatus: function(btn) {
		veriCodeTimer.resetCount();
		btn.removeAttr('disabled');
		btn.html('重新获取验证码');
	},
	continueTimer: function(btn) {
		btn.html(veriCodeTimer.count-- + '秒');
		veriCodeTimer.init(btn);	
	},
	init: function(btn) {
		window.setTimeout(function(){
			if(veriCodeTimer.count > 0) {
				veriCodeTimer.continueTimer(btn);
			}else{
				veriCodeTimer.resetBtnStatus(btn);
			}
		}, 1000);
	},
	monitor: function(el, sms_url, callback) {
		$(el).on('click',function(){
			var _self=$(this);
			veriCodeTimer.init(_self);
			_self.prop('disabled','disabled');
			_self.html(veriCodeTimer.count-- +'秒');
			// $.get(sms_url, callback);
		});
	}
};
veriCodeTimer.monitor('#getVeriCode','/smsdemo.php',function(data){

});