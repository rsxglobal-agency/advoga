@extends('layouts.master')

@section('content') 

 <div><h2>Busca / Resultados</h2></div>

          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">

                           <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                      <div class="profile-activity">
                                          <div class="act-time">
                                            
                                              @forelse($results as $user)  
                                               <div class="activity-body act-in" data-id="">
                                                  <span class="arrow"></span>
                                                  <div class="text">
                                                      <a href="#" 
                                                      data-target="modal-perfil" 
                                                      class="activity-img perfilmodal">

                                                            @if($user->image!='')   
                                                                 <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ $user->image }}" height="500" width="500"/>
                                                             @else
                                                                <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}" height="500" width="500"/>
                                                             @endif
                                                      </a>
                                                      <p class="attribution"><a href="#" data-target="#modal-perfil" class="perfilmodal" data-userid="{{$user->id}}">{{$user->name}}</a>  <br>
                                                    
                                                      <!-- Votação de Estrelas -->

                                                          @if ($user->rate >=1 )
                                                          <span><i class="icon_star"></i></span>
                                                          @else 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          @endif

                                                          @if ($user->rate >=2 )
                                                          <span><i class="icon_star"></i></span>
                                                          @else 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          @endif
    
                                                          @if ($user->rate >=3 )
                                                          <span><i class="icon_star"></i></span>
                                                          @else 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          @endif
    
                                                          @if ($user->rate >=4 )
                                                          <span><i class="icon_star"></i></span>
                                                          @else 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          @endif
    
                                                          @if ($user->rate >=5 )
                                                          <span><i class="icon_star"></i></span>
                                                          @else 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          @endif


                                                       <!-- Votação de Estrelas -->


                                                      <div align="right">
                                                      <td>
                                                      @if(!Auth::user()->tour)
                                                          <li class="btn btn-default btn-sm">
                                                            <a href="#" 
                                                               data-page  ="res-busca-prof" 
                                                               data-demand='{"id":""}' 
                                                               data-to    ='{"id":"{{$user->id}}","nome":"{{$user->name}}"}'
                                                               
                                                               class="btn-open-chat">
                                                        <font color="black"><i class="icon_chat"></i> Chat</font></a>
                                                          
                                                          </li></font>  @endif
                                                       </td>
                                                       </div>
                                                  </div>
                                              </div><br/>
                                        
                                              @empty
                                                <p>Nenhum candidato encontrado!</p>
                                                <p><a class="btn btn-default btn-sm" href="{{URL::to('/busca/')}}">Nova busca</a></p>
                                              @endforelse
                                          </div>
                                      </div>
                                  </div>

                 </div>
</div> 

</fieldset>
</form>
</div>
    </div>
@include("includes.modalperfil")

@endsection
