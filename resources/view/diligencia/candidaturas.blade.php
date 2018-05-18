@extends('layouts.master')

@section('content')

 <div><h2>Candidaturas</h2></div>

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
                                                                 <img alt="" src="{{ $demand->user->image }}" height="500" width="500"/>
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
                                 <p class="attribution"><i class="icon_pin_alt"></i>{{ $demand->state->name }}, {{ $demand->city->name}}</span> - <i class="icon_calendar"></i> {{ $demand->created_at->format('d-m-Y') }} - <i class="icon_clock"></i> {{ $demand->created_at->format('H:i') }}</p>
                                                          <th><br>
                                                         <td><th><strong>Áreas de Atuação: </strong></th> {{$demand->atuations}} </td><br>
                                                         <td><strong>Serviços Prestados: </strong> {{$demand->services}} </td><br>
                                                         <td><strong>Descrição: </strong>{{ $demand->description }}</td>
                                                         </th>
                                                          </tr>

                                                      <div align="right">
                                                      <td>
                                                        @if(!Auth::user()->tour)
                                                      <li class="btn btn-default btn-sm">
                                                      
                                                      <a href="#" 
                                                        data-page   = "candidaturas" 
                                                        data-demand = '{{$demand}}'
                                                        data-to     = '{"id":"{{$demand->user->id}}","nome":"{{$demand->user->name}}"}'
                                                        class="btn-open-chat">
                                                        <font color="black"><i class="icon_chat"></i> Chat</font></a>
                                                      </li>
                                                        
                                                      <li class="btn btn-default btn-sm"><a class="btn-cancelar-demanda" href="#" data-id="{{$demand->id}}"><font color="black"><i class="icon_trash" ></i> Cancelar</a></font></li>

                                                      @endif


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

<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-messaging.js"></script>

@endsection
