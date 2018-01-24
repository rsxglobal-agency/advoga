@extends('layouts.master')

@section('content')

 <div><h2>Demanda / Candidados</h2></div>

          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">

                           <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                      <div class="profile-activity">
                                          <div class="act-time">
                                            
                                              @if($demand)
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
                
                                                                      <div align="right" style="display: none;">
                                                                      <td >
                                                                      <li class="btn btn-default btn-sm"><a href="{{ asset('/demands/'.$demand->id.'/edit') }}" ><font color="black"><i align="center" class="icon_pencil-edit"></i> Editar</font></a></li>
                                                                      <li class="btn btn-default btn-sm"><a href="#>" class="btn-excluir" data-id="{{$demand->id}}" ><font color="black"><i class="icon_trash"></i> Excluir</font></a></li>
                                                                         </td>
                                                                       </div>
                                                                  </div>
                                                              </div>
                                                            </div>
                                                         
                                                              </div>
                                                          </div>
                
                                                      </div>
                    
                                          
                                          
                                              @foreach ($demand->candidatos as $user)  
                                               <div class="activity-body act-in" data-id="{{$demand->id}}">
                                                  <span class="arrow"></span>
                                                  <div class="text">
                                                      <a href="#" class="activity-img">
                                                            @if($user->image!='')   
                                                                 <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ $user->image }}" height="500" width="500"/>
                                                             @else
                                                                <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}" height="500" width="500"/>
                                                             @endif
                                                      </a>
                                                      <p class="attribution"><a href="#">{{$user->name}}</a>  <br>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star-half_alt"></i></span>
                                                      <span><i class="icon_star_alt"></i></span></p>
                                                    
                                                    <div align="left">  
                                                        <tr>
                                                              <th>                                                          
                                                               <p class="attribution"><i class="icon_pin_alt"></i>{{ $user->state->name }}, {{ $user->city->name }}</span> - <i class="icon_calendar"></i> {{ $user->created_at->format('d-m-Y') }} - <i class="icon_clock"></i> {{ $user->created_at->format('H:i') }}</p>
                                                               <td><th><strong>Áreas de Atuação: </strong></th> {{$user->atuations}} </td><br>
                                                               <td><strong>Serviços Prestados: </strong> {{$user->services}} </td><br>
                                                              <?php /* <td><strong>Descrição: </strong>{{ $user->description }}</td> */ ?>
                                                              </th>
                                                        </tr>
                                                    </div>
                                                      <div align="right">
                                                      <td>
                                                          <?php /* <li class="btn btn-default btn-sm"><a href="#" ><font color="black"><i class="icon_chat"></i> Chat</a></li></font> */ ?>
                                                          <li class="btn btn-default btn-sm">
                                                            <a href="#" 
                                                               data-page  ="candidatos" 
                                                               data-demand='{"id":"{{$demand->id}}","name":"{{$demand->name}}","executor_id":"{{$demand->executor_id}}","user_name":"{{$demand->user->name}}","user_id":"{{$demand->user->id}}"}' 
                                                               data-to    ='{"id":"{{$user->id}}","nome":"{{$user->name}}"}'
                                                               class="btn-open-chat">
                                                               <font color="black"><i class="icon_chat"></i> Chat</a></font>
                                                           </li>
                                                       </td>
                                                       </div>
                                                  </div>
                                              </div><br/>
                                        
                                             @endforeach 
                                             
                                            @else
                                           <p>Demanda não encontrada!</p>
                                         @endif
                                          </div>
                                      </div>
                                  </div>

                 </div>
</div> 

</fieldset>
</form>
</div>
    </div>


@endsection
