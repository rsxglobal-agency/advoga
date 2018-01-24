<!-- Modal para visualização de perfil -->


<div class="modal fade modal-lg" tabindex="-1" role="dialog" id="modal-perfil">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        
        <h4 class="modal-title" align="center" id="modal_user_name"></h4>
      </div>
      <div class="modal-body">


<table id="modal_user_table">
  <tr>
    <th rowspan="5"  align="center">
         <img alt="" id="modal_user_image" src="<?php echo e(URL::to('/img/avatar/default.jpg')); ?>" height=150"/>
         <div align="center" id="modal_user_rate"></div>
    </th>
  </tr>
  

</table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


<!-- Modal para visualização de perfil -->

<script type="text/javascript">
  
$(".perfilmodal").on("click", function(){
  var id=$(this).attr("data-userid");

$("#modal_user_table").find("tr:gt(0)").remove();

 $.ajax("<?php echo e(asset('/user/')); ?>/"+id).done(function(data){
  
  if (data.image.length>0){
    $("#modal_user_image").attr('src',"<?php echo e(asset("/uploads/avatars/")); ?>/"+data.image);

  } else{
    $("#modal_user_image").attr('src',"<?php echo e(URL::to("/img/avatar/default.jpg")); ?>");
  }
  $("#modal_user_name").html(data.name);
  $("#modal_user_table").append("<tr><td><h5><b>Descrição</b><br>"+data.description+"</h5></td></tr>");
  $("#modal_user_table").append("<tr><td><h5><b>Titulação</b><br>"+data.titulation.name+"</h5></td></tr>");
  userrate(data.rate);
  $("#modal_user_table").append("<tr><td><h5><b>Cidade/Estado</b><br>"+data.city.name+", "+data.state.name+"</h5></td></tr>");
  
  var atuations="";
  $.each(data.atuations, function( index, value ) {
  atuations+=value.name+", ";
  });
  if(data.atuations.length>0){

  $("#modal_user_table").append("<tr><td><h5><b>Áreas de Atuação</b><br>"+atuations.substring(0, atuations.length - 2)+"</h5></td></tr>");

  }

  var services="";
 $.each(data.services, function( index, value ) {
  services+=value.name+", ";
  });
 if(data.services.length>0){

  $("#modal_user_table").append("<tr><td><h5><b>Serviços Prestados</b><br>"+services.substring(0, services.length - 2)+"</h5></td></tr>");

  }

$("#modal-perfil").modal("show");
});

});

function userrate(rate){

    var ret="";


   if (rate >=1 )
    ret+='<span><i class="icon_star"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt"></i></span>';
    

    if (rate >=2 )
    ret+='<span><i class="icon_star"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt"></i></span>';
    
    
    if (rate >=3 )
    ret+='<span><i class="icon_star"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt"></i></span>';
    
    
    if (rate >=4 )
    ret+='<span><i class="icon_star"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt"></i></span>';
   
    
    if (rate >=5 )
    ret+='<span><i class="icon_star"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt"></i></span>';
    
  $("#modal_user_rate").html(ret);

}



</script>