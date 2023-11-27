(function ($) {
	'use strict';
	var startRow = 1;
	var statusBarWrapper = $('.statusBar-wrapper');
	var statusBar = $('.statusBar');
	var import_results = $('#import-results');
	var package_importer_form = $('#package-importer-form');
	var cashback_importer_form = $('#cashback-importer-form');
	var batchSize = 100;
	var history = 0;

	// Nhập gói cước từ file excel
	cashback_importer_form.submit(function (e) {
		e.preventDefault();
		var fileInput = $('#file');
		var formData = new FormData($(this)[0]);

		formData.append('action', 'cashback_importer');
		formData.append('start_row', startRow);

		if (fileInput[0].files.length === 0) {
			alert('Vui lòng chọn tệp Excel để import');
		} else {
			package_importer(formData);
		}

		return false;
	});

	function cashback_importer(formData) {
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework_admin.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				statusBarWrapper.show();
			},
			success: function (response) {
				console.log(response);
				var status = response.data.status;
				var end_row = response.data.end_row;
				import_results.html('Đã nhập được ' + end_row + ' sim');

				if (status === "continue") {
					startRow += batchSize;
					cashback_importer_form.submit();
				} else {
					import_results.html('Đã hoàn thành!');
					statusBar.addClass('done');
					statusBarWrapper.hide();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				statusBarWrapper.hide();
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});

		return false;
	}

	// Nhập gói cước từ file excel
	package_importer_form.submit(function (e) {
		e.preventDefault();
		var fileInput = $('#file');
		var formData = new FormData($(this)[0]);

		formData.append('action', 'package_importer');
		formData.append('start_row', startRow);
		formData.append('history', history);

		if (fileInput[0].files.length === 0) {
			alert('Vui lòng chọn tệp Excel để import');
		} else {
			package_importer(formData);
		}

		return false;
	});

	function package_importer(formData) {
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework_admin.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				statusBarWrapper.show();
			},
			success: function (response) {
				console.log(response);
				var status = response.data.status;
				var end_row = response.data.end_row;
				history = response.data.history;
				import_results.html('Đã nhập được ' + end_row + ' sim');

				if (status === "continue") {
					startRow += batchSize;
					package_importer_form.submit();
				} else {
					import_results.html('Đã hoàn thành!');
					statusBar.addClass('done');
					statusBarWrapper.hide();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				statusBarWrapper.hide();
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});

		return false;
	}

	// Xoá sản phẩm
	$('.delete-by-history').on('click', function (e) {
		e.preventDefault();
		var history_id = $(this).attr('data-history');

		$.ajax({
			type: "post",
			dataType: "json",
			url: _n_framework_admin.admin_ajax_url,
			data: {
				action: "delete_by_history",
				history: history_id,
			},
			beforeSend: function () {

			},
			success: function (response) {
				var alert = confirm(response.data);
				if (alert === true) {
					window.location.reload();
				} else {
					window.location.reload();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});
		return false;
	});
})(jQuery);
