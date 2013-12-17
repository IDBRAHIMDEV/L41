@extends('layouts.admin')


@section('content')



{{ HTML::style('css/bootstrap-switch.css') }}

<!-- dataTables -->
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.min.js') }}
	{{ HTML::script('js/plugins/datatable/TableTools.min.js') }}
	{{ HTML::script('js/plugins/datatable/ColReorderWithResize.js') }}
	{{ HTML::script('js/plugins/datatable/ColVis.min.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.columnFilter.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.grouping.js') }}

<script type="text/javascript">

	$(document).ready(function(){

   
        $('.label-toggle-switch').on('switch-change', function (e, data) {
            
            var motif   = $('#motifId').val();
            var doc     = $(this).attr('id');
            var valeur  = (data.value == true) ? 1 : 0;

                $.ajax({
                   	type: "post",
                   	data: "motif="+motif+"&doc="+doc+"&valeur="+valeur,
					url: "{{ URL::to('motif/doc/affecte') }}",
					context: document.body
			    }).done(function(data) {         
                     
                      
                });
    });

		
	});

</script>


<style>
	.thaction{
		font-size: 20px;
		text-align: center !important;
	}
</style>


<br><br><br><br>

<div class="container">
	<div class="row-fluid">
		<div class="span12">
		    <input type="hidden" id="motifId" name="" value="{{ $motif->id }}">
			<legend>{{ $motif->nature->libelle }} > {{ $motif->libelle }} <span class="pull-right"> <a href="{{ URL::to('parametrage') }}" class="btn btn-primary"><i class=" icon-share-alt"></i> Retour</a> </span> </legend>
		</div>
	</div>

		<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									  Documents affectés
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Document</th>
											<th>Etat</th>
											
										</tr>
									</thead>
									<tbody>
                                       @foreach($motif->docs as $doc)
                                       
                                       <tr>
                                       	<td>{{ $doc->label }}</td>
                                       	<td>
                                       		<div class="control-group">
                                       			<div class="controls">
                                       				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       				<div class="label-toggle-switch make-switch" id="{{ $doc->id }}" data-on="primary" data-off="danger">
                                       					<input type="checkbox" checked />
                                       				</div>
                                       			</div>
                                       		</div>
                                       	</td>

                                       </tr>
										@endforeach

                                       @foreach($docs as $document)
                                         
                                         <?php $checked = ''; ?>
                                         @foreach($motif->docs as $doc)
                                           <?
                                              if($document->id == $doc->id){
                                              	$checked = '';
                                              	break;
                                              }
                                              else{
                                                $checked = 'checked';
                                              }
                                               
                                            ?>
                                         @endforeach

                                         @if($checked == 'checked')
                                       <tr>
                                       	<td>{{ $document->label }}</td>
                                       	<td>
                                       		<div class="control-group">
                                       			<div class="controls">
                                       				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       				<div class="label-toggle-switch make-switch" id="{{ $document->id }}" data-on="primary" data-off="danger">
                                       					<input type="checkbox"  />
                                       				</div>
                                       			</div>
                                       		</div>
                                       	</td>
                                       		
                                       </tr>
                                         @endif
                                       @endforeach


									</tbody>
								</table>
								
							</div>
						</div>
					</div>
                </div>

	</div>
</div>

{{ HTML::script('js/bootstrap-switch.min.js') }}

@stop