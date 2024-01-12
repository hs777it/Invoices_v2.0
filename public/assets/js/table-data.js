$(function (e) {

	$('#button').click(function () {
		table.row('.selected').remove().draw(false);
	});

	//file export datatable
	var table = $('#example').DataTable({
		responsive: true,
		lengthChange: true,
		// buttons: ['excel', 'pdf'],
		language: {
			searchPlaceholder: 'بحث ...',
			sSearch: '',
			lengthMenu: '_MENU_ ',
		},
		lengthMenu: [
			[10, 25, 50, 100, 200, - 1],
			[10, 25, 50, 100, 200, 'الكل']
		]
	});

	table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');

	$('#example1').DataTable({
		responsive: false,
		lengthChange: true,
		language: {
			searchPlaceholder: 'بحث ...',
			sSearch: '',
			lengthMenu: '_MENU_ ',
		},
		lengthMenu: [
			[10, 25, 50, 100, 200, - 1],
			[10, 25, 50, 100, 200, 'الكل']
		]
	});





	//Details display datatable
	$('#example-1').DataTable({
		language: {
			searchPlaceholder: 'بحث ...',
			sSearch: '',
			lengthMenu: '_MENU_',
		},
		lengthMenu: [
			[10, 25, 50, 100, 200, - 1],
			[10, 25, 50, 100, 200, 'الكل']
		],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function (row) {
						var data = row.data();
						return 'Details for ' + data[0] + ' ' + data[1];
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: 'table border mb-0'
				})
			}
		}
	});

	var table = $('#example-delete').DataTable({
		responsive: true,
		language: {
			searchPlaceholder: 'بحث ...',
			sSearch: '',
			lengthMenu: '_MENU_',
		},
		lengthMenu: [
			[10, 25, 50, 100, 200, - 1],
			[10, 25, 50, 100, 200, 'الكل']
		]
	});
	$('#example-delete tbody').on('click', 'tr', function () {
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
});