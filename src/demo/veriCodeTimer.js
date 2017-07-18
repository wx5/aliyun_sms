<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>

/****
    + ::veriCodeTimer::
    + ::description::发送sms请求，并对“获取验证码”按钮进行禁用30秒倒计时
    + =tech=禁用 prop('disabled', 'disabled');
    + =tech=启用 removeAttr('disabled');
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
		veriCodeTimer.setTimer(btn);	
	},
	setTimer: function(btn) {
		window.setTimeout(function(){
			if(veriCodeTimer.count > 0) {
				veriCodeTimer.continueTimer(btn);
			}else{
				veriCodeTimer.resetBtnStatus(btn);
			}
		}, 1000);
	},
	init: function(btn) {
		veriCodeTimer.setTimer(btn);
		btn.prop('disabled','disabled');
		btn.html(veriCodeTimer.count-- +'秒');            
	},
	monitor: function(el) {
		$(el).on('click',function(){
			var _self=$(this);
			veriCodeTimer.setTimer(_self);
			_self.prop('disabled','disabled');
			_self.html(veriCodeTimer.count-- +'秒');
		});
	},
};

veriCodeTimer.monitor('#getVeriCode');
// send sms ...