/* 
 * Creado por Cristian Nores.
 * @cristiannores
 
 */

$(document).ready(function() {
    console.log("Se cargo el documento pruebas js");
    
    $( "#tipo" )
    .change(function () {
      var str = "";
      $( "#tipo option:selected" ).each(function() {
        if($( this ).text() === 'Daños'){
            $('.damage').show();
        }
        if($(this).text() === 'Diferencias'){
            $('.damage').hide();
        }
        if($( this ).text() === 'Desconsolidacion daño'){
            $('.desconsolidacion').show();
            $('#consolidacion').hide();
             $('.consolidacion').hide();
        }
        if($(this).text() === 'Consolidacion daños'){
            $('#consolidacion').show();
            $('.desconsolidacion').hide();
            $('.consolidacion').show();
        }
        
        
      });
      
    })
    .change();
    
   
    
});

    


