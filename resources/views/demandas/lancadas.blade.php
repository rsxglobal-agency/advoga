@extends('layouts.master')

@section('content')

 <div><h2>Demandas Lançadas</h2></div>

          <div class="row">
                 
                      <section class="panel">
                           <div class="panel-body">
                           @forelse ($demands as $demand)
                              <div class="tab-content" data-id="{{$demand->id}}">
                                  <div id="recent-activity" class="tab-pane active">
                                        <div class="profile-activity">
                                          <div class="act-time">
                                              <div class="activity-body act-in">
                                                  <span class="arrow"></span>
                                                  <div class="text">

                                                      <tr>

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
                                                        @if(!Auth::user()->tour)
                                                      <li class="btn btn-default btn-sm"><a href="{{ asset('/demands/'.$demand->id.'/edit') }}" ><font color="black"><i align="center" class="icon_pencil-edit"></i> Editar</font></a></li>
                                                      <li class="btn btn-default btn-sm"><a href="{{ asset('/demanda/cadidatos/'.$demand->id.'/') }}"><font color="black"><i class="icon_contacts"></i> Candidatos</font></a></li>
                                                      <li class="btn btn-default btn-sm"><a href="#" class="btn-excluir-demanda" data-id="{{$demand->id}}" ><font color="black"><i class="icon_trash"></i> Excluir</font></a></li>
                                                      @endif
                                                         </td>
                                                       </div>
                                                  </div>
                                              </div>
                                            </div>
                                         
                                              </div>
                                          </div>

                                      </div>
                                       @empty
                                      <p>Não existem demandas lançadas!</p>
                                        @endforelse
                                  </div>




  </div>
</div>

</fieldset>
</form>
</div>
    </div>


<script type="text/javascript">
 
/*  
$(".btn-excluir").on("click", function(){
    
    e.preventDefault();
    
  var id=$(this).attr("data-id");
  
  $.ajax("{{ asset('/removerdemanda/') }}/"+id).done(function(data){
    $("div[data-id='"+id+"']").remove();
  });
  

});

$(".btn-concluida").on("click", function(){
  var id=$(this).attr("data-id");
  $.ajax("{{ asset('/demandaconcluida/') }}/"+id).done(function(data){
    $("div[data-id='"+id+"']").remove();
  });

});
*/


</script>

@endsection
