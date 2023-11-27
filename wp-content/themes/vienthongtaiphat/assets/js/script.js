(function ($) {
	'use strict';
	var removeMenuClass = true;
	var loader = $('.theme-loader-wrapper');
	var package_search_form = $('.package-search-form');
	var advanced_search_form = $('.advanced-search-form');
	var message_wrapper = $('.message-wrapper');
	var message_content = $('.message-content');
	var page = 1;
	var registerModal = new bootstrap.Modal(document.getElementById("registerPackageModal"), {});
	var registerOTPModal = new bootstrap.Modal(document.getElementById("registerPackageOTPModal"), {});
	var confirmOTPModal = new bootstrap.Modal(document.getElementById("confirmPackageOTPModal"), {});

	$("html").on('click', function () {
		if (removeMenuClass) {
			$('#navigation-menu').slicknav('close');
		}

		removeMenuClass = true;
	});

	$('#navigation-menu').slicknav({
		label: "",
		prependTo: '#navigation-mobile-menu',
		closedSymbol: '',
		openedSymbol: ''
	});

	$('#toggle-mobile-menu-button').on('click', function () {
		$('#navigation-menu').slicknav('toggle');
		removeMenuClass = false;
	});

	$('#navigation-mobile-menu').on('click', function () {
		removeMenuClass = false;
	});

	// Slider
	$('.primary-slick-slider').slick({
		infinite: true,
		arrows: false,
		adaptiveHeight: true,
		autoplay: true,
		autoplaySpeed: 5000,
	});

	$("#back-to-top").click(function () {
		$("html, body").animate({scrollTop: 0}, 300);
	});

	advanced_search_form.submit(function (e) {
		var formData = new FormData($(this)[0]);
		formData.append('action', 'advanced_search');

		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework.admin_ajax_url,
			data: formData,
			beforeSend: function () {
			},
			success: function (response) {
			},
			error: function (jqXHR, textStatus, errorThrown) {
			}
		});
	});

	package_search_form.submit(function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('action', 'package_search');
		formData.append('page', page);

		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				loader.show();
			},
			success: function (response) {
				if (response.success && typeof response.data !== 'undefined') {
					var items = response.data.items;
					var pageList = response.data.data.pageList;
					var pageNumber = response.data.data.pageNumber;

					$('.packages-wrapper').html('');

					$.each(items, function (index, val) {
						var data = {
							package: val.pckCode,
							syntax: _n_framework.register_syntax + ' ' + val.pckCode,
							send: _n_framework.register_send,
							price: numberFormat(val.amount) + 'đ/' + val.numExpired + ' ngày',
							detail: val.packDetail,
						};
						$('.packages-wrapper').append(renderPackageItem(data));
					});

					$('.package-page-list').html('');

					$.each(pageList, function (index, val) {
						if (pageNumber === val) {
							$('.package-page-list').append("<li data-page='" + val + "' class='current'>" + val + "</li>");
						} else {
							$('.package-page-list').append("<li data-page='" + val + "'>" + val + "</li>");
						}
					});
				}
				loader.hide();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				// console.log('The following error occured: ' + textStatus, errorThrown);
				loader.hide();
			}
		});

		return false;
	});

	$(document).on("click", ".package-page-list li", function () {
		page = $(this).attr('data-page');
		package_search_form.submit();
	});

	var packageRecommend = $('.packages-recommend-wrapper');
	var packageRecommendSlick1 = $('.package-recommend-slick-slider-1');
	var packageRecommendSlick2 = $('.package-recommend-slick-slider-2');

	$('.register-package-otp-form').submit(function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('action', 'register_package_otp');

		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				loader.show();
			},
			success: function (response) {
				console.log(response);
				if (response.success) {
					if (response.data.response.success) {
						$('#confirmPackageOTPModal input[name=package-name]').val(response.data.package);
						$('#confirmPackageOTPModal input[name=username]').val(response.data.response.username);
						$('#confirmPackageOTPModal input[name=phone-number]').val(response.data.phone);

						registerOTPModal.hide();
						confirmOTPModal.show();
					} else {
						var items = response.data.recommend.data.items;

						packageRecommendSlick1.html('');
						// console.log(items);
						$.each(items, function (index, val) {
							var data = {
								package: val.packCode,
								syntax: _n_framework.register_syntax + ' ' + val.packCode,
								send: _n_framework.register_send,
								price: numberFormat(val.amount) + 'đ/' + val.numExpired + ' ngày',
								detail: val.packDetail,
							};

							packageRecommendSlick1.append(renderPackageRecommendItem(data));
						});

						message_wrapper.show();
						message_content.html(response.data.response.message);

						packageRecommendSlick1.slick({
							dots: true,
							arrows: true,
							infinite: true,
							speed: 300,
							slidesToShow: 2,
							slidesToScroll: 1,
							adaptiveHeight: true,
							autoplay: true,
							autoplaySpeed: 2000,
							responsive: [
								{
									breakpoint: 992,
									settings: {
										slidesToShow: 1,
									}
								},
							]
						});

						packageRecommend.show();
						packageRecommendSlick1.slick('setPosition');
					}
				} else {
					message_wrapper.show();
					message_content.html(response.data);
					registerOTPModal.hide();
				}

				loader.hide();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				// console.log('The following error occured: ' + textStatus, errorThrown);
				loader.hide();
			}
		});

		return false;
	});

	$('.confirm-package-otp-form').on("submit", function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('action', 'confirm_package_otp');

		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				loader.show();
			},
			success: function (response) {
				console.log(response);

				if (typeof response.data.recommend && response.data.recommend.length > 0) {
					var items = response.data.recommend.data.items;
					packageRecommendSlick2.html('');

					$.each(items, function (index, val) {
						var data = {
							package: val.packCode,
							syntax: _n_framework.register_syntax + ' ' + val.packCode,
							send: _n_framework.register_send,
							price: numberFormat(val.amount) + 'đ/' + val.numExpired + ' ngày',
							detail: val.packDetail,
						};

						packageRecommendSlick2.append(renderPackageRecommendItem(data));
					});

					packageRecommendSlick2.slick({
						dots: true,
						arrows: true,
						infinite: true,
						speed: 300,
						slidesToShow: 2,
						slidesToScroll: 1,
						adaptiveHeight: true,
						autoplay: true,
						autoplaySpeed: 2000,
						responsive: [
							{
								breakpoint: 992,
								settings: {
									slidesToShow: 1,
								}
							},
						]
					});

					packageRecommend.show();
					packageRecommendSlick2.slick('setPosition');
				}

				loader.hide();
				message_wrapper.show();
				message_content.html(response.data.data.message);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				// console.log('The following error occured: ' + textStatus, errorThrown);
				loader.hide();
			}
		});

		return false;
	});

	const registerPackageOTPModalEl = document.getElementById('registerPackageOTPModal')
	registerPackageOTPModalEl.addEventListener('hidden.bs.modal', event => {
		if (packageRecommendSlick1.hasClass('slick-slider')) {
			packageRecommendSlick1.slick('unslick');
		}

		message_wrapper.hide();
		message_content.html("");
	});

	const confirmPackageOTPModalEl = document.getElementById('confirmPackageOTPModal')
	confirmPackageOTPModalEl.addEventListener('hidden.bs.modal', event => {
		if (packageRecommendSlick2.hasClass('slick-slider')) {
			packageRecommendSlick2.slick('unslick');
		}

		message_wrapper.hide();
		message_content.html("");
	});

	$('.single-package-sms-btn-desktop').on('click', function () {
		var syntax = $(this).attr('data-package-syntax');
		var send = $(this).attr('data-package-send');
		var package_syntax_el = $('#registerPackageModal #package-syntax');
		var package_send_el = $('#registerPackageModal #package-send');

		package_syntax_el.html(syntax);
		package_send_el.html(send);
		registerModal.show();
	});

	$(document).on("click", ".register-package-desktop", function () {
		var package_item = $(this).closest('.package-item');
		var syntax = package_item.attr('data-package-syntax');
		var send = package_item.attr('data-package-send');
		var package_syntax_el = $('#registerPackageModal #package-syntax');
		var package_send_el = $('#registerPackageModal #package-send');

		package_syntax_el.html(syntax);
		package_send_el.html(send);
		registerModal.show();
	});

	$('.single-package-otp-btn').on('click', function () {
		var name = $(this).attr('data-package-name');

		$('#registerPackageOTPModal input[name=package-name]').val(name);
		packageRecommend.hide();
		registerOTPModal.show();
	});

	$(document).on("click", ".register-package-otp", function () {
		var package_item = $(this).closest('.package-item');
		var name = package_item.attr('data-package-name');

		$('#registerPackageOTPModal input[name=package-name]').val(name);
		packageRecommend.hide();
		registerOTPModal.show();
	});

	$('#price-filter').each(function () {
		var $filter_selector = $(this);
		var a = $filter_selector.data("min-value");
		$filter_selector.slider({
			range: 'min',
			min: $filter_selector.data("min"),
			max: $filter_selector.data("max"),
			step: 1,
			value: a,
			slide: function (event, ui) {
				$("#price").val(ui.value);
			}
		});
	});

	// Định dạng số
	function numberFormat(number, decimals = 0, decimalSeparator = '.', thousandSeparator = '.') {
		var parts = number.toFixed(decimals).split('.')
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandSeparator)
		return parts.join(decimalSeparator)
	}

	// Tạo package html
	function renderPackageItem(data) {
		return $([
			'<div class="col-md-6">',
			'<div class="package-item" data-package-name="' + data['package'] + '" data-package-syntax="' + data['syntax'] + '" data-package-send="' + data['send'] + '">',
			'<div class="package-header">',
			'<h4 class="package-name">' + data['package'] + '</h4>',
			'</div>',
			'<div class="package-body">',
			'<div class="package-content">',
			'<div class="label">Giá gói</div>',
			'<div class="content">' + data['price'] + '</div>',
			'</div>',
			'<div class="package-content">',
			'<div class="label">Cú pháp</div>',
			'<div class="content">',
			'<strong>' + data['syntax'] + '</strong> gửi <strong>' + data['send'] + '</strong>',
			'</div>',
			'</div>',
			'<div class="package-content">',
			'<div class="label">Ưu đãi</div>',
			'<div class="content">' + data['detail'] + '</div>',
			'</div>',
			'</div>',
			'<div class="package-footer">',
			'<div class="row">',
			'<div class="col-6">',
			'<a href="sms:' + data['send'] + '&body=' + data['syntax'] + '" class="register-package-mobile package-btn-solid">ĐK qua tin nhắn</a>',
			'<a href="javascript:;" class="register-package-desktop package-btn-solid">ĐK qua tin nhắn</a>',
			'</div>',
			'<div class="col-6">',
			'<a href="javascript:;" class="register-package-otp package-btn-solid">Đăng ký nhanh</a>',
			'</div>',
			'</div>',
			'</div>',
			'</div>',
			'</div>'
		].join("\n"));
	}

	// Tạo package html
	function renderPackageRecommendItem(data) {
		return $([
			'<div class="package-recommend-slick-item">',
			'<div class="package-item" data-package-name="' + data['package'] + '" data-package-syntax="' + data['syntax'] + '" data-package-send="' + data['send'] + '">',
			'<div class="package-header">',
			'<h4 class="package-name">' + data['package'] + '</h4>',
			'</div>',
			'<div class="package-body">',
			'<div class="package-content">',
			'<div class="label">Giá gói</div>',
			'<div class="content">' + data['price'] + '</div>',
			'</div>',
			'<div class="package-content">',
			'<div class="label">Cú pháp</div>',
			'<div class="content">',
			'<strong>' + data['syntax'] + '</strong> gửi <strong>' + data['send'] + '</strong>',
			'</div>',
			'</div>',
			'<div class="package-content">',
			'<div class="label">Ưu đãi</div>',
			'<div class="content">' + data['detail'] + '</div>',
			'</div>',
			'</div>',
			'<div class="package-footer">',
			'<div class="row">',
			'<div class="col-md-6">',
			'<a href="javascript:;" class="register-package package-btn-solid">ĐK qua tin nhắn</a>',
			'</div>',
			'<div class="col-md-6">',
			'<a href="javascript:;" class="register-package-otp package-btn-solid">Đăng ký nhanh</a>',
			'</div>',
			'</div>',
			'</div>',
			'</div>',
			'</div>'
		].join("\n"));
	}

	$('.packages-related').slick({
		dots: true,
		infinite: false,
		speed: 300,
		slidesToShow: 2,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
				}
			},
		]
	});
})(jQuery);
