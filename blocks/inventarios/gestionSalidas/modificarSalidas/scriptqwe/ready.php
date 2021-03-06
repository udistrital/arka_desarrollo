<?php

?>

// Asociar el widget de validación al formulario
              $("#modificarEntradas").validationEngine({
            promptPosition : "centerRight", 
            scroll: false,
            autoHidePrompt: true,
            autoHideDelay: 2000
	         });
	
        
        $(function() {
            $("#modificarEntradas").submit(function() {
                $resultado=$("#modificarEntradas").validationEngine("validate");
       
                if ($resultado) {
                
                    return true;
                }
                return false;
            });
        });
        
        
        $('#<?php echo $this->campoSeguro('nombreActa')?>').attr('disabled','');
        
        $( "#<?php echo $this->campoSeguro('actualizarActa')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('actualizarActa')?>").val())
            {
                case '0':
                
                      $("#<?php echo $this->campoSeguro('cargaActo')?>").css('display','none');
                    
                break;
            
                case '1':
                    
                   $("#<?php echo $this->campoSeguro('cargaActo')?>").css('display','block');

                break;
             }
          });  
          
                 $('#<?php echo $this->campoSeguro('nombreProduccion')?>').attr('disabled','');
        
        $( "#<?php echo $this->campoSeguro('actualizarActaS')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('actualizarActaS')?>").val())
            {
                case '0':
                
                      $("#<?php echo $this->campoSeguro('cargaActoS')?>").css('display','none');
                    
                break;
            
                case '1':
                    
                   $("#<?php echo $this->campoSeguro('cargaActoS')?>").css('display','block');

                break;
             }
          }); 
        $('#<?php echo $this->campoSeguro('nombreProduccion')?>').attr('disabled','');
        
        $( "#<?php echo $this->campoSeguro('actualizarActaP')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('actualizarActaP')?>").val())
            {
                case '0':
                
                      $("#<?php echo $this->campoSeguro('cargaActoP')?>").css('display','none');
                    
                break;
            
                case '1':
                    
                   $("#<?php echo $this->campoSeguro('cargaActoP')?>").css('display','block');

                break;
             }
          });
          
          
          
        $('#<?php echo $this->campoSeguro('nombreRecuperacion')?>').attr('disabled','');
        
        $( "#<?php echo $this->campoSeguro('actualizarActaRc')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('actualizarActaRc')?>").val())
            {
                case '0':
                
                      $("#<?php echo $this->campoSeguro('cargaActoRc')?>").css('display','none');
                    
                break;
            
                case '1':
                    
                   $("#<?php echo $this->campoSeguro('cargaActoRc')?>").css('display','block');

                break;
             }
          });
          
          
        

                     $('#tablaTitulos').dataTable( {
                "sPaginationType": "full_numbers"
                 } );


             
                  $('#<?php echo $this->campoSeguro('nombreCotizacion')?>').attr('disabled','');
                  
        $( "#<?php echo $this->campoSeguro('clase')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('clase')?>").val())
            {
                           
                case '1':
                    
                   $("#<?php echo $this->campoSeguro('reposicion')?>").css('display','block');
                   $("#<?php echo $this->campoSeguro('donacion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('sobrante')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('produccion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('recuperacion')?>").css('display','none');
                   

                break;
                
                
                       case '2':
                    
                    $("#<?php echo $this->campoSeguro('reposicion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('donacion')?>").css('display','block');
                   $("#<?php echo $this->campoSeguro('sobrante')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('produccion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('recuperacion')?>").css('display','none');
                break;
                
                        case '3':
                    
           $("#<?php echo $this->campoSeguro('reposicion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('donacion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('sobrante')?>").css('display','block');
                   $("#<?php echo $this->campoSeguro('produccion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('recuperacion')?>").css('display','none');

                break;
                
                        case '4':
                    
         $("#<?php echo $this->campoSeguro('reposicion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('donacion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('sobrante')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('produccion')?>").css('display','block');
                   $("#<?php echo $this->campoSeguro('recuperacion')?>").css('display','none');

                break;
                
                        case '5':
                    
                        $("#<?php echo $this->campoSeguro('reposicion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('donacion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('sobrante')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('produccion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('recuperacion')?>").css('display','block');
                break;
                
                
                default:
                
                         $("#<?php echo $this->campoSeguro('reposicion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('donacion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('sobrante')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('produccion')?>").css('display','none');
                   $("#<?php echo $this->campoSeguro('recuperacion')?>").css('display','none');
                   
                   break;
                
                
             }
          });  
                 
             $('#<?php echo $this->campoSeguro('fecha_contrato')?>').datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: 0,
		changeYear: true,
		changeMonth: true,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
			
			
		});
		
		
		   $('#<?php echo $this->campoSeguro('fecha_factura')?>').datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: 0,
		changeYear: true,
		changeMonth: true,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
			
			
		});
             
             
                 
        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: 0,
		changeYear: true,
		changeMonth: true,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		    onSelect: function(dateText, inst) {
			var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker('getDate'));
			$('input#<?php echo $this->campoSeguro('fecha_final')?>').datepicker('option', 'minDate', lockDate);
			},
			onClose: function() { 
		 	    if ($('input#<?php echo $this->campoSeguro('fecha_inicio')?>').val()!='')
                    {
                        $('#<?php echo $this->campoSeguro('fecha_final')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
                }else {
                        $('#<?php echo $this->campoSeguro('fecha_final')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
                    }
			  }
			
			
		});
              $('#<?php echo $this->campoSeguro('fecha_final')?>').datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: 0,
		changeYear: true,
		changeMonth: true,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		    onSelect: function(dateText, inst) {
			var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_final')?>').datepicker('getDate'));
			$('input#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker('option', 'maxDate', lockDate);
			 },
			 onClose: function() { 
		 	    if ($('input#<?php echo $this->campoSeguro('fecha_final')?>').val()!='')
                    {
                        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
                }else {
                        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
                    }
			  }
			
	   });
	   
	   
        $('#<?php echo $this->campoSeguro('fecha_diponibilidad')?>').datepicker({
	        dateFormat: 'yy-mm-dd',
	        maxDate: 0,
	        changeYear: true,
	        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
				'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
				dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
				dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']
        });
        
        
        
                
         
        
        
        
          






