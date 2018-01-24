<!-- Modal para visualização de perfil -->


<div class="modal fade modal-lg" tabindex="-1" role="dialog" id="modal-perfil">
  <div class="modal-dialog" role="document" id="modal-dialog">
    <div class="modal-content" id="modal-content">
      <div class="modal-header" id="modal-header">
        <h4 class="modal-title" align="center" id="modal_user_name"></h4>
      </div>
      <div class="modal-body">


  <div class="container" id="container-modal">
    <div class="container-foto" id="container-foto">
     <div class="circular--portrait" id="circular--portrait--modal-perfil">
         <img alt="" id="modal_user_image" src="{{ URL::to('/img/avatar/default.jpg') }}" height="150"/>
         </div>
           <div align="center" id="modal_user_rate"></div>
   </div>

    <div class="container-table" id="container-table">
  <table id="modal_user_table">
  </table>
    </div>

</div>

</div>
      <div class="modal-footer" id="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="button">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

<!-- style -->
<style type="text/css">
#button{
    border-radius: 40px;
    background-color: #176963;
    color: white;
    -webkit-transition:all 1s ease;
    -o-transition:all 1s ease;
    transition:all 1s ease;
    height: 30px;
    margin-top: -4px;
    text-align: center;
    line-height: 10px;
  }

  #button:hover{
    background-color: #274C48;
    
    -webkit-transform: scale(1.1);
        -ms-transform: scale(1.1);
        transform: scale(1.1  );
   
  }

  #modal_user_name{
    color: #396D68;
    font-weight: 500;
  }

  #modal-content{
   border-radius: 10px; 
    background-color: white;

  }

  #modal-footer{
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
    background-color: #ecf0f1;
    height: 40px
  }
 
  #modal-header{
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
  }

/*  #modal_user_image{
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    margin-top: 5%;
    box-shadow: 0 0 3px rgba(0, 0, 0, .8);
    -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, .8);
    -moz-box-shadow: 0 0 3px rgba(0, 0, 0, .8);
  }*/

#circular--portrait--modal-perfil{
  position: relative;
  width: 200px;
  height: 200px;
  overflow: hidden;
  border-radius: 50%;
  -webkit-border-radius:50%;
  -moz-border-radius:50%;
  border: 1px solid #EEEEEE;
}

  #modal_user_image{
  width: 100%;
  height: auto;
}

  #modal_user_rate{
    margin-top: 10px; 
  }

  #container-modal{
      background-color: transparent;
      height: 100%;
      border: 0px solid;
      max-width: 100%;
      margin: 0;
      display: block;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      overflow-x: hidden;
      -ms-flex-wrap: nowrap;
          flex-wrap: nowrap;
      -webkit-box-orient: horizontal;
      -webkit-box-direction: normal;
          -ms-flex-direction: row;
              flex-direction: row;
     
  }

  #container-foto{
    width:200px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
  }

  #container-table{
    margin-left: 30px;
    width: 100%;
    height: 100%;

  }

  #icon_star_perfil{
    color: #176963;
  }

  #icon_star_perfil_alt{
    color: #176963;
  }

</style>

<!-- Modal para visualização de perfil -->

<script type="text/javascript">
  
$(".perfilmodal").on("click", function(){
  var id=$(this).attr("data-userid");

$("#modal_user_table").find("tr:gt(0)").remove();

 $.ajax("{{ asset('/user/') }}/"+id).done(function(data){
  
  if (data.image.length>0){
    $("#modal_user_image").attr('src',"{{asset("/uploads/avatars/")}}/"+data.image);

  } else{
    $("#modal_user_image").attr('src',"{{URL::to("/img/avatar/default.jpg")}}");
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
    ret+='<span><i class="icon_star" id="icon_star_perfil"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt" id="icon_star_perfil_alt"></i></span>';
    

    if (rate >=2 )
    ret+='<span><i class="icon_star"  id="icon_star_perfil"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt" id="icon_star_perfil_alt"></i></span>';
    
    
    if (rate >=3 )
    ret+='<span><i class="icon_star"  id="icon_star_perfil"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt" id="icon_star_perfil_alt"></i></span>';
    
    
    if (rate >=4 )
    ret+='<span><i class="icon_star"  id="icon_star_perfil"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt" id="icon_star_perfil_alt"></i></span>';
   
    
    if (rate >=5 )
    ret+='<span><i class="icon_star"  id="icon_star_perfil"></i></span>';
    else 
    ret+='<span><i class="icon_star_alt" id="icon_star_perfil_alt"></i></span>';
    
  $("#modal_user_rate").html(ret);

}



</script>