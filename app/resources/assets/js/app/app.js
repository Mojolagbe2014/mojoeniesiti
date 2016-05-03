define(["jquery", "apply"], function ($, apply) {
	"use strict";

	function  _reloadCaptcha(e) {
		e.preventDefault();
		apply.reloadCaptcha();
	}

	function _registerEventHandlers() {
		$(".refresh-captcha").on("click", _reloadCaptcha);
	}

	return {
		init: function() {
			_registerEventHandlers();
		}
	}
});
