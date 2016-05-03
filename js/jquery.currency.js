!function($, w, d, undefined) {
	'use strict';
	var name = 'currency';
	var version = '0.1';

	$.currency = {interface:{},isocode:{}};

	var Currency = function($element, options) {
		this.element = $element;
		this.options = $.extend({}, $.fn[name].defaults, options);

		this.iso = $.currency.isocode[this.options.locale];
		this.t = $.currency.interface[this.options.locale];

		this._createWidgetSkeleton();

		this.loadingEl = this.element.find('.'+ name + '-loading');
		this.backEl = this.element.find('.'+ name + '-back');
		this.frontEl = this.element.find('.'+ name + '-front');
		this.errEl = this.element.find('.'+ name +'-error-container');

		this.loadingImgEl = this.element.find('.'+ name +'-loading-gif');
		this.resultFromEl = this.element.find('.'+ name +'-result-from');
		this.resultToEl = this.element.find('.'+ name +'-result-to');
		this.compare1El = this.element.find('.'+ name +'-result-compare1');
		this.compare2El = this.element.find('.'+ name +'-result-compare2');

		this.formEl = this.element.find('.'+ name + '-form');
		this.quantityEl = this.element.find('.'+ name + '-quantity');
		this.fromList = this.element.find('.'+ name + '-from');
		this.toList = this.element.find('.'+ name + '-to');

		this.convertBtn = this.element.find('.'+ name + '-convertBtn');
		this.backBtn = this.element.find('.'+ name +'-backBtn');

		this._createCurrencyList(this.fromList, this.options.from, this.options.fromPopular);
		this._createCurrencyList(this.toList, this.options.to, this.options.toPopular);

		this._addListeners();
		this.init();
	};

	$.extend(true, Currency.prototype = {
		init: function() {
			this._validate();
		},
		
		_addListeners: function() {
			this.convertBtn.on({
				click: $.proxy(this._getCurrencyRate, this)
			});

			this.backBtn.on({
				click: $.proxy(this._goBackToFront, this)
			});

			this.formEl.on({
				change: $.proxy(this._validate, this),
				keyup: $.proxy(this._validate, this)
			});
		},

		_removeListeners: function() {
			this.convertBtn.off({
				click: this._getCurrencyRate
			});

			this.backBtn.off({
				click: this._goBackToFront
			});

			this.formEl.off({
				change:this._validate,
				keyup:this._validate
			});
		},
		
		_formatLocalProviderUrl: function() {
			var params = "from={From}&to={To}",
					url = this.options.localRateProvider,
					separator = "?";
			if(url.indexOf("?") != -1) {
				separator = "&";
			}
			return url + separator + params;
		},
		
		_getCallbackType: function() {
			return this._isLocalServer() ? "JSON" : "JSONP";
		},
		
		_isLocalServer: function() {
			return this.options.localRateProvider ? true : false;
		},
		
		_getCurrencyProviderUrl: function() {
			var providers = {
						rateExchange : 'http://rate-exchange.appspot.com/currency?from={From}&to={To}',
						php5dev : 'http://currency-converter.php5developer.com/api.php?from={From}&to={To}'
					},
					provider;
			
			//this.options.rateProvider = 'php5dev';
			if(this._isLocalServer()) {
				provider = this._formatLocalProviderUrl();
			} else {
				provider = providers[this.options.rateProvider] || providers.rateExchange;
			}
			
			var params = {
				'{From}' : this.from,
				'{To}' : this.to
			};
			for (var i in params) {
				provider = provider.replace(i, params[i]);
			}
			return provider;
		},
		
		_getCurrencyRate: function() {
			//var url = 'http://rate-exchange.appspot.com/currency?from='+ this.from + '&to=' + this.to;
			//var url = 'http://currency-converter.php5developer.com/api.php?from='+ this.from + '&to=' + this.to;
			var url = this._getCurrencyProviderUrl(),
                      self = this;
			$.ajax({
				type: "GET",
				url: url,
                timeout: 7000,
				dataType: this._getCallbackType(),
				beforeSend: this._currencyLoading(self),
				success: this._currencyResponse(self),
                error: function (jqXHR, textStatus, errorThrown) {
                    self._currencyResponseError(self);
                }
			});
			return false;
		},

		_currencyResponseError: function(widget) {
			widget.frontEl.hide();
			widget.backEl.hide();
			widget.loadingEl.hide();
			widget.errEl.show();
		},

		_currencyLoading: function(widget) {
			widget.frontEl.hide();
			widget.backEl.hide();
			widget.errEl.hide();
			widget.loadingEl.show();
		},

		_currencyResponse: function(widget) {
			return function(json) {
				if(!json || typeof(json.err) != "undefined") {
					return widget._currencyResponseError(widget);
				}
				widget.frontEl.hide();
				widget.loadingEl.hide();
				widget.errEl.hide();
				widget.backEl.show();
				var revrate = 1/json.rate,
						to = (widget.quantity * json.rate).toFixed(widget.options.decimals),
						compare1 = (1 * json.rate).toFixed(widget.options.decimals),
						compare2 = (1 * revrate).toFixed(widget.options.decimals);
				widget.resultFromEl.html(widget.quantity + ' ' + json.from);
				widget.resultToEl.html(to + ' ' + json.to);
				widget.compare1El.html(1 + ' ' + json.from + ' ' + widget.t.equals2 + ' ' + compare1 + ' ' + json.to);
				widget.compare2El.html(1 + ' ' + json.to + ' ' + widget.t.equals2 + ' ' + compare2 + ' ' + json.from);
			}
		},

		_validate: function() {
			this._setFormVariables();
			this.from != this.to && this.quantity > 0 ? this.convertBtn.attr("disabled", false) : this.convertBtn.attr("disabled", true);
		},

		_setFormVariables: function() {
			this.from = this.fromList.find('option:selected').attr("value"),
			this.to = this.toList.find('option:selected').attr("value"),
			this.quantity = parseFloat(this.quantityEl.val()) || 0.00;
		},

		_goBackToFront: function() {
			this.backEl.hide();
			this.loadingEl.hide();
			this.errEl.hide();
			this.frontEl.show();
			return false;
		},

		_createWidgetSkeleton: function() {
			this.element.html("\n"+
				'<div class="'+ name +'-wrapper">' + "\n" +
				'<p class="'+ name +'-header">'+ this.t.title +'</p>' + "\n" +
				'<div class="'+ name +'-content">' + "\n" +
				'<div class="'+ name +'-error-container" style="display:none">' + "\n" +
				'<span class="'+ name +'-error">'+ this.t.err +'</span>'+ "\n" +
				'<button class="'+ name +'-backBtn">'+ this.t.backBtn +'</button>' + "\n" +
				'</div><!-- End of '+ name + '-error-container -->' + "\n" +
				'<div class="'+ name +'-loading" style="display:none;">' + "\n" +
				'<span class="'+ name +'-loading-phrase">'+ this.t.loading +'</span>' + "\n" +
				(this.options.loadingImage == false ? '' :
				'<img src="'+ this.options.loadingImage +'" class="'+ name +'-loading-gif" width="25" height="25" />') + "\n" +
				'</div><!-- End of '+ name +'-loading -->' + "\n" +
				'<div class="'+ name +'-back" style="display:none;">' + "\n" +
				'<table class="'+ name +'-back-table">' + "\n" +
				'<tbody>' + "\n" +
				'<tr>' + "\n" +
				'<td colspan="3" class="'+ name +'-result-from" style="color:#000;"></td>' + "\n" +
				'</tr>' + "\n" +
				'<tr>' + "\n" +
				'<td colspan="3" class="'+ name +'-equals" style="color:#000;">'+ this.t.equals1 +'</td>' + "\n" +
				'</tr>' + "\n" +
				'<tr>' + "\n" +
				'<td colspan="3" class="'+ name +'-result-to" style="color:#000;"></td>' + "\n" +
				'</tr>' + "\n" +
				'<tr>' + "\n" +
				'<td class="'+ name +'-result-compare1" style="color:#000;"></td>' + "\n" +
				'<td class="'+ name +'-back-gap" style="color:#000;"></td>' + "\n" +
				'<td class="'+ name +'-result-compare2" style="color:#000;"></td>' + "\n" +
				'</tr>' + "\n" +
				'</tbody>' + "\n" +
				'</table>' + "\n" +
				'<button class="'+ name +'-backBtn">'+ this.t.backBtn +'</button>' + "\n" +
				'</div><!-- End of '+ name +'-back -->' + "\n" +
				'<div class="'+ name +'-front"><p style="margin-bottom:3px; text-align:center; display:none;" id="price_container">Course Fee: <strong id="price">2000</strong>. Enter fee to convert</p><p style="margin-bottom:3px; text-align:center; display:none; color:#000;" id="price_advert">Advert Rate: <strong id="price_rate">2000</strong>. Enter rate to convert</p><p style="margin-bottom:3px; text-align:center; display:none;" id="price_premium">Price: <strong id="price_pre">2000</strong>. Enter price to convert</p>' + "\n" +
				'<form class="'+ name +'-form">' + "\n" +
				'<input type="text" class="'+ name +'-quantity" name="'+ name +'-quantity" value="'+ this.options.quantity +'" placeholder="'+ this.options.placeholder +'" />' + "\n" +
				'<span class="'+ name +'-from-label">'+ this.t.from +'</span>' + "\n" +
				'<select class="'+ name +'-from" name="'+ name +'-from"></select>' + "\n" +
				'<span class="'+ name +'-to-label">'+ this.t.to +'</span>' + "\n" +
				'<select class="'+ name +'-to" name="'+ name +'-to"></select>' + "\n" +
				'<button name="'+ name +'-convert" class="'+ name +'-convertBtn">'+ this.t.convert +'</button>' + "\n" +
				'</form>' + "\n" +
				'</div><!-- End of '+ name +'-front -->' + "\n" +
				'</div><!-- End of '+ name +'-content -->' + "\n" +
				(this.options.copyright === true ?
				'<div class="'+ name +'-footer"><a href="javascript:void(0);" onclick="Close()">Close Converter</a></div>'
				: '')  + "\n" +
				'</div><!-- End of '+ name +'-wrapper -->' + "\n"
			);
		},

		_createCurrencyList: function(list, selected, popular) {
			var p = popular.length;
			if(p > 0) {
				for(var i = 0; i < p; i++) {
					list.append('<option ' + (selected == popular[i] ? 'selected' : '') +' value="' + popular[i] + '">'+ this.iso[popular[i]] +'</option>');
				}
				list.append('<option disabled>'+ this.options.separator +'</option>');
			}
			$.each(this.iso, function(key, val){
				if($.inArray(key, popular) == -1) {
					list.append('<option '+ (selected == key ? 'selected' : '') +' value="' + key + '">'+ val +'</option>');
				}
			});
		},
		
		destroy: function() {
			this.element.unwrap().removeData(name);
			this._removeListeners();
			this.element.find("*").remove();
		}
	});

	$.fn[name] = function(option) {
		var args = Array.prototype.slice.call(arguments, 1);
		return this.each(function () {
			var $this = $(this),
					data = $this.data(name),
					options = typeof option == 'object' && option;
            if (!data) $this.data(name, (data = new Currency($this, options)));
            if(typeof option == 'string') {
			  data[option].apply(data, args);
			}
		});
	};

	$.fn[name].defaults = {
		locale: 'en_US',
		copyright: true,
		quantity: 100,
		placeholder: '',
		from: 'USD',
		to: 'EUR',
		fromPopular: [],
		toPopular: [],
		loadingImage: 'images/img/loader.gif',
		rateProvider: 'rateExchange',
		localRateProvider: null,
		decimals: 4,
		separator: '-----------------------------'
	};

}(jQuery, window, document);