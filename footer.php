<?php



?>

<script src="external/jquery/jquery.js"></script>
<script src="src/jquery-ui.js"></script>
<script src="src/jquery-ui-timepicker-addon.js"></script>

<script>
$(document).ready(function(){
	
	var timer="";
	var timer2="";
	$("#sf").on("keydown", function(e) {
		clearTimeout(timer);
	});
	$("#sf").on("keypress", function(e) {
		clearTimeout(timer);
	});
		$("#sf").on("keyup input", function(e) {
		clearTimeout(timer);
		
		 
		/*if(!(e.keyCode>=65 && e.keyCode<=90)&& !(e.keyCode>=97 && e.keyCode<=122) && !(e.keyCode>=48 && e.keyCode<=57)&& e.keyCode!=32 && e.keyCode!=8) return false;*/
		
		if($(this).val().length==0){ $('#searchresult').hide();return false;}
		
		 
		 
		
		 
			var searchval=$(this).val();
			 
			/*var value = $(this).val().toLowerCase();
			
			$("tbody tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			   console.log($(this).text().toLowerCase().indexOf(value));
			});*/
		timer=setTimeout(function(){	
		$.ajax({
			 type : "post",
			 dataType:"json",
			 url :"req.php",
			 async:false,
			 data : {look: searchval},
			 beforeSend: function(){
				 $('#searchresult').show();
				 $('.resultoverlay').show(); 
				 $("#resultdata").html("");
			},
			 success: function(response) {

				 timer2=setTimeout(function(){ 
				 var headindex=1;
				$('#searchresult').show();
				/* for(var headrow in response)	{
						$('#searchresult thead tr').append("<th>Edit</th>");
						for(var title in response[headrow]){
							if(headindex>=14&&headindex<=20){ headindex++; continue;}
						$('#searchresult thead tr').append("<th>"+title+"</th>");
						headindex++;
						}
						break;
				 }*/
			//$("#resultdata").html("");
			 $("#resultdata").html("");
			if(response.length<1) {
				 $("#resultdata").append("<tr colspan='21'>");
				  $("#resultdata").append("<td colspan='21' style='text-align:center;font-size:16px'>No Record Found</td>");
				  $("#resultdata").append("</tr>");	
			}
			
				 for(var row in response){
					 headindex=1;
					 $("#resultdata").append("<tr>");
					  $("#resultdata").append("<td><a href='edit-pupil.php?ID="+response[row]['ID']+"'>Edit</a></td>");
					   $("#resultdata").append("<td>"+response[row]['ID']+"</td>");			  
					   $("#resultdata").append("<td>"+response[row]['First Name']+" "+response[row]['Last Name']+"</td>");
					   $("#resultdata").append("<td class='currency'>"+response[row]['FEE'].toString().substr(0,1)+"</td>");
					   
					   	 
						 
					   $("#resultdata").append("<td class='bold'>"+response[row]['Applied On']+"</td>");	
					   $("#resultdata").append("<td class='bold'>"+response[row]['Code']+"</td>");	
					   $("#resultdata").append("<td class='bold'>"+response[row]['Device']+"</td>");	
					   $("#resultdata").append("<td>"+response[row]['License No']+"</td>");	
					   $("#resultdata").append("<td>"+response[row]['App Ref']+"</td>");
					   $("#resultdata").append("<td class='currency'>"+response[row]['Eligible Date']+"</td>");		
					   $("#resultdata").append("<td class='currency'>"+response[row]['Theory Exp']+"</td>");	
					   $("#resultdata").append("<td class='bold'>"+response[row]['Notes']+"</td>");
					   $("#resultdata").append("<td>"+response[row]['Clients_ID']+"</td>");
					    
					   
					   $("#resultdata").append("<td>"+response[row]['Temp Booking Date']+"</td>");	
					   $("#resultdata").append("<td class='bold'>"+response[row]['Temp Booking Centre']+"</td>");
					   $("#resultdata").append("<td class='bold'>"+response[row]['Temp Booking Code']+"</td>");	
					   $("#resultdata").append("<td class='bold'>"+response[row]['OBS']+"</td>");	
					   
					   	
					   $("#resultdata").append("<td>"+response[row]['Booked For']+"</td>");	
					   $("#resultdata").append("<td class='bold'>"+response[row]['Test Centre']+"</td>");
					   $("#resultdata").append("<td>"+response[row]['Special Code']+"</td>");
					   
					    
					   
					   
					    
					   $("#resultdata").append("<td>"+response[row]['Booked On']+"</td>");						
					 /*for(var data in response[row]){
						 if(headindex>=14 && headindex<=20){ headindex++; continue;}
						 
					  $("#resultdata").append("<td>"+response[row][data]+"</td>");
					  headindex++;
					 }*/
					  
					 
					  $("#resultdata").append("</tr>");
				 	
					
				 }
				 
				 $('.resultoverlay').hide();  
				},2000,response);
				 
			 },
			 complete: function(){
						 
						
						 	
						 
				 },
				 error: function(jqXHR, textStatus, errorThrown) {
        							console.log(textStatus); // this will be "timeout"
    					}
						
			
		    })
			
			 
		
		
		
		
		
		},800,searchval); 
		  });

edit_flag = false;

date_formats = [];

AppliedOn = ['dd.mm.yy', ''];
TheoryExp = ['dd-mm-yy', ''];
DateofBirth = ['dd.mm.yy', ''];
EligibleDate = ['dd-mm-yy', ''];
TempBookingDate = ['D dd M yy', 'hh:mmtt'];
BookedFor = ['D dd M yy', 'hh:mmtt'];
BookedOn = ['dd-mm-yy', ''];

$(function () {


	$(document).on('click', '.edit', function(e){

		if(!$(this).hasClass('edit_active')){
			
	if(edit_flag == false){
	
			text = $(this).text();
			id = $(this).attr('id');		
		
			$('.edit_active').each(function(){
			
				edit_text = $(this).find('input').val();
				$(this).html(edit_text);
			
			});
			

			$('.edit_active').removeClass('edit_active');
			
			$(this).html('<input type="text" value"">').addClass('edit_active');

			$('.edit_active input').val(text);		
	
			edit_flag = true;
			
			if($(this).hasClass('AppliedOn')){
			
			 $('.edit_active input').datetimepicker({
				showOn: "button",
				buttonImage: "images/ar.png",
				buttonImageOnly: true,
				buttonText: "Select date",    
				  dateFormat: AppliedOn[0],
				  timeFormat: AppliedOn[1]
										 
			 });	
			}	
			
			
			if($(this).hasClass('TheoryExp')){
			
			 $('.edit_active input').datetimepicker({
				showOn: "button",
				buttonImage: "images/ar.png",
				buttonImageOnly: true,
				buttonText: "Select date",    
				  dateFormat: TheoryExp[0],
				  timeFormat: TheoryExp[1]
										 
			 });	
			}	
	
			if($(this).hasClass('DateofBirth')){
			
			 $('.edit_active input').datetimepicker({
				showOn: "button",
				buttonImage: "images/ar.png",
				buttonImageOnly: true,
				buttonText: "Select date",    
				  dateFormat: DateofBirth[0],
				  timeFormat: DateofBirth[1]
										 
			 });	
			}	
		
	
			if($(this).hasClass('EligibleDate')){
			
			 $('.edit_active input').datetimepicker({
				showOn: "button",
				buttonImage: "images/ar.png",
				buttonImageOnly: true,
				buttonText: "Select date",    
				  dateFormat: EligibleDate[0],
				  timeFormat: EligibleDate[1]
										 
			 });	
			}
			
			if($(this).hasClass('TempBookingDate')){
			
			 $('.edit_active input').datetimepicker({
				showOn: "button",
				buttonImage: "images/ar.png",
				buttonImageOnly: true,
				buttonText: "Select date",    
				  dateFormat: TempBookingDate[0],
				  separator: ' - ',
				  timeFormat: TempBookingDate[1]
										 
			 });	
			}		
	
			if($(this).hasClass('BookedFor')){
			
			 $('.edit_active input').datetimepicker({
				showOn: "button",
				buttonImage: "images/ar.png",
				buttonImageOnly: true,
				buttonText: "Select date",    
				  dateFormat: BookedFor[0],
				  separator: ' - ',
				  timeFormat: BookedFor[1]
										 
			 });	
			}		
	
			if($(this).hasClass('BookedOn')){
			
			 $('.edit_active input').datetimepicker({
				showOn: "button",
				buttonImage: "images/ar.png",
				buttonImageOnly: true,
				buttonText: "Select date",    
				  dateFormat: BookedOn[0],
				  timeFormat: BookedOn[1]
										 
			 });	
			}
			
										
			
	}
	else{
			
			cell = $(this);
		
			$('#edit_message').css('color', '#434343').html('');
					
			text_active = $('.edit_active input').val();
			id_active = $('.edit_active').attr('id');		
			if( $('.edit_active').hasClass('date') ) {
				is_date = 1;
				text_active = text_active;
			}
			else {
				is_date = 0;
			}
							
			$('#edit_message').html('Saving..');
			
$.post('edit-save.php', { text_active:text_active, id_active:id_active, is_date:is_date }, function(result){

if(result.indexOf("ok") > 0){

	$('#edit_message').html('You successfully updated your value.');
	//$('#edit_message').html(result);
	$('#edit_message').css('color', 'green');
	
	setTimeout(function(){ $('#edit_message').css('color', '#434343').html('');}, 3000);
		
			text = cell.text();
			id = cell.attr('id');		
		
			$('.edit_active').each(function(){
			
				edit_text = $('.edit_active input').val();
				$('.edit_active').html(edit_text);
			
			});
			

			$('.edit_active').removeClass('edit_active');
			
			cell.html('<input type="text" value"">').addClass('edit_active');

			$('.edit_active input').val(text);	
	
}
else{

	$('#edit_message').css('color', 'orangered').html(result);

}
	
});	

}

		}
		
	});
	
	
	$('body').click(function(ev){
	
		if ( $(ev.target).hasClass('zoom')	) {	
		
			if ( edit_flag == true	) {	
			
				$('#edit_message').css('color', '#434343').html('');
						
				text_active = $('.edit_active input').val();
				id_active = $('.edit_active').attr('id');		
				if( $('.edit_active').hasClass('date') ) {
					is_date = 1;
					text_active = text_active;
				}
				else {
					is_date = 0;
				}
				
				$('#edit_message').html('Saving..');
				
	$.post('edit-save.php', { text_active:text_active, id_active:id_active, is_date:is_date }, function(result){

	if(result.indexOf("ok") > 0){

		$('#edit_message').html('You successfully updated your value.');
		//$('#edit_message').html(result);
		$('#edit_message').css('color', 'green');
		
		setTimeout(function(){ $('#edit_message').css('color', '#434343').html('');}, 3000);
				
			
				$('.edit_active').each(function(){
				
					edit_text = $('.edit_active input').val();
					$('.edit_active').html(edit_text);
				
				});
				

				$('.edit_active').removeClass('edit_active');
				
				edit_flag = false;
		
	}
	else{

		$('#edit_message').css('color', 'orangered').html(result);

	}
		
	});	
				
			}
			
		}
		
	});	

});

		
   	  




$(function() {
    var pressed = false;
    var start = undefined;
    var startX, startWidth;
    
    $("table th").mousedown(function(e) {
        start = $(this);
        pressed = true;
        startX = e.pageX;
        startWidth = $(this).width();
        $(start).addClass("resizing");
    });
    
    $(document).mousemove(function(e) {
        if(pressed) {
            $(start).width(startWidth+(e.pageX-startX));
        }
    });
    
    $(document).mouseup(function() {
        if(pressed) {
            $(start).removeClass("resizing");
            pressed = false;
        }
    });
});

$.event.special.inputchange = {
    setup: function() {
        var self = this, val;
        $.data(this, 'timer', window.setInterval(function() {
            val = self.value;
            if ( $.data( self, 'cache') != val ) {
                $.data( self, 'cache', val );
                $( self ).trigger( 'inputchange' );
            }
        }, 20));
    },
    teardown: function() {
        window.clearInterval( $.data(this, 'timer') );
    },
    add: function() {
        $.data(this, 'cache', this.value);
    }
};



$('input#pupils_id').on('inputchange', function() { 

console.log(this.value); 

pupils_id = this.value;

$.post('get-pupils-fee.php', { pupils_id:pupils_id }, function(result){

if($.isNumeric(parseInt(result))){

	$('input#fee').val(parseInt(result));
	$('input#total_fee').val(parseInt(result) + 50.00);
	
}
else{

	alert(result);
	$('input#fee').val(0.00);
	$('input#total_fee').val(0.00);	

}
	
});
$.post('get-pupils-clientsid.php', { pupils_id:pupils_id }, function(result){

	//alert(result);
	$('input#clients_id').val(result);
	
});

$.post('get-pupils-firstname.php', { pupils_id:pupils_id }, function(result){

	$('input#firstname').val(result);
	
});

$.post('get-pupils-lastname.php', { pupils_id:pupils_id }, function(result){

	$('input#lastname').val(result);
	
});
$.post('get-pupils-licenceno.php', { pupils_id:pupils_id }, function(result){

	$('input#licenceno').val(result);
	
});

$.post('get-pupils-appref.php', { pupils_id:pupils_id }, function(result){

	$('input#appreference').val(result);
	
});

$.post('get-pupils-add1.php', { pupils_id:pupils_id }, function(result){

	$('input#addline1').val(result);
	
});

$.post('get-pupils-add2.php', { pupils_id:pupils_id }, function(result){

	$('input#addtown').val(result);
	
});
$.post('get-pupils-addpc.php', { pupils_id:pupils_id }, function(result){

	$('input#addpc').val(result);
	
});

$.post('get-pupils-tel.php', { pupils_id:pupils_id }, function(result){

	$('input#telephone').val(result);
	
});

$.post('get-pupils-email.php', { pupils_id:pupils_id }, function(result){

	$('input#email').val(result);
	
});
});
//this part is for the add new pupil where it retrieves email and number for ADI
$('input#clients_id').on('inputchange', function() { 

console.log(this.value); 

clients_id = this.value;


$.post('get-clients-email.php', { clients_id:clients_id }, function(result){
    
	a=result.replace('\ufeff','');
	b=a.replace(String.fromCharCode('\ufeff', ''));
	$('input#email_address').attr('value',b);
});

$.post('get-clients-tel.php', { clients_id:clients_id }, function(result){
   
   a=result.replace('\ufeff','');
	b=a.replace(String.fromCharCode('\ufeff', ''));
	$('input#Telephone').attr('value',b);
});
});	


	
$('input.edit_fee').on('inputchange', function() { 

console.log(this.value); 

chorni = this.value;

chorni_total = parseInt(chorni) + 50.00; 

$('input.edit_fee_total').val(''+chorni_total+'.00');

});	

});
</script>

<script>

$( ".button" ).button();
$( "#radioset" ).buttonset();

</script>

  <script>
  $( function() {
  
    $( "#date_of_birth" ).datepicker({
          showOn: "button",
      buttonImage: "images/ar.png",
      buttonImageOnly: true,
      buttonText: "Select date",    
        dateFormat: 'dd.mm.yy'
    });
    
    $('#applied_on').datepicker({
          showOn: "button",
      buttonImage: "images/ar.png",
      buttonImageOnly: true,
      buttonText: "Select date",    
        dateFormat: 'dd.mm.yy'
    });
    
    $('#eligible_date').datepicker({
          showOn: "button",
      buttonImage: "images/ar.png",
      buttonImageOnly: true,
      buttonText: "Select date",    
        dateFormat: 'dd-mm-yy'
    });        
    
    $('#theory_exp').datepicker({
          showOn: "button",
      buttonImage: "images/ar.png",
      buttonImageOnly: true,
      buttonText: "Select date",    
        dateFormat: 'dd-mm-yy'
    });    
    
    $('#booked_on,#booked_for,#temp_booking_date,#temp_booking_booked_on,#payment_date').datetimepicker({
          showOn: "button",
      buttonImage: "images/ar.png",
      buttonImageOnly: true,
      buttonText: "Select date",    
        dateFormat: 'dd-mm-yy',
        timeFormat: 'hh:mm:ss',
    });
      
  } );
  

  
  
function toTimestamp(strDate){
 var datum = Date.parse(strDate);
 return datum/1000;
}  
  
  </script>
  
</body>
</html>