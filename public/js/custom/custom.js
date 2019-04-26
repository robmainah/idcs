

$(document).ready(function () {
	$('#fil-hid').hide();
	$('#uploadedImage').css('visibility', 'hidden');
	$('.checkbox input[type="checkbox"]').prop('checked', false);

});

//menu toggle
$("#menu-toggle").click(function (e) {
	e.preventDefault();
	$("#wrapper").toggleClass("menuDisplayed");
});
//check multiple checkboxes in a table
$('#chk_head').change(function () {
	$('#chk_head').change(function () {
		var status = this.checked;
		$('.chk_tbl').each(function () {
			this.checked = status;
		})
	})
});

$('.employ_add').on('click', function () {
	$('.employeeForm').trigger('reset');
	$('#buttonSave').val('add');

});
$('.new_employee_add').on('click', function () {
	$('#employee-modal').addClass('animated zoomOut');
	$('#employee-modal').modal('hide');
	alert("oo");
});

$('.checxkbox').change(function () {
	if (this.checked == false) {
		$("#chk_head")[0].checked = false;
	}

	if ($('.chk_tbl:checked').length == $('.chk_tbl').length) {
		$('$chk_head')[0].checked = true;
	}
})

$('tbody tr #fil_td').click(function (event) {
	var $target = $(event.target);
	if (!$target.is('input:checkbox')) {
		$(this).find('input:checkbox').each(function () 
		{
			var txt = $(this).closest('tr').attr('id');
			if (this.checked) 
			{
				this.checked=false;
			}
			else 
			{
				this.checked=true;
			}
		})
	}
	var id = 0;
	var data_user = "";

	$('.file_user_chkbx:checked').each(function (i) {
		var txt = $(this).closest('tr').attr('id');
		data_user  = data_user + "," + txt;
		id += 1;
	});
	data_user = data_user.substring(1);
	var arr_user = data_user.split(",");

	var did = 0;
	var new_data = "";
	$('.file_chkbx:checked').each(function (i) {
		var txt = $(this).closest('tr').attr('id');
		new_data  = new_data + "," + txt;
		
		did += 1;
	});

	new_data = new_data.substring(1);
	var arr_new_data = new_data.split(",");

	if (arr_new_data[0] !== "") {
		sessionStorage.setItem('fileToShareId', arr_new_data);
	}

	if (arr_user[0] !== "") {
		sessionStorage.setItem('selectedUsersToSend', arr_user);
	}

	if (arr_user[0] == "" || id == 0) {
		sessionStorage.removeItem('selectedUsersToSend');
	}
	
	if (arr_new_data[0] == "" || did == 0) {
		sessionStorage.removeItem('fileToShareId');
	}

	if (did > 0) {
		$('.fil-tp-lnk li a').bind('mouseover', function () {
			$(this).css('color', 'rgb(221, 137, 55)');
		});

		$('.fil-tp-lnk li a').bind('mouseout', function () {
			$(this).css('color', '#337ab7');
		});

		$('.copy,.move,.rename,.delete,.edit').addClass('fil-cp');
		$('.copy,.move,.rename,.delete,.edit').removeClass('disabled');
		$('.copy,.move,.rename,.edit,.delete').css('color', '#337ab7');
	}
	else
	{
		$('.fil-tp-lnk li a').bind('mouseover', function () {
			$(this).css('color', '#777');
		});
		$('.fil-tp-lnk li a').bind('mouseout', function () {
			$(this).css('color', '#777');
			$('.new_folder').css('color', '#337ab7');
		});
		$('.new_folder').bind('mouseover', function () {
			$(this).css('color', 'rgb(221, 137, 55)');
		});

		$('.copy,.move,.rename.delete,.edit').removeClass('fil-cp');
		$('.copy,.move,.rename,.delete,.paste,.edit').addClass('disabled');
		$('.copy,.move,.rename,.delete,.edit,.paste').css('color', '#777');
	}
});

$('tbody tr #td_one').click(function(event) {
	var $target = $(event.target);
	if (!$target.is('input:checkbox')) {
		$(this).find('input:checkbox').each(function () {
			if (this.checked) this.checked=false;
			else this.checked=true;
		})
	}
});

$('ul.dept li a').on('click', function () {
	$('.dept li a').removeClass('depart_active');
	$(this).addClass('depart_active');
});

$('.depart_add').on('click', function () {
	$('.modal-title').html("Add new Department");
	$('#add_new_department').html("Add Department");

	$('#action_type').val('add');
	$('.proj').removeClass('hidden');
	$('#main_depart form').trigger('reset');
});

$('.dep_sub a').on('click', function () {
	$('.prj-main-dep').removeClass('hidden');
	$('.prj-main-dep').css('display', 'block');
	$('.prj-title').html('Sub Department name');
	$('#saveDepartment').val('add-sub');
});

$('.dep_main a').on('click', function () {
	$('.prj-main-dep').css('display', 'none');
	$('.prj-title').html('Department name');
	$('#saveDepartment').val('add-main');
});

$("#dataTables-example").on("mouseenter", "td", function() {
  $(this).attr('title', this.innerText);
});

$('.projo_add').on('click', function () {
	$('#proj_reminder').prop('checked', false);
	$('#proj_target').prop('checked', false);

	$('.proj-dis-re').addClass('not-active');
	$('.proj-dis-ta').addClass('not-active');

	$('#saveProject').val('add');
});

$('#proj_reminder').on('change', function () {
	$('.proj-dis-re').toggleClass('not-active');
	$('#projoReminder').focus();
});

$('#proj_target').on('change', function () {
	$('.proj-dis-ta').toggleClass('not-active');
	$('#projoTarget').focus();
});

//add members to a project
$('#projoMembers').on('click', function () {
	$('#filtMemByDept').val('all');
	$('.task-check:checked').prop('checked', false);
	$('#project_add_members').modal('show');
});

$('.cht-sm-lft').on('click', function (event) {
	$('.cht-sm-lft ul').addClass('ch-hidden');
	
	$(this).find('ul').toggleClass('ch-hidden');
	var id = $(this).find('ul ').attr('id');
	
	$('.set_task').on('click', function () {
		
	});
	//$('.dropdown-tasks').prepend('<li><a href="#"><div><p><strong>Task 4</strong><span class="pull-right text-muted">80% Complete</span></p><div class="progress progress-striped active"><div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"><span class="sr-only">80% Complete (danger)</span></div></div></div></a> </li>');
});

$('.cht-add-btn').on('click', function () {
	//$(this).
	$('.cht-add-msg').toggleClass('ch-hidden');
	$('#newMessage').focus();
	//$('.cht-add-btn').addClass('cht-close');
	$('.cht-add-btn i').toggleClass('fa-times fa-plus');
});

$('#cht-file').on('click', function () {
	$('#newMessage').val("");
	$('input[type=file]').trigger('click');
});

$('.file_add').click(function () {
	$('#fileForm').trigger('reset');
	$('#image_preview').css('visibility', 'hidden');
	$('#image_preview').html("");
	$('.error').addClass('hidden');
})

/*$('input[type=file]').on('change', function () {
	var vals = $(this).val(),
		val = vals.length ? vals.split('\\').pop() : '';

	$('#newMessage').css('visibility', 'hidden');
	$('#uploadedImage').css('visibility', 'visible');
	var imgUrl = window.URL.createObjectURL(this.files[0]);
	$('#cht-prev').html('<img src="" id="uploadedImage" width="200" height="150">');

	$('#uploadedImage').attr('src', imgUrl);
	$('.cht-add-msg').css('width', "auto");
	$('#cht-prev').css('margin-right', '20%');
	$('.btn-primary').css('background-color', "#fff");
	$('.btn-primary').css('color', " #2e6da4");
	$('.fa-file').css('color', "#fff");

});*/
$("#uploadImage").change(function(event){

	 
	 $('#image_preview').css('visibility', 'visible');

	 var total_file=document.getElementById("uploadImage").files.length;
    //var images= ""
	for(var i=0;i<total_file;i++)
	{
		$('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' width='150' height='150'>");
	    // if(images==""){
	    // 	 images = URL.createObjectURL(event.target.files[i]);
	    // }else{
	    //      images = images + ','+URL.createObjectURL(event.target.files[i]);
	    // }
	   
	}
	 //var imagesArr=images.split(',');

	 //uploadImages(imagesArr);


});

$('#cht-send').on('click', function () {
	var txtVal = $.trim($('#newMessage').val());
	var imgVal = $('#fil-hid').val();
	
	if (txtVal !== "") {
		$('.cht-cont .panel-body').append('<div class="row"><div class="popover left pull-right cht-sm-lft"><div class="arrow"></div><ul class="ch-hidden"><li><a><i class="fa fa-share fa-fw"></i></a></li><li><a><i class="fa fa-tasks fa-fw set_task"></i></a></li><li><a><i class="fa fa-bell fa-fw"></i></a></li></ul><div class="popover-content"><p>' + txtVal + '</p></div></div></div>');
	}
	else {
		$('.cht-cont .panel-body').append('<div class="row"><div class="popover left pull-right cht-sm-lft"><div class="arrow"></div><ul class="ch-hidden"><li><a><i class="fa fa-share fa-fw"></i></a></li><li><a><i class="fa fa-tasks fa-fw set_task"></i></a></li><li><a><i class="fa fa-bell fa-fw"></i></a></li></ul><div class="popover-content"><p><img src="' + imgVal + '" id="uploadedImage" width="200" height="150"></p></div></div></div><hr>');
	}

	$('.cht-add-btn i').toggleClass('fa-plus fa-times');
	$('.cht-add-msg').addClass('ch-hidden');
	$('#chtUpload')[0].reset();
});





// $(function () {
// 	$('.task-chk').each(function () {
// 		this.checked = !this.checked;
// 	})
// 	// .parent().each(function () {
// 	// 	selectLink(this);
// 	// })
// });

function selectLink (checkMe) {
	//alert();
	//var link = document.getElementByClass('taskCheck');
	if($(checkMe).find('input[type="checkbox"]').is(':checked')) {
		//.task-check input[type="checkbox"]
		$(checkMe).find('input[type="checkbox"]').prop('checked', false);
	}
	else
	{
		$(checkMe).find('input[type="checkbox"]').prop('checked', true);
	}

	var id = 0;
	var data_user = "";

	$('.task-check:checked').each(function (i) {
		var txt = $(checkMe).attr('id');
		data_user  = data_user + "," + txt;
		id += 1;
	});
	data_user = data_user.substring(1);
	var arr_user = data_user.split(",");
}

$('#sent').click(function () {
	$('#sent_messages').removeClass('hidden');
	$('#inbox_messages').addClass('hidden');
});

$('#inbox').click(function () {
	$('#sent_messages').addClass('hidden');
	$('#inbox_messages').removeClass('hidden');
});

$('.me').click(function () {
	$('.file_table-me').removeClass('hidden');
	$('.file_table_all-me').addClass('hidden');
	$('ul .nav-second-level').addClass('in');
});

$('.all').click(function () {
	$('.file_table-me').addClass('hidden');
	$('.file_table_all-me').removeClass('hidden');
	$('ul .nav-second-level').addClass('in');
});
/*
$(document).ready(function () {
	var scrollTop = $(window).scrollTop();
	var elementOffset = $('#my-element').offset().top;

	if ( <= 60) {
		//alert("hee");
	}
})
*/

//functions

function displayAlertMessage () {
	var alertMessage = "Message";
	
	$('.display_message').fadeIn();
	setTimeout(function () {
		$('.display_message').slideUp(2000);
		$('.display_message').fadeOut();
	}, 2000);
}


//$('#loadContent').load("resources/views/pages/reports.php");
//upload new file
//
//
//
//
//
/*function uploadImages(imagesArr){
	$.post("/files",{
		imagesArr:imagesArr
	},function(result){
       console.log(result);
	})
}*/ 