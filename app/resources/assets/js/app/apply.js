define(["jquery"], function($) {
	function reloadCaptcha() {
		$("#captcha").attr("src", "tools/captcha.php?r=" + Math.random());
	}

	function quantCastTag() {
		var _qevents = _qevents || [];
		var ele
	}
	return {
		reloadCaptcha: reloadCaptcha
	}
});