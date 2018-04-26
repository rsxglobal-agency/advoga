@extends('layouts.master')

@section('content')

 <div><h2>Chat</h2></div>
 @if(!Auth::user()->tour)
         <div class="container">
              <div class="row">
                  
                    @forelse ($conversations as $conv)
                    
                       <div class="col-xs-6 col-sm-4 col-md-3">
                			<div class="project project-default">
                				<div class="project-content">
                                    <div class="col-xs-12">
                                         @if($conv->other->image!='')  
                                          <div class="chat-avatar" style="background-image: url('{{URL::to('/uploads/avatars')}}/{{ $conv->other->image }}');">
                                         @else 
                                          <div class="chat-avatar" style="background-image: url('{{ URL::to('/img/avatar/default.jpg') }}');">
                                         @endif
                                            <?php /*
                                                 <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ $conv->other->image }}"/>
                                             @else
                                                <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}"/>
                                             @endif
                                            */ ?>
                                        </div>
                                    </div>
                					<h3 class="lead">
                						{{$conv->other->name}}
                					</h3>
                                     <p class="text-center">
  						                   <a href="#" 
                                 
                                                data-page    = "chat-page" 
                                                data-demand  = '{"id":""}'
                                                data-to      = '{"id":"{{$conv->other->id}}","name":"{{$conv->other->name}}"}'
                                                data-conv_id = "{{$conv->id}}" 
                                                class="btn btn-default btn-sm btn-open-chat">
                                                <font color="black"><i class="icon_chat"></i> Chat</font>
                                          </a>
                                        

                               <!--- nome demanda -->             
                          @if($conv->demand!=null)
                          <h4 class="lead"> Chat Referente a demanda: {{$conv->demand->name}}</h4>
                         
                          @endif
                					</p>
                				</div>
                			</div>
                		</div>
                    @empty
                        <div class="col-md-12">
                            <h3 class="text-center">Nenhuma conversa encontrada</h3>
                       </div>
                    @endforelse
                
                
                 <?php /*   
                <div class="col-xs-6 col-sm-4 col-md-3">
            		<div class="project project-success">
        				<div class="shape">
        					<div class="shape-text">
        						top								
        					</div>
        				</div>
        				<div class="project-content">
        					<h3 class="lead">
        						Project label
        					</h3>
        					<p>
        						And a little description.
        						<br> and so one
        					</p>
        				</div>
        			</div>
        		</div>
        
                <div class="col-xs-6 col-sm-4 col-md-3">
                	<div class="project project-radius project-primary">
        				<div class="shape">
        					<div class="shape-text">
        						top								
        					</div>
        				</div>
        				<div class="project-content">
        					<h3 class="lead">
        						Project label
        					</h3>
        					<p>
        						And a little description.
        						<br> and so one
        					</p>
        				</div>
        			</div>
        		</div>
        
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <div class="project project-info">
        				<div class="shape">
        					<div class="shape-text">
        						top								
        					</div>
        				</div>
        				<div class="project-content">
        					<h3 class="lead">
        						Project label
        					</h3>
        					<p>
        						And a little description.
        						<br> and so one
        					</p>
        				</div>
        			</div>
        		</div>
                
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <div class="project project-radius project-warning">
        				<div class="shape">
        					<div class="shape-text">
        						top								
        					</div>
        				</div>
        				<div class="project-content">
        					<h3 class="lead">
        						Project label
        					</h3>
        					<p>
        						And a little description.
        						<br> and so one
        					</p>
        				</div>
        			</div>
        		</div>
                
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <div class="project project-radius project-danger">
        				<div class="shape">
        					<div class="shape-text">
        						top								
        					</div>
        				</div>
        				<div class="project-content">
        					<h3 class="lead">
        						Project label
        					</h3>
        					<p>
        						And a little description.
        						<br> and so one
        					</p>
        				</div>
        			</div>
        		</div>
                
                */ ?>
                
          </div><!--/row-->
        </div>    
                                                     
                                   <?php /*
                                                        
                                                          @if(Auth::user()->id==$conversation->from_user)
                                                          <div class="col-sm-6">
                                                                <a href="#" class="activity-img">
                                                                        @if(Auth::user()->image!='')   
                                                                             <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ Auth::user()->image }}" height="200" width="200"/>
                                                                         @else
                                                                            <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}" height="200" width="200"/>
                                                                         @endif
                                                                  </a>
                                                          </div>
                                                         @else
                                                          <div class="col-sm-6">
                                                              <a href="#" class="activity-img">
                                                                    @if(Auth::user()->image!='')   
                                                                         <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ Auth::user()->image }}" height="200" width="200"/>
                                                                     @else
                                                                        <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}" height="200" width="200"/>
                                                                     @endif
                                                              </a>
                                                         </div>
                                                         @endif
                                                         
                                            
                                        
                                                  
                                                
                                                  <span class="arrow"></span>
                                                  <div class="text">
                                                      <a href="#" class="activity-img">
                                                            @if($user->image!='')   
                                                                 <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ $user->image }}" height="200" width="200"/>
                                                             @else
                                                                <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}" height="200" width="200"/>
                                                             @endif
                                                      </a>

                                                      <div align="right">
                                                      <td>
                                                          <li class="btn btn-default btn-sm">
                                                            <a href="#" 
                                                               data-page  ="res-busca-prof" 
                                                               data-demand='{"id":""}' 
                                                               data-to    ='{"id":"{{$user->id}}","nome":"{{$user->name}}"}'
                                                               class="btn-open-chat">
                                                        <font color="black"><i class="icon_chat"></i> Chat</font></a>
                                                          
                                                          </li></font>
                                                       </td>
                                                       </div>
                                                  </div>
                                                  */ ?>


 @endif
@endsection
