"use strit";

require.config({
	paths: {
		jquery: "/libs/jquery-1.11.3.min.js"
	},

	require(["app"], function(app) {
		app.init();
	});
});