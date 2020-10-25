(function () {
	"use strict";

	// show password
	$('.show-password').click(function () {
		$(this).siblings('span').toggleClass('hidden');
		$(this).siblings('small').toggleClass('hidden');
		$(this).children('i').toggleClass('fa-eye fa-eye-slash text-warning text-success');
	});

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		console.log('ss');
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

	//inits
    $('[title]').tooltip();
    $('[data-toggle="popover"]').popover();
    $('[data-content]').popover({
		placement : 'top',
		html : true,
		trigger : 'hover'
	});
	// $('.pdp').persianDatepicker();
	$('.select2').select2({
       width: '100%',
    });

	// disappear
	$('#contact-type').change(function () {
		var val = $(this).val();
		if (val == 'public') {
			$('#city').parents('.form-group').hide();
		}else {
			$('#city').parents('.form-group').show();
		}
	});

	// select all
	$(".select-all").click(function(){
		var id = $(this).data('id');
		$("#"+id+" > option").prop("selected","selected");// Select All Options
		$("#"+id+"").trigger("change");// Trigger change to select 2
	});

	//are-you-sures
	$('.delete, .danger').click(function(){
		var target = $(this).parents('form');
		swal({
			title: "آیا مطمئن هستید؟",
			text: "شما دیگر قادر به باز گردانی آن نخواهید بود!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "بله. پاک شود.",
			cancelButtonText: "لغو",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function(isConfirm) {
			if (isConfirm) {
				target.submit();
			} else {
				swal("عملیات لغو شد.", "اطلاعاتی پاک نشد", "error");
			}
		});
	});

	// change-pass
	$('.change-pass').click(function(){
		var target = $(this).parents('form');
		swal({
			title: "آیا مطمئن هستید؟",
			text: "با ریست کردن، رمزعبور شخص کدملی او میشود.",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "بله",
			cancelButtonText: "لغو",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function(isConfirm) {
			if (isConfirm) {
				target.submit();
			} else {
				swal("عملیات لغو شد.", "رمزعبور ریست نشد.", "error");
			}
		});
	});

	// data table
	$('.data-table').DataTable({
		language: {
			processing: "درحال پردازش...",
			search: "جستجو :",
			lengthMenu: " تعدا آیتم ها در هر صفحه _MENU_",
			info: "نمایش _START_ تا _END_ از _TOTAL_ آیتم",
			infoEmpty: "0 آیتم یافت شد.",
			infoFiltered: "(کل آیتم ها : _MAX_ )",
			infoPostFix: "",
			loadingRecords: "در حال بارگذاری...",
			zeroRecords: "موردی یافت نشد",
			emptyTable: "داده ای در جدول وجود ندارد",
			paginate: {
				first: "ابتدا",
				previous: "قبلی",
				next: "بعدی",
				last: "انتها"
			},
			aria: {
				sortAscending: ": چینش به صورت صعودی",
				sortDescending: ": چینش به صورت نزولی"
			}
		}
	});

})();
