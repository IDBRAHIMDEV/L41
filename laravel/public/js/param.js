$(document).ready(function(){

        $('.compagnie').click(function(){
            
            $('#codeCompagnie').hide();
            
            var id      = $(this).attr('id');
            var libelle = $('#'+id).text();
            var res = id.split("-");
           
            var site    = $('#'+res[0]+'-site').val();
            
            
            $('#compagnieId').val(id);
            $('#compagnieForm').attr('action', 'compagnie/update');
            $('#siteCompagnie').val(site);
            $('#libelleCompagnie').val(libelle);
           $('#modal-1').modal('show');

		}); 
    
		$('.gamme').click(function(){
            
            var id      = $(this).attr('id');
            var cie     = $('#'+id+'-cie').val();

            var code    = $('#'+id+'-code').text();
            var libelle = $('#'+id+'-libelle').text();
            
            $('#gammeId').val(id);
            $('#gammeForm').attr('action', 'gamme/update');
            $('#compagnie').val(cie);
            $('#codeGamme').val(code);
            $('#libelleGamme').val(libelle);
            $('#modal-2').modal('show');

		});


		$('.etatPower').click(function(){

            var id      = $(this).attr('id');
              
              $.ajax({
                   	type: "post",
                   	data: "id="+id,
					url: "gamme/power",
					context: document.body
			    }).done(function(data) {         
                      
                      $('#'+id+'-i').attr('src', data);
                      
                });

		});


		$('.motif').click(function(){
            
            var id      = $(this).attr('id');
            
            var nature  = $('#'+id+'-nature').val();
			
            var libelle = $('#'+id+'-libelle').text();
          
            $('#motifId').val(id);
            $('#motifForm').attr('action', 'motif/update');
            $('#nature').val(nature);
            $('#libelleMotif').val(libelle);
            $('#modal-4').modal('show');

		});


		$('.doc').click(function(){
            
            var id      = $(this).attr('id');
            var libelle = $('#'+id+'-libelleDoc').text();
            var description  = $('#'+id+'-descriptionDoc').text();

            $('#documentId').val(id);
            $('#documentForm').attr('action', 'document/update');
            $('#descriptionDocument').val(description);
            $('#libelleDocument').val(libelle);
            $('#modal-5').modal('show');

		});

   
        $('.label-toggle-switch').on('switch-change', function (e, data) {
            
            var idParam = $(this).attr('id');
            var valeur  = (data.value == true) ? 1 : 0;

                $.ajax({
                   	type: "post",
                   	data: "idParam="+idParam+"&valeur="+valeur,
					url: "parametrage/update",
					context: document.body
			    }).done(function(data) {         
                     
                      $('#'+idParam+'-i').removeClass('glyphicon-circle_arrow_right');
                      $('#'+idParam+'-i').addClass(data);
                });
    });


        $('.spinner').blur(function(){
            
            var idParam = $(this).attr('id');
            var valeur  = $(this).val();
                $.ajax({
                   	type: "post",
                   	data: "idParam="+idParam+"&valeur="+valeur,
					url: "parametrage/update",
					context: document.body
			    }).done(function(data) {         
                     
                      $('#'+idParam+'-i').removeClass('glyphicon-circle_arrow_right');
                      $('#'+idParam+'-i').addClass(data);
                });

        });
		
	});