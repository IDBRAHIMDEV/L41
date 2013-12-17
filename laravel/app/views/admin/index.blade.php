@extends('layouts.admin')

@section('content')

{{HTML::script('js/charts.app.js')}}

  <style>
     .lime-color{
     	margin-bottom: 5px;
     	padding: 10px 1px;
     	color: white;
     	background-color: #8cbf26;
     }

     .red-color {
     	margin-bottom: 5px;
     	padding: 10px 1px;
     	color: white;
     	background-color: #e63a3a;
     }

     .blue-color {
     	margin-bottom: 5px;
     	padding: 10px 1px;
     	color: white;
     	background-color: #368ee0;
     }
  </style>

   <input type="hidden" id="date1" value="1970-01-01">
   <input type="hidden" id="date2" value="3000-01-01">

     <div class="container nav-hidden" id="content">
	  <div id="main">
		
		<div class="container-fluid">
		   
		   <br><br><br><br>
		   
		   <div class="row-fluid">
		   	<div class="span12" > 
               
                 <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
			        <i class="glyphicon glyphicon-calendar icon-calendar icon-large"></i>
			            <span></span> <b class="caret"></b>

			     </div>
			     
		   	 </div>
		   	 
		   </div>
<br>
		   <div class="row-fluid" align="center">
			   	<div class="span4 lime-color" align="center"><h1><i class="glyphicon-sort"></i></h1><h4> <span id="contrat">{{ $nbcontrat }}</span> Contrats</h4></div>
			   	<div class="span4 blue-color" align="center"><h1><i class="glyphicon-circle_question_mark"></i></h1><h4> <span id="demande">{{ $nbdemande }}</span> Demandes</h4></div>
			   	<div class="span4 red-color" align="center"><h1><i class="glyphicon-envelope"></i></h1><h4> <span id="message">{{ $nbmessage }}</span> Messages</h4></div>
		   </div>

		   <div class="row-fluid ">
		   	
		   	<div class="span6">

		   		<div class="box  box-bordered">
		   			<div class="box-title">
		   				<h3>
		   					<i class="icon-reorder"></i>
		   					 Nombre de demandes par etat
		   				</h3>
		   				<div class="actions">
		   					
		   					<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
		   				</div>
		   			</div>
		   			<div class="box-content" id="container1">
		   			</div>
		   		</div>

		   	</div>

		   	
		   	<div class="span6">
		   		
		   		<div class="box  box-bordered">
		   			<div class="box-title">
		   				<h3>
		   					<i class="icon-reorder"></i>
		   					Pourcentage de demandes par etat
		   				</h3>
		   				<div class="actions ">
		   					<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
		   				</div>
		   			</div>
		   			<div class="box-content" id="container2">
		   			</div>
		   		</div>

		   	</div>

		   </div>

           


           <div class="row-fluid">
           	<div class="span12">
           		
           		<div class="box  box-bordered">
		   			<div class="box-title">
		   				<h3>
		   					<i class="icon-reorder"></i>
		   					Nombre de demandes par nature
		   				</h3>
		   				<div class="actions">
		   					<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
		   				</div>
		   			</div>
		   			<div class="box-content" id="container3">
		   			</div>
		   		</div>

           	</div>
           </div>



           <div class="row-fluid">
           	<div class="span12">
           		
           		<div class="box  box-bordered">
		   			<div class="box-title">
		   				<h3>
		   					<i class="icon-reorder"></i>
		   					Durée moyenne de demandes par nature
		   				</h3>
		   				<div class="actions">
		   					<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
		   				</div>
		   			</div>
		   			<div class="box-content" id="container4">
		   			</div>
		   		</div>


           	</div>
           </div>

		</div>

	  </div>	
	</div>


{{ HTML::script('js/highcharts.js') }}
{{ HTML::script('js/modules/exporting.js') }}


@stop