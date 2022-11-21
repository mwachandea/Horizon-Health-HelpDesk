//Javascript for inquiry and replies

//Submit Replies
$(document).ready(function() {     
$(document).on('submit','#ticketReply', function(event){
	event.preventDefault();
	$('#reply').attr('disabled','disabled');
	var formData = $(this).serialize();
	$.ajax({
		url:"process.php",
		method:"POST",
		data:formData,
		success:function(data){				
			$('#ticketReply')[0].reset();
			$('#reply').attr('disabled', false);
			location.reload();
			}
		})
	});

    //Open Create Form
	$('#createTicket').click(function(){
		$('#ticketModal').modal('show');
		$('#ticketForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Create Inquiry");
		$('.notice').html("Please fill-in all fields and select the department!");
		$('#action').val('createTicket');
		$('#save').val('Create Inquiry');
	});
    $('#makeTicket').click(function(){
		$('#ticketModal').modal('show');
		$('#ticketForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Create Inquiry");
		$('#action').val('createTicket');
		$('#save').val('Create Inquiry');
	});

    //Listing of the inquiries
	if($('#listTickets').length) {
		var ticketData = $('#listTickets').DataTable({
			"lengthChange": false,
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"process.php",
				type:"POST",
				data:{action:'listTicket'},
				dataType:"json"
			},
			"columnDefs":[
				{
					"targets":[0, 6, 7, 8, 9],
					"orderable":true,
				},
			],
			"pageLength": 10
		});	

        //submit button on modal
		$(document).on('submit','#ticketForm', function(event){
			event.preventDefault();
			$('#save').attr('disabled','disabled');
			var formData = $(this).serialize();
			$.ajax({
				url:"process.php",
				method:"POST",
				data:formData,
				success:function(data){				
					$('#ticketForm')[0].reset();
					$('#ticketModal').modal('hide');				
					$('#save').attr('disabled', false);
					ticketData.ajax.reload();
				}
			})
		});	

        //Edit Inquiry
		$(document).on('click', '.update', function(){
			var ticketId = $(this).attr("id");
			var action = 'getTicketDetails';
			$.ajax({
				url:'process.php',
				method:"POST",
				data:{ticketId:ticketId, action:action},
				dataType:"json",
				success:function(data){
					$('#ticketModal').modal('show');
					$('#ticketId').val(data.id);
					$('#subject').val(data.title);
					$('#message').val(data.init_msg);
					if(data.gender == '0') {
						$('#open').prop("checked", true);
					} else if(data.gender == '1') {
						$('#close').prop("checked", true);
					}
					$('.modal-title').html("<i class='fa fa-plus'></i> Edit Inquiry");
                    $('.notice').html("Edits Department and Status Only!<br>Edit Department to transfer to another department");
					$('#action').val('updateTicket');
					$('#save').val('Save Inquiry');
				}
			})
		});	

        //Close Inquiry
		$(document).on('click', '.end', function(){
			var ticketId = $(this).attr("id");		
			var action = "closeTicket";
			if(confirm("Are you sure you want to close this inquiry?")) {
				$.ajax({
					url:"process.php",
					method:"POST",
					data:{ticketId:ticketId, action:action},
					success:function(data) {					
						ticketData.ajax.reload();
					}
				})
			} else {
				return false;
			}
		});	

        //Delete Inquiry
        $(document).on('click', '.delete', function(){
			var ticketId = $(this).attr("id");		
			var action = "deleteTicket";
			if(confirm("Are you sure you want to delete this inquiry?")) {
				$.ajax({
					url:"process.php",
					method:"POST",
					data:{ticketId:ticketId, action:action},
					success:function(data) {					
						ticketData.ajax.reload();
					}
				})
			} else {
				return false;
			}
		});
    }
});

