  @extends('layouts.master')

@section('content') 


  <!--teste leo-->
    <div class="flex-profile" id="flex-profile">
      <div class="flex-photo-header" id="flex-photo-header">
          <div class="circular--portrait" id="circular--portrait-flex-profile">  
         @if(Auth::user()->image!='')   
             <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ Auth::user()->image }}" width="150"   id="profile_user_image"/>
         @else
            <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}" width="150"   id="profile_user_image"/>
         @endif
          </div>
          <p class="titulation_name_header" id="titulation_name_header">{{Auth::user()->titulation->name}}</p>
           <div align="center" id="modal_user_rate_header">
                 @if (Auth::user()->rate >=1 )
                      <span><i class="icon_star" id="icon_star_header"></i></span>
                      @else 
                      <span><i class="icon_star_alt" id="icon_star_alt_header"></i></span>
                      @endif

                      @if (Auth::user()->rate >=2 )
                      <span><i class="icon_star" id="icon_star_header"></i></span>
                      @else 
                      <span><i class="icon_star_alt" id="icon_star_alt_header"></i></span>
                      @endif

                      @if (Auth::user()->rate >=3 )
                      <span><i class="icon_star" id="icon_star_header"></i></span>
                      @else 
                      <span><i class="icon_star_alt" id="icon_star_alt_header"></i></span>
                      @endif

                      @if (Auth::user()->rate >=4 )
                      <span><i class="icon_star" id="icon_star_header"></i></span>
                      @else 
                      <span><i class="icon_star_alt" id="icon_star_alt_header"></i></span>
                      @endif

                      @if (Auth::user()->rate >=5 )
                      <span><i class="icon_star" id="icon_star_header"></i></span>
                      @else 
                      <span><i class="icon_star_alt" id="icon_star_alt_header"></i></span>
                      @endif 
           </div>
      </div>
      <div class="flex-textos-header" id="flex-textos-header">
        <p class="name_header" id="name_header">{{Auth::user()->name}}</p>
        <p><i class="fa fa-globe" id="fa-globe"> <a href="{{Auth::user()->social}}" target="_blank" id="link_linkedin">{{Auth::user()->social}}</a></i>
        </p>
        <p id="text_local"><i class="icon_pin_alt" id="icon_local"></i>{{Auth::user()->state->name}}, {{Auth::user()->city->name}}</p>
      </div>
    </div>
  <!--final do teste-->

<!-- page start-->

 <div><h3>Feed de Demandas</h3></div>
<div class="row">
        <div class="col-lg-12">
            <section class="panel">

 
  <div class="panel-body">
     <div class="tab-content">
         <div id="recent-activity" class="tab-pane active">
             <div class="profile-activity">
                 <div class="act-time">
                 @foreach ($demands as $demand)
                     <div class="activity-body act-in" data-id="{{$demand->id}}">
                         <span class="arrow"></span>
                         <div class="text">

                        
                             <a href="#" 
                                
                                data-target="modal-perfil" 
                                class="activity-img perfilmodal"
                                data-userid="{{$demand->user->id}}">
                                    @if($demand->user->image!='')   
                                         <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ $demand->user->image }}" height="500" width="500"/>
                                     @else
                                        <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}" height="500" width="500"/>
                                     @endif
                             </a>

                             <p class="attribution"><a href="#"
                                data-target="#modal-perfil" class="perfilmodal" data-userid="{{$demand->user->id}}">{{ $demand->user->name }}</a>  <br>
    


                              <!-- Votação de Estrelas Feed Demanda -->

                                @if ( $demand->user->rate >=1 )
                                <span><i class="icon_star"></i></span>
                                @else 
                                <span><i class="icon_star_alt"></i></span>
                                @endif

                                @if ($demand->user->rate >=2 )
                                <span><i class="icon_star"></i></span>
                                @else 
                                <span><i class="icon_star_alt"></i></span>
                                @endif
    
                                @if ($demand->user->rate >=3 )
                                <span><i class="icon_star"></i></span>
                                @else 
                                <span><i class="icon_star_alt"></i></span>
                                @endif
    
                                @if ($demand->user->rate >=4 )
                                <span><i class="icon_star"></i></span>
                                @else 
                                <span><i class="icon_star_alt"></i></span>
                                @endif
    
                                @if ($demand->user->rate >=5 )
                                <span><i class="icon_star"></i></span>
                                @else 
                                <span><i class="icon_star_alt"></i></span>
                                @endif

                               <!-- Votação de Estrelas Feed Demanda -->

                             <tr><br>

                                 <th><strong> {{ $demand->name }}</strong></th><br>
                                 <p class="attribution"><i class="icon_pin_alt"></i>{{ $demand->state->name }}, {{ $demand->city->name}}</span> - <i class="icon_calendar"></i> {{ $demand->created_at->format('d-m-Y') }} - <i class="icon_clock"></i> {{ $demand->created_at->format('H:i') }}</p>
                                 <th><br>
                                 <td><th><strong>Áreas de Atuação: </strong></th> {{$demand->atuations}} </td><br>
                                 <td><strong>Serviços Prestados: </strong> {{$demand->services}} </td><br>
                                 <td><strong>Descrição: </strong>{{ $demand->description }}</td>
                                 </th>
                                 </tr>

                             <div align="right">
                               <div  align="right">
                                <td>
                                <br/>

                                @if(!Auth::user()->EscondeBotao)

                                <li href="#" data-id="{{ $demand->id }}" class="btn btn-success btn-sm">Aceitar Demanda</li>
                                @endif

                                   </td>
                              </div>

                         </div>

                     </div><br>
                      
                 </div>
                 @endforeach

                     </div>
                 </div>

             </div>
         </div>

<!-- Modal para edição de perfil -->         
         
<div class="modal fade modal-lg" tabindex="-1" role="dialog" id="modal-alerta">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">

        <div align="center">
        <h3>Olá {{Auth::user()->name}},</h3><br> 
        complete seu cadastro em "Editar Perfil" e aumente suas chances de ser contratado!
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

<!-- FIM do Modal para edição de perfil -->
@include("includes.modalperfil")

<style type="text/css">

 .row{
  max-width: 92.5%;
 }

@media (max-width: 599px) {
  .row{
    max-width: 100%;
  }
}


@media (max-width: 599px) {
  .panel{
    max-width: 100%;
    margin-left: 5%;
  }
}


  #flex-profile{
     background-color: #396d68;
      height: 100%;
      border: 0px solid;
      max-width: 90%;
      margin: 0;
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
      border-radius: 5px;
      -webkit-border-radius:5px;
      -moz-border-radius:5px;
}

@media (max-width: 599px) {
  #flex-profile{
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    max-width: 100%;
  }
}


  #flex-photo-header{
    background-color: transparent;
    margin-left: 5%;
    text-align: center;
    margin-top: 1%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
  }

@media (max-width: 599px) {
  #flex-photo-header{
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    max-width: 100%;
  }
}

#circular--portrait-flex-profile{
  position: relative;
  width: 100px;
  height: 100px;
  overflow: hidden;
  border-radius: 50%;
  border: 1px solid #EEEEEE;
}

@media (max-width: 599px) {
    #circular--portrait-flex-profile{
      -ms-flex-item-align: center;
          align-self: center;
    }
  }

  #profile_user_image{
  width: 100%;
  height: auto;
}

  #flex-textos-header{
  width: 100%;
  background-color: transparent;
  text-align: center;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
 }

  #modal_user_rate_header{
  margin-bottom: 10%;
  margin-top: -8%;
 }

 @media (max-width: 599px) {
  #modal_user_rate_header{
    -ms-flex-item-align: center;
        align-self: center;
    margin-bottom: 0;
    margin-top: 0;
  }
 }

  #icon_star_header{
    color:   #f9f9f9;
  }

  #icon_star_alt_header{
    color:   #f9f9f9;
  }

  #titulation_name_header{
    color: #f9f9f9;
    font-family: Ebrima;  
  }

  #name_header{
    font-size: 3.2rem;
    color: #f9f9f9;
    font-family: Ebrima;  
  }

  #fa-globe{
  color: #f9f9f9;
  font-size: 2rem;
  }

  #link_linkedin{
    font-size: 1.5rem;
    color: #f9f9f9;
    font-weight: 100;
    text-decoration: none;
    margin-left: 10px;
    border-bottom: 0.5px solid #f9f9f9;
    font-family: Ebrima Regular;
  }

  #icon_local{
  color: #f9f9f9;
  font-size: 2rem;
  margin-right: 8px;
  }

  #text_local{
  color: #f9f9f9;
  font-size: 1.5rem;
  margin-left: 10px;
  font-family: Ebrima Regular;
  }
</style>

<!-- page end-->

<script type="text/javascript">
  
$(".btn-success").on("click", function(){
  var id=$(this).attr("data-id");
  $.ajax("{{ asset('/aceitar/') }}/"+id).done(function(data){
    $("div[data-id='"+id+"']").remove();
  });

});
$(document).ready(function($){
@if (Auth::user()->created_at==Auth::user()->updated_at)

  // method to be executed;
  $('#modal-alerta').modal('show');
       

@endif
});



</script>
@endsection
