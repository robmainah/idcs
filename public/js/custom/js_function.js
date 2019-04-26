
$('#fileForm').on('submit', function (e) {
   	e.preventDefault();

   	var form = document.getElementById('fileForm');
   	var formdata = new FormData(form);

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "post",
		url: "/files",
		data: formdata,
        contentType: false,
        processData: false,
		success: function(data) {
			console.log(data);
			if (data.errors) {
				$('.error').removeClass('hidden');
				if (data.errors == "exists") {
					//alert("error");
					$('.imageErr').text("File already exists");
				}
				else
				{
					//alert("no error");
					$('.imageErr').text("");
				}

				if (data.errors.uploadImage) {
					$('.imageErr').text(data.errors.uploadImage);
				}
				else
				{
					$('.imageErr').text("");
				}

				if (data.errors.description) {
					$('.descErr').text(data.errors.description);
				}
				else
				{
					$('.descErr').text("");
				}
			}
			else {
				$('#fileForm').trigger('reset');
				/*set preview image to empty*/
				$('#image_preview').html("");
				//set the message to be displayed.
				$('.alertMessage').html('New file added successfully');
				//call the display message function
				////displayAlertMessage();
				window.location.href="/files";
				$('.error').addClass('hidden');
			}
		}
	});
});

$('.fa-share-alt').click(function () {
	var file_id = sessionStorage.getItem('fileToShareId');
	if (file_id == null || file_id.length < 1) {
		return alert("Select file to send");
	}

	$('#modalFileShare').modal('show');

	$('.file_user_chkbx').prop('checked', false);
	sessionStorage.removeItem('selectedUsersToSend');
});

//edit file
$('#fileShare').on('click', function () {
	var select_user = sessionStorage.getItem('selectedUsersToSend');

	var file_id = sessionStorage.getItem('fileToShareId');

	if (select_user == null || select_user.length < 1 ) {
		return alert("Select a user to send the file");
	}

	var selected_user_arr = select_user.split(",");
	var file_id_arr = file_id.split(",");

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "post",
		url: "/files/send",
		data: {data : selected_user_arr, file:file_id_arr},
		cache:false,
		success: function(data) {
			$('.file_user_chkbx').prop('checked', false);
			$('.file_chkbx').prop('checked', false);
			$('#modalFileShare').fadeOut(1000);
			$('#modalFileShare').modal('hide');

			sessionStorage.removeItem('fileToShareId');
			sessionStorage.removeItem('selectedUsersToSend');
		}
	});
});

$('.fil-type').click(function () {
	var value = $(this).attr('id');

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "get",
		url: "/files/cat/" + value,
		data: {data : value},
		cache:false,
		success: function(data) {
			
		}
	});
});

//delete file
$('.file_delete').on('click', function () {
	/*
		var txt = $(this).parent().attr('id');
		alert(txt);
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "get",
			url: "/files/modify",
			data: {open:true,folder:txt},
			success: function(data) {

			}
		});
	*/
	var count = $('.fil_sel').find("input:checked").length;
	var id = [];
	/*if (count !== 1) {
		alert("Select just one row");
		$('.checkbox input[type="checkbox"]').prop('checked', false);
	}*/
	if(count === 0) //tell you if the array is empty
   	{
    	alert("Please Select atleast one checkbox");
   	}
	else
	{
		if (confirm("Are you sure you want to delete ?")) {
			// var file_id = $('.fil_td').find("input:checked").attr("id");
			// alert(file_id)
			// $('.file_chkbx:checked').each(function (i) {
			 	//var txt = $(this).closest('tr').attr('id');

			// 	var chil = $('ol#breadcrumb').children();
			// }
			$('.file_chkbx:checked').each(function () {
				var txt = $(this).closest('tr').attr('id');
				id.push(txt);
			});
			//==console.log(id);

			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type: 'delete',
				url: "files",
				data: {id:id},
				cache:false,
				success:function(data) {
					console.log(data)
					window.location.href="/files";
					$('.checkbox input[type="checkbox"]').prop('checked', false);
					//$('.file_Table').DataTable().ajax.reload();
				}
			});
		}
	}
});

//click to view main departments
$('.main_depart').on('click', function () {
	$('.main_depart_tbl').fadeIn('slow');
	$('.sub_depart_tbl').fadeOut('slow');
})
//click to view sub departments
$('.sub_depart').on('click', function () {
	$('.sub_depart_tbl').fadeIn();
	$('.main_depart_tbl').fadeOut();
})
//click to view sub departments
$('.all_depart').on('click', function () {
	$('.sub_depart_tbl').fadeIn();
	$('.main_depart_tbl').fadeIn();
})
//add new department
$('#saveDepartment').on('click', function () {

	var section = $('#saveDepartment').val();
	var action_type = $('#action_type').val();

	var formData = {
				'token' : $('input[name=_token').val(),
				'depart_name' : $('#depart_name').val(),
				'depart_hod' : $('#depart_hod').val(),
				'depart_section' : section,
				'depart_desc' : $('#depart_desc').val(),
			};
	var type = "post";

	if (section == "add-sub") {
		var my_Url = "/subDepartments";
		formData['mainDepart'] = $('#mainDepart').val();
	}

	if (section == "add-main") {
		var my_Url = "/departments";
	}

	if (action_type == "update") {
		var dep_id =  $('#dep_id').val();

		var type = "put";
		//var my_Url = "/departments/" + dep_id;
		if (section == "add-sub") {
			var my_Url = "/subDepartments/" + dep_id;
		}

		if (section == "add-main") {
			var my_Url = "/departments/" + dep_id;
		}

		formData['depart_id'] = $('#dep_id').val();
	}

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: type,
		url: my_Url,
		data : formData,
		success: function(data) {
			console.log(data);
			if (data.errors) {
				$('.error').removeClass('hidden');

				if (data.errors.depart_name) {
					$('.depart_name_error').text(data.errors.depart_name);
				}
				else
				{
					$('.depart_name_error').text("");
				}

				if (data.errors.mainDepart) {
					$('.mainDepartError').text(data.errors.mainDepart);
				}
				else
				{
					$('.mainDepartError').text("");
				}

				if (data.errors.depart_hod) {
					$('.depart_hod_error').text(data.errors.depart_hod);
				}
				else
				{
					$('.depart_hod_error').text("");
				}

				if (data.errors.depart_desc) {
					$('.depart_desc_error').text(data.errors.depart_desc);
				}
				else
				{
					$('.depart_desc_error').text("");
				}
			}
			else
			{
				$('#main_depart form').trigger('reset');
				$('.error').val('');
				$('#addDepartment').addClass('animated zoomOut');
				$('#addDepartment').modal('hide');
				setTimeout(function () {
					$('#addDepartment').removeClass('animated zoomOut');
				} , 2000);

				$('#addDepartment').modal('hide');

				//set the message to be displayed.
				$('.alertMessage').html('Department details updated successfully');
								//call the display message function

				//set the message to be displayed.
				$('.alertMessage').html('New department added successfully');
				//call the display message function
				////displayAlertMessage();
				setTimeout(function () {
					$('#addTask').removeClass('animated zoomOut');
					window.location.href="/departments";
				} , 4000);
				window.location.href="/departments";
			}
		}
	});
});
//edit department detailsss
$('.depart_edit').on('click', function () {
	var count = $('.fil_sel').find("input:checked").length;
	if (count !== 1) {
		alert("Select just one row");
		$('.fil_sel input[type="checkbox"]').prop('checked', false);
	}
	else
	{
		var td_id = $('.fil_sel').find("input:checked").attr("id");

		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'get',
			url: 'departments/' + td_id,
			data : {'department':td_id},
			cache:false,
			success:function(data) {
				$('.fil_sel input[type="checkbox"]').prop('checked', false);
				$('.proj').addClass('hidden');

				console.log(data);
				$('#depart_name').val(data.name);
				$('#depart_hod').val(data.hod_id);
				$('#dep_id').val(data.id);
				$('#depart_desc').val(data.description);

				$('#addDepartment').modal('show');
				// $('.modal-title').html("Edit Department details");
				$('#saveDepartment').html("Update department details");

				$('#action_type').val('update');
				// setTimeout(function () {
				// 	$('#addTask').removeClass('animated zoomOut');
				// 	window.location.href="/departments";
				// } , 4000);
			}
		});
	}
});

//delete file
$('.depart_delete').on('click', function () {
	var count = $('.fil_sel').find("input:checked").length;
	if (count !== 1) {
		alert("Select just one row");
		$('.fil_sel input[type="checkbox"]').prop('checked', false);
	}
	else
	{
		if (confirm("Are you sure you want to delete?")) {
			//var td_id = $('.fil_sel').find("input:checked").attr("id");
			//var td_id = $('.fil_sel input[type="checkbox"]').attr("id");
			var td_id = $('.chk_tb:checked').attr("id");
			//alert(td_id);
			//console.log(td_id);
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type: 'delete',
				url: 'departments/'+td_id,
				data: {id:td_id},
				cache:false,
				success:function(data) {
					$('.fil_sel input[type="checkbox"]').prop('checked', false);

					//console.log(data);

					$('.departments' + td_id).remove();

					//set the message to be displayed.
					$('.alertMessage').html('Deleted successfully');
					//call the display message function
					//displayAlertMessage();
					setTimeout(function () {
					$('#addTask').removeClass('animated zoomOut');
					window.location.href="/departments";
				} , 4000);
				window.location.href="/departments";
				}
			});
		}
	}
});

$('#saveTasks').on('click', function () {
	var action_type = $('#action_type').val();
	var mes = $('#meso').val();

	//alert(sessionStorage.getItem('usersId'));
	var formData = {
				//'task_subject' : $('#task_subject').val(),
				'task_members' : sessionStorage.getItem('usersId'),
				'task_desc' : $('#task_desc').val(),
			};
	var myUrl = "/tasks";

	if (mes == "messages") {
		var formData = {
				'send_to' : sessionStorage.getItem('usersId'),
				'desc' : $('#text').val(),
			};
		var myUrl = "/messages";
	}

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "post",
		url: myUrl,
		data : formData,
		success: function(data) {
			console.log(data);
			//sessionStorage.removeItem('usersId')
			if (data.errors) {
				$('.error').removeClass('hidden');

				if (data.errors.send_to) {
					$('.messageMembersError').text(data.errors.send_to);
				}
				else
				{
					$('.messageMembersError').text("");
				}

				if (data.errors.desc) {
					$('.message_text_error').text(data.errors.desc);
				}
				else
				{
					$('.message_text_error').text("");
				}

				if (data.errors.task_subject) {
					$('.task_subject_error').text(data.errors.task_subject);
				}
				else
				{
					$('.task_subject_error').text("");
				}

				if (data.errors.task_members) {
					$('.taskMembersError').text(data.errors.task_members);
				}
				else
				{
					$('.taskMembersError').text("");
				}

				if (data.errors.task_desc) {
					$('.task_desc_error').text(data.errors.task_desc);
				}
				else
				{
					$('.task_desc_error').text("");
				}
			}
			else
			{
				$('.tasksForm').trigger('reset');
				$('.error').val('');
				$('#addTask').addClass('animated zoomOut');
				//$('#addTask').modal('hide');

				$('#addTask').modal('hide');
				//set the message to be displayed.
				if (mes == "messages") {
					window.location.href="/messages";
					$('.alertMessage').html('Message sent successfully');
					//call the display message function
					//displayAlertMessage();
					//window.location.assign("/messages");
					sessionStorage.removeItem('usersId');
					setTimeout(function () {
						$('#addTask').removeClass('animated zoomOut');
					} , 4000);
				}
				else
				{
					window.location.href="/tasks";
					$('.alertMessage').html('New task added successfully');
					//call the display message function
					//displayAlertMessage();
					sessionStorage.removeItem('usersId');
					setTimeout(function () {
						$('#addTask').removeClass('animated zoomOut');
					} , 4000);
				}
			}
		}
	});
});
$('#filtMemByDept').change(function () {
	var dep_id = $(this).val();

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "get",
		url: "tasks/getUsers/" + dep_id,
		data : {dep:dep_id},
		success: function(data) {
			//console.log(data);
			$('.ta-new-emp').html('<span><strong>Name</strong></span>');
			var i =0;
			$.each(data.users, function (key, value) {
				// for(var i=0; i < data.users.length; i++)
				// {

					$('.ta-new-emp').append(
						'<li id="'+ data.users[i].id +'" onclick="selectLink(this)"><a><input class="task-check" type="checkbox"> <span>'+ data.users[i].name +'</span></a></li>'
					);
					i++;
				//}
			});
		}
	});
});

$('#select_members').click(function () {
	var id = 0;
	var data_user = "";
	var user_name = "";

	$('.task-check:checked').each(function (i) {
		var txt = $(this).closest('li').attr('id');
		var usersName = $(this).closest('li').find('span').text();

		data_user  = data_user + "," + txt;
		user_name  = user_name + "," + usersName;
		id += 1;
	});
	data_user = data_user.substring(1);
	user_name = user_name.substring(1);

	var arr_user = data_user.split(",");
	var user_name = user_name.split(",");

	if (user_name[0] !== "") {
		$('#task-disp-mem').html('');
		var i = 1
		$.each(user_name, function (key, value) {
			//var cont = '<li>' + value + '</li>';
			var userList = i + ". " + value + '\r \n';
			if (user_name.length > 4) {
				userList = i + ". " + value + '\r';
			}

			$('#task-disp-mem').append(userList);
			i = i + 1;		
		});
		sessionStorage.setItem('usersId', arr_user);
	}

	$('.task-check:checked').prop('checked', false);

	$('#project_add_members').modal('hide');
	//$('#task-disp-mem').html();
	//console.log(arr_user);
});

$('.ta-col a').click(function () {
	//$('.ta-col .collapse').collapse('hide');
	//$('.collapse').css('display', 'none');
	//$('.collapse').toggleClass('hidden');
	//$(this).find('.collapse').toggle();
	var url = "tasks/read/";

	

	var id = $(this).attr('id');
	//alert(id);
	if ($('.ta-col').hasClass('mes')) {
		url = "messages/read/";
		$(this).find('span').removeClass('ta-new');
	}

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "get",
		url: url + id,
		data : {task_id:id},
		success: function(data) {
			if (data.success == 1) {
			//	window.location.href="/tasks";
			}

		}
	});

});
$('.fa-ta-sta').on('click', function () {
	var complete = "";
	var id = $(this).parents().eq(3).attr('id');

	if ($(this).hasClass('fa-ta-sta-com')) {
		$(this).removeClass('fa-ta-sta-com, fa-check');
		$(this).addClass('fa-ta-sta-unco');

		complete = 0;
	}
	else
	{
		$(this).removeClass('fa-ta-sta-unco');
		$(this).addClass('fa-ta-sta-com, fa-check');

		complete = 1;
	}

	$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "put",
			url: "tasks/complete/"+complete,
			data : {id:id,complete:complete},
			cache: false,
			success: function(data) {
				if (data.success == 1) {
					window.location.href="/tasks";
				}
			}
		});
	
});

$('.task_delete').click(function () {
	var id = [];

	if ($('.tas_li').hasClass('meso_del')) {
		var url = "messages";

		$('.tas_li:checked').each(function (i) {
			var txt = $(this).parents().eq(3).attr('id');
			id.push(txt);
		});
		var myUrl = "messages";
		//alert()
	}
	else
	{
		$('.tas_li:checked').each(function (i) {
			var txt = $(this).parents().eq(2).attr('id');
			id.push(txt);
		});

		var myUrl = "tasks";
	}

	if (id == "") {
		alert("select at least one");
	}
	else{
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "delete",
			url: myUrl,
			data : {id:id},
			cache: false,
			success: function(data) {
				if (data.success == 1) {
					window.location.href="/tasks";
				}
				if (url == "messages") {
					window.location.href="/messages";
				}

			}
		});
	}
	//var arr_user = data_user.split(",");
	
		//console.log(arr_user);

});

//add new department
$('#buttonSave').on('click', function (event) {
	event.preventDefault();
	//alert()
	var action = $('#buttonSave').val();

	// var vals = $('#uploadImage').val(),
	// val = vals.length ? vals.split('\\').pop() : '';

	var employee_id = $('#employee_id').val();


	//var type = "post",
	var my_Url = "employees";
	var type = "post";
	if (action == "update") {
		 type = "put";
		my_Url = "employees/" + employee_id;
	}

	var employeePos = document.getElementById("employeePosition");
	//var employeePosition = employeePos.options[employeePos.selectedIndex].value;
	var employeeDep = document.getElementById("employeeDepartment");
	var employeeDepartment = employeeDep.options[employeeDep.selectedIndex].value;
	var accessLev = document.getElementById("accessLevel");
	//var accessLevel = accessLev.options[accessLev.selectedIndex].value;
	//alert($('input[name=employeePhone]').val().length);
	var fon = $('input[name=employeePhone]').val();
	if (fon.length < 10) {
		$('.error').removeClass('hidden');
		return $('.phone_err').text("Enter correct phone number");
	}
	else
	{
		$('.phone_err').text("");
	}

	var formData = {
				'token' : $('input[name=_token').val(),
				'employeeName' : $('#employeeName').val(),
				'employeeDOB' : $('#employeeDOB').val(),
				'employeePhone' : $('input[name=employeePhone]').val(),
				'employeeEmail' : $('input[name=employeeEmail]').val(),
				//'uploadImage' : val,
				'employeeAddress' : $('input[name=employeeAddress]').val(),
				'employeeDepartment' : employeeDepartment,
				'employeeStatus' : $('input[name=employeeStatus]:checked').val(),
				'employeeGender' : $('input[name=employeeGender]:checked').val(),
				'form_action' : type,
			}
		if (action == "update") {
			formData['employee_id'] = employee_id;
		}
	//if (action == 'add') {
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: type,
			url: my_Url,
			data : formData,
			success: function(data) {
				//console.log(data);
				//window.location.assign('employees');
				if (data.errors) {
					$('.error').removeClass('hidden');

					if(data.errors.employeeName) {
						$('.name_err').text(data.errors.employeeName);
					}
					else
					{
						$('.name_err').text("");
					}
					if (data.errors.employeeDOB) {
						$('.dob_err').text(data.errors.employeeDOB);
					}
					else
					{
						$('.dob_err').text("");
					}
					if (data.errors.employeePhone) {
						$('.phone_err').text(data.errors.employeePhone);
					}
					else
					{
						// if (fon.length < 10) {
						// 	$('.error').removeClass('hidden');
						// 	$('.phone_err').text("Enter correct phone number");
						// }
						// else
						// {
						// 	$('.phone_err').text("");
						// }
						$('.phone_err').text("");
					}
					if (data.errors.employeeEmail) {
						$('.email_err').text(data.errors.employeeEmail);
					}
					else
					{
						$('.email_err').text("");
					}
					if (data.errors.uploadImage) {
						$('.pic_err').text(data.errors.uploadImage);
					}
					else
					{
						$('.pic_err').text("");
					}
					if (data.errors.employeeAddress) {
						$('.add_err').text(data.errors.employeeAddress);
					}
					else
					{
						$('.add_err').text("");
					}
					if (data.errors.employeeGender) {
						$('.gender_err').text(data.errors.employeeGender);
					}
					else
					{
						$('.gender_err').text("");
					}
					if (data.errors.employeeDepartment) {
						$('.dep_err').text(data.errors.employeeDepartment);
					}
					else
					{
						$('.dep_err').text("");
					}
					if (data.errors.employeeGender) {
						$('.gender_err').text(data.errors.employeeGender);
					}
					else
					{
						$('.gender_err').text("");
					}
					
					if (data.errors.employeeStatus) {
						$('.status_err').text(data.errors.employeeStatus);
					}
					else
					{
						$('.status_err').text("");
					}
				}
				else
				{
					console.log(data);

					$('.error').remove();

					var empl_disp = "<tr class='employee" + data.id + "'>"+
									"<td>" + data.id + "</td>"+
									"<td>" + data.employeeName + "</td>"+
									"<td>" + data.employeePhone + "</td>"+
									"<td>" + data.employeeEmail + "</td>"+
									"<td>" + data.employeeDepartment + "</td>"+
									"<td>" + data.employeeStatus + "</td></tr>";

					$('.tbl_employees').append(empl_disp);
					window.location.href="/employees";	
				}
			}
		});
});

$('.employ_view').on('click', function () {
	var count = $('.fil_sel').find("input:checked").length;
	if (count !== 1) {
		alert("Select just one row");
		$('.fil_sel input[type="checkbox"]').prop('checked', false);
	}
	else
	{
		var td_id = $('.fil_sel').find("input:checked").attr("id");

		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'get',
			url: 'employees/' + td_id,
			data : {'emp_id':td_id},
			cache:false,
			success:function(data) {
				$('.fil_sel input[type="checkbox"]').prop('checked', false);
				$('#employee_view').modal('show');
				//window.location.href = "/employees";
				//console.log(data);
				$('.tbl_emp_view tbody').empty();
				$('.tbl_emp_view').append('<tr>'+
				// '<th>Employee Pic</th><td class="img-plc"><img src="images' + '/' + data.image + '" width="180px" ></td></tr>'+
				'<tr><th>Name</th><td>'+ data.name +'</td></tr>'+
				'<tr><th>Phone No.</th><td>'+ data.phoneNumber +'</td></tr>'+
				'<tr><th>Email</th><td>' + data.email + '</td></tr>');

				if (data.gender == 2) {
					$('.tbl_emp_view').append('<tr><th>Gender</th><td> Male </td></tr>');
				}
				else
				{
					$('.tbl_emp_view').append('<tr><th>Gender</th><td> Female </td></tr>');
				}
				console.log(data.department);
				$('.tbl_emp_view').append('<tr>'+
				//'<tr><th>Age</th><td>'+ data.age +'</td></tr>'+
				'<th>Address</th><td>'+ data.address +'</td></tr>'+
				//'<tr><th>Position</th><td>'+ data.position +'</td></tr>'+
				'<tr><th>Department</th><td>'+ data.department +'</td></tr>'+
				'<tr><th>Status</th><td>'+ data.status +'</td></tr>'
				//'<tr><th>Access Level</th><td>'+ data.accessLevel +'</td></tr>'
				);
			}
		});
	}
});

//edit department detailsss
$('.employ_edit').on('click', function () {

	var count = $('.fil_sel').find("input:checked").length;
	if (count !== 1) {
		alert("Select just one row");
		$('.fil_sel input[type="checkbox"]').prop('checked', false);
	}
	else
	{
		var td_id = $('.fil_sel').find("input:checked").attr("id");
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'get',
			url: 'employees/edit/' + td_id,
			data : {'emp_id':td_id},
			cache:false,
			success:function(data) {
				//console.log(data);
				$('.error').addClass('hidden');
				$('.fil_sel input[type="checkbox"]').prop('checked', false);
				$('#action_type').val('edit');

				$('#employeeName').val(data.name);
				$('#employeeDOB').val(data.Dob);
				$('#employeePhone').val(data.phoneNumber);
				$('#employeeEmail').val(data.email);
				//document.getElementById('employeeStatus').value=data.status;
				//$('input[name=employeeStatus').val(data.status);
				$('#employee_id').val(td_id);

				$('#employeeAddress').val(data.address);
				$('#employeePosition').val(data.position);
				//$('#employeeDepartment').val(data.department);
				//console.log(data.department);
				switch(data.department) {
					case 'sales & Marketing':
						$("#employeeDepartment option[value='4']").prop('selected', true);
					break;
					case 'Human Resource':
						$("#employeeDepartment option[value='7']").prop('selected', true);
					break;
					case 'Transport':
						$("#employeeDepartment option[value='8']").prop('selected', true);
					break;
					case 'Store and Record':
						$("#employeeDepartment option[value='9']").prop('selected', true);
					break;
					case 'I.C.T':
						$("#employeeDepartment option[value='10']").prop('selected', true);
					break;
					case 'saleswet':
						$("#employeeDepartment option[value='11']").prop('selected', true);
					break;
					case 'Doctors':
						$("#employeeDepartment option[value='15']").prop('selected', true);
					break;

					default:
						$("#employeeDepartment option[value='']").prop('selected', true);
				}
				
				$('#accessLevel').val(data.accessLevel);
				//$('#uploadedImage').attr('src', 'images/' + data.image);
				//$('#uploadImage').val(data.image);
				//$('#uploadedImage').css('visibility', 'visible');
				//console.log(data.status);
				if (data.status == "Active") {
					// $('.active ').prop('checked', true);
					$(".activeOne").prop('checked', true);
				}
				else
				{
					// $('.notActive').prop('checked', true);
					$(".notActive").prop('checked', true);
				}
				if (data.gender == 2) {
					$(".male").prop('checked', true);
				}
				else
				{
					$(".female").prop('checked', true);
				}

				$('#employee-modal').modal('show');
				$('.modal-title').html("Edit Employee details");
				$('#buttonSave').html("Update employee");
				$('#buttonSave').val('update');
				//$('#buttonSave').addClass("employee_edit");

			}
		});
	}
});

$('.employ_delete').on('click', function () {
	var count = $('.fil_sel').find("input:checked").length;
	if (count !== 1) {
		alert("Select just one row");
		$('.fil_sel input[type="checkbox"]').prop('checked', false);
	}
	else
	{
		
		var td_id = $('.chk_tb:checked').attr("id");
		//var td_id = $('.chk_tb').prop('checked').parents().eq(3).attr('id');
		//$(this).parents().eq(3).attr('id');
		//var td_id = $('.fil_sel input[type="checkbox"]').attr("id");
		//alert(td_id);
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'delete',
			url: 'employee/' + td_id,
			data : {'emp_id':td_id},
			cache:false,
			success:function(data) {
				$('.fil_sel input[type="checkbox"]').prop('checked', false);

				//console.log(data);

				$('.employee' + td_id).remove();

				//set the message to be displayed.
				$('.alertMessage').html('Deleted successfully');
				//call the display message function
				//displayAlertMessage();
				window.location.href="/employees";	
			}
		});
	}
});

//add new department
$('#saveProject').on('click', function () {
	$('.error').html('');
	var checkReminder = $('#proj_reminder').find("input:checked").length;
	var checkTarget = $('#proj_target').find("input:checked").length;

	var section = $('#saveProject').val();

	var type = "post";
	var my_Url = "/projects";

	if (section == "update") {
		var proj_id =  $('#proj_id').val();
		var type = "put";
		var my_Url = "/projects/" + proj_id;
	}

	var formData = {
				'token' : $('input[name=_token').val(),
				'checkReminder' : $('#checkReminder').val(),
				'checkTarget' : $('#checkTarget').val(),
				'projoName' : $('#projoName').val(),
				'projoStart' : $('#projoStart').val(),
				'projoEnd' : $('#projoEnd').val(),
				'projoDesc' : $('#projoDesc').val(),
				'projoMembers' : sessionStorage.getItem('usersId'),
			};
	if (checkReminder == 1) {
		formData.append(
			'reminderDate', $('#reminderDate').val(),
			'reminderTime', $('#reminderTime').val(),
			'reminderMessage', $('#reminderMessage').val()
		);
	}
	if (checkTarget == 1) {
		formData.append(
			'targetDate', $('#targetDate').val(),
			'targetMessage', $('#targetMessage').val()
		);
	}

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: type,
		url: my_Url,
		data : formData,
		success: function(data) {
			console.log(data.errors);
			if (data.errors) {
				$('.error').removeClass('hidden');

				if (data.errors.projoName) {
					$('.projoNameError').text(data.errors.projoName);
				}
				else
				{
					$('.projoNameError').text("");
				}

				if (data.errors.projoStart) {
					$('.projoStartError').text(data.errors.projoStart);
				}
				else
				{
					$('.projoStartError').text("");
				}

				if (data.errors.projoEnd) {
					$('.projoEndError').text(data.errors.projoEnd);
				}
				else
				{
					$('.projoEndError').text("");
				}
				if (checkReminder == 1) {
					if (data.errors.reminderDate) {
						$('.reminderError').text(data.errors.reminderDate);
					}
					else
					{
						$('.reminderError').text("");
					}
					if (data.errors.reminderTime) {
						$('.reminderError').text(data.errors.reminderTime);
					}
					else
					{
						$('.reminderError').text("");
					}
					if (data.errors.reminderMessage) {
						$('.reminderError').text(data.errors.reminderMessage);
					}
					else
					{
						$('.reminderError').text("");
					}
				}
				if (checkTarget == 1) {
					if (data.errors.targetDate) {
						$('.targetError').text(data.errors.targetDate);
					}
					else
					{
						$('.targetError').text("");
					}
					if (data.errors.targetMessage) {
						$('.targetError').text(data.errors.targetMessage);
					}
					else
					{
						$('.targetError').text("");
					}
				}

				if (data.errors.projoDesc) {
					$('.projoDescError').text(data.errors.projoDesc);
				}
				else
				{
					$('.projoDescError').text("");
				}
				if (data.errors.projoMembers) {
					$('.projoMembersError').text(data.errors.projoMembers);
					$('.projoMembersError').append('<br>');
				}
				else
				{
					$('.projoMembersError').text("");
				}
			}
			else
			{
				var no = $('#no').val() + 1;

				$('.projectForm').trigger('reset')
				$('#project-modal').addClass('animated zoomOut');
				$('#project-modal').modal('hide');
				setTimeout(function () {
					$('#project-modal').removeClass('animated zoomOut');
				} , 2000);

				//set the message to be displayed.
				$('.alertMessage').html('Department details updated successfully');
				//call the display message function

				//set the message to be displayed.
				$('.alertMessage').html('New department added successfully');
				//call the display message function
				//displayAlertMessage();
				//window.location.href="/projects";
				setTimeout(function () {
					$('#addTask').removeClass('animated zoomOut');
				} , 4000);
			}
		},
		error: function (data) {
			console.log(data);
		}
	});
});

//edit department detailsss
$('.projo_edit').on('click', function () {
	var count = $('.fil_sel').find("input:checked").length;

	if (count !== 1) {
		alert("Select just one row");
		$('.fil_sel input[type="checkbox"]').prop('checked', false);
	}
	else
	{
		$('#proj_reminder').prop('checked', false);
		$('#proj_target').prop('checked', false);

		$('.proj-dis-re').addClass('not-active');
		$('.proj-dis-ta').addClass('not-active');

		var td_id = $('.fil_sel').find('input:checked').attr('id');
		$('.chk_proj').prop('checked', false);

		$.ajax({
			type: "get",
			url: "/projects/" + td_id,
			success: function (data) {
				console.log(data);
				$('.projectForm').trigger('reset');

				$('#projoName').val(data.name);
				$('#projoStart').val(data.start_date);
				$('#projoEnd').val(data.end_date);
				$('#projoDesc').val(data.description);

				if (data.target_date !== null) {
					$('#proj_target input[type="checkbox"]').prop('checked', true);
					$('.proj-dis-ta').removeClass('not-active');

					$('#targetDate').val(data.target_date);
					$('#targetMessage').val(data.target_message);
				}

				if (data.reminder_date !== null) {
					//$('.myCheckbox')[0].checked = true;
					$('#proj_reminder input[type="checkbox"]').prop('checked', true);
					$('.proj-dis-re').removeClass('not-active');

					$('#reminderDate').val(data.reminder_date);
					$('#reminderTime').val(data.reminder_time);
					$('#reminderMessage').val(data.reminder_message);
				}

				$('#project-modal').modal('show');
				$('.modal-title').html("Edit project details");
				$('#saveProject').html("Update project");

				$('#action_type').val('update');
			}
		});

	}
});

//view the projects
$('.projo_view').on('click', function () {
	var count = $('.fil_sel').find("input:checked").length;
	if (count !== 1) {
		alert("Select just one row");
		$('.fil_sel input[type="checkbox"]').prop('checked', false);
	}
	else
	{
		var td_id = $('.fil_sel').find('input:checked').attr('id');
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "get",
			url: "/projects/" + td_id,
			success: function(data) {
				console.log(data);
				$('.fil_sel input[type="checkbox"]').prop('checked', false);

				$('.tbl_proj_view tbody').empty();
				var proj_prev = '<tr><th>Name</th><td colspan="2">'+ data.name +'</td></tr>'+
								'<tr><th>Project description</th><td colspan="2">'+ data.description +'</td></tr>'+
								'<tr><th>Started By</th><td colspan="2">' + data.user_id + '</td></tr>'+
								'<tr><th>Start date</th><td colspan="2">'+ data.start_date +'</td></tr>'+
								'<tr><th>Due date</th><td colspan="2">'+ data.end_date+'</td></tr>'+
								'<tr><th>Status</th><td colspan="2">'+ data.status +' % Completed</td></tr>'+
								'<tr><th>Team Members</th><td colspan="2">'+ data.team_members +'</td></tr>';

				if (data.reminder_date !== null) {
					proj_prev += '<tr><th rowspan="2">Reminder</th><td colspan="2">'+ data.reminder_date + ' ' + data.reminder_time +'</td></tr>'+
									'<tr><td colspan="2">'+ data.reminder_message +'</td></tr>';
				}

				if (data.target_date !== null) {
					proj_prev += '<tr><th rowspan="2">Targets</th><th>By '+ data.target_date +'</th><td>'+ data.target_message +'</td></tr>'+
									'<tr><th class="th-st">By 25 June 2018</th><td>Be completed 75%</td></tr>';
				}

				$('.tbl_proj_view tbody').append(proj_prev);

				$('#project_view').modal('show');
				$('.modal-title').html("Project details");
			}
		});
	}
});

//delete project
$('.projo_delete').on('click', function () {
	var count = $('.fil_sel').find("input:checked").length;

	// if (count !== 1) {
	// 	alert("Select just one row");
	// 	$('.fil_sel input[type="checkbox"]').prop('checked', false);
	// }
	// else
	// {
		if (confirm("Are you sure you want to delete?")) {
			

			var id = [];
			
			$('.chk_proj:checked').each(function (i) {
				//td_id = $('.fil_sel').find('input:checked').attr('id');
				var txt = $(this).closest('tr').attr('id');
				//var txt = $(this).parents().eq(3).attr('id');
				id.push(txt);
			});

			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type: "delete",
				data: {id:id},
				url: "/projects/",
				success: function(data) {
					//console.log(data);
					$('.fil_sel input[type="checkbox"]').prop('checked', false);
					//set the message to be displayed.
					$('.alertMessage').html('Deleted successfully');
					//call the display message function
					window.location.href="/projects";
					setTimeout(function () {
						$('#addTask').removeClass('animated zoomOut');
						
					} , 4000);
					//displayAlertMessage();
				}
			});
		}
	//}
});

$('.copy').on('click', function (event) {
	event.preventDefault();
	//var txt = $(this).closest('tr').attr('id');

	$('.paste').css('color', '#337ab7');
	$('.paste').removeClass('disabled');

	//var folderId = document.getElementById('breadcrumb').lastChild.id;
	var data = "";
	$('.file_chkbx:checked').each(function (i) {
		var txt = $(this).closest('tr').attr('id');
		
		data = data + "," + txt;

		//sessionStorage.removeItem('copiedContent');
	});
	data = data.substring(1);
	var arr = data.split(",");
	sessionStorage.setItem('pastingContent', arr);
	//console.log(sessionStorage.getItem('pastingContent'));
	//console.log(path);
	//alert(folderId);
});

$('.paste').on('click', function () {

	var pastedData = sessionStorage.getItem('pastingContent');
	//	console.log(pastedData);
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "post",
		url: "/files/paste",
		data: {type:"paste",content:pastedData},
		success: function(data) {
			console.log(data);
			if (data.success = 1) {
				$('.alertMessage').html('Pasted successfully');
					//call the display message function
				//displayAlertMessage();
				window.location.assign('/files');
			}

			if (data.errors = 1) {
				$('.alertMessage').html('Failed!! Please try again');
				$('.display_message').removeClass('alert_success').addClass('alert_warning');
					//call the display message function
				//displayAlertMessage();
			}

			if (data.errors = "exists") {
				$('.alertMessage').html('Failed!! File already exists');
				$('.display_message').removeClass('alert_success').addClass('alert_warning');
					//call the display message function
				////displayAlertMessage();
			}
			//$('.copy,.move,.rename,.fa-download,.fa-share-alt').css('color', '#777');
		}
	});
});

$('.rename').click(function (event) {
	event.preventDefault();

	var chck = $('.file_chkbx:checked');
	var oldName = $(chck).closest('tr').attr('id');

	var count = chck.length;

	if (count == 1) {
		var name = prompt("Write new name");
		if(name !== null) {
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type: "post",
				url: "/files/rename",
				data: {name:name, oldName:oldName},
				success: function(data) {
					//console.log(data);
					$('.fil_sel input[type="checkbox"]').prop('checked', false);
					//window.location.assign('/files');
					window.location.href="/files";
				}
			});
		}
	}
	else
	{
		alert("Select at least one");
		$('.fil_sel input[type="checkbox"]').prop('checked', false);
	}
})

function notifications () {

	
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "post",
		//url: "/files/rename",
		//data: {name:name, oldName:oldName},
		success: function(data) {
			//console.log(data);
			//$('.fil_sel input[type="checkbox"]').prop('checked', false);
		}
	});

}
