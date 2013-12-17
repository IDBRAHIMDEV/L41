@extends('layouts.expert')

@section('content')

<script>
    
    $(document).ready(function(){
       chat_list() ;
    });

	$(function(){

		setInterval(function() {
          chat_list() ;
        }, 5000);

		$('#addMessage').click(function(){
                 message  = $('#message').val();
                 idUser   = $('#chatter').val();
                 
                 if(idUser != '') {
	                 	if(message != '') {

		                 	$.ajax({
		                 		type: "post",
		                 		data: "message="+message+"&user="+idUser,
		                 		url: "{{ URL::to('chat/nouveau') }}",
		                 		context: document.body
		                 	}).done(function(data) {
	                            $('#message').val('');
		                 		chat_list();
		                 	});

		                 
	                 }else{
	                 	alert('Merci de mettre un message');
	                 }
                 }else {
                 	alert('Merci de séléctionner une personne !')
                 }
                 
                  
     });  
     

});

function chat_list() {
   
			$.ajax({
				type: "get",
				data: "",
				url: "{{ URL::to('chat/1') }}",
				context: document.body
			}).done(function(data) {
                  $('.element').remove();
                  var obj = jQuery.parseJSON(data);
				  $('.insert').after(obj.content);
				  $('#experts').html(obj.users);

				   $('.userEx').click(function(){
				   	 $('.userEx').removeClass('select');
			         $(this).addClass('select');
			         $('#chatter').val(this.id);
			         $('.userSelected').html($(this).text());
			      });
			});
}	




</script>


<style>
	.ms-list > li {
		cursor: pointer;
	}
    
    .ms-list > li:hover {
    	 color: white;
		 background-color: #97DBC8;
	}

	.select {
		background-color: #A8C083;
	}

</style>

<br>
   <br>
   <br>
  <div class="container nav-hidden" id="content">
	
		<div id="main">
			<div class="container-fluid">
			
				
				<div class="row-fluid">
					<div class="span12">
						

						<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-comments-alt"></i>
									Chatter en ligne avec  <span class="userSelected">nos clients</span>
								</h3>
							</div>
                            <input type="hidden" name="chatter" id="chatter" value="">
							<div class="slimScrollDiv" style="position: relative; overflow: ; width: auto; height: 600px;">
							  <div data-visible="false" data-start="top" data-height="600" class="box-content nopadding" style="overflow: ; width: auto; height: 600px;">
								<ul class="messages withlist">
								    <li class="insert">
										
											<div class="text">
												<input type="text" class="input-block-level" placeholder="Votre message ici..." name="message" id="message">
											</div>
											<div class="submit">
												<button type="submit" id="addMessage"><i class="icon-share-alt"></i></button>
											</div>
										
									</li>

									<span id="content"></span>
								
								
									
								</ul>
								<div class="user-list">
									<h4>
									
									Client(s)
									
									</h4>
									<ul id="experts" class='ms-list'>
										
									</ul>
								</div>
							</div><div class="slimScrollBar ui-draggable" style="background: none repeat scroll 0% 0% rgb(102, 102, 102); width: 7px; position: absolute; top: 102px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 248.062px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
						</div>
					</div>
				</div>


					</div>
				</div>




               <hr>
             
		</div></div>



@stop