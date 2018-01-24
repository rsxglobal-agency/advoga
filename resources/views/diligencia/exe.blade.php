@extends('layouts.master')

@section('content')

 <div><h2>Diligências em Execução</h2></div>

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
                                                      <a href="#" class="activity-img">
                                                         @if($demand->user->image!='')   
                                                             <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ $demand->user->image }}" height="500" width="500"/>
                                                         @else
                                                            <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}" height="500" width="500"/>
                                                         @endif
                                                      </a>
                                                      <p class="attribution"><a href="#">{{$demand->user->name}}</a>  <br>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star-half_alt"></i></span>
                                                      <span><i class="icon_star_alt"></i></span></p>
                                                      <tr><br>

                                                          <th><strong> {{ $demand->name }}</strong></th><br>
                                 
                                                                                           <th>                                                          
                                                          <p class="attribution"><i class="icon_pin_alt"></i>{{ $demand->state->name }}, {{ $demand->city->name }}</span> - <i class="icon_calendar"></i> {{ $demand->created_at->format('d-m-Y') }} - <i class="icon_clock"></i> {{ $demand->created_at->format('H:i') }}</p>
                                                         <td><th><strong>Áreas de Atuação: </strong></th> {{$demand->atuations}} </td><br>
                                                         <td><strong>Serviços Prestados: </strong> {{$demand->services}} </td><br>
                                                          <td><strong>Descrição: </strong>{{ $demand->description }}</td>
                                                          </th>
                                                          </tr>

                                                      <div align="right">
                                                      <td>

                                                      <li class="btn btn-default btn-sm"><a href="#" class="btn-concluir-demanda" data-user-id="{{$demand->user_id}}"  data-id="{{$demand->id}}"><font color="green"><i class="icon_check"><font color="black"></i> Concluída</font></font></a></li>


                                                      <li class="btn btn-default btn-sm">
                                                            <a href="#" 
                                                               data-page  ="diligencias-exe" 
                                                               data-demand='{"id":"{{$demand->id}}","name":"{{$demand->name}}","executor_id":"{{$demand->executor_id}}","user_name":"{{$demand->user->name}}","user_id":"{{$demand->user->id}}"}' 
                                                               data-to    ='{"id":"{{$demand->user->id}}","nome":"{{$demand->user->name}}"}'
                                                               class="btn-open-chat">
                                                        <font color="black"><i class="icon_chat"></i> Chat</font></a>
                                                      </li>


                                                      <li class="btn btn-default btn-sm"><a class="btn-desistir-demanda" href="#" data-cancelar="desistirdemanda" data-id="{{$demand->id}}"><font color="black"><i class="icon_trash" ></i> Cancelar</a></font></li>
                                                         </td>
                                                       </div>
                                                  </div>
                                              </div><br>
                                               @endforeach
                                          </div>
                                           

                                              </div>
                                          </div>

                                      </div>
                                  </div>




  </div>
</div>

</fieldset>
</form>
</div>
    </div>

 <div class="modal fade modal-lg" tabindex="-1" role="dialog" id="modal-estrelas">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">
        Avalie o serviço:

         <div class='rating-stars text-center'>
    <ul id='stars'>
      <li class='star' title='Poor' data-value='1'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Fair' data-value='2'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Good' data-value='3'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Excellent' data-value='4'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='WOW!!!' data-value='5'>
        <i class='fa fa-star fa-fw'></i>
      </li>
    </ul>
  </div>
  <input type="hidden" name="demand_rating" value="0" id="demand_rating">
  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


<script type="text/javascript">

  $(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    alert($("#demand_rating").val());
   

    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    
    $.ajax({
            url : "{{ asset('/avaliar-demanda/') }}",
            data   : {
                     demand_id : $("#demand_rating").val(),
                     stars : ratingValue
            },
            type: 'POST'
          }).done(function(data){

               $("#modal-estrelas").modal("hide");
          });
      
  });
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}


</script>


@endsection
