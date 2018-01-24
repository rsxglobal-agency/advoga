<?php $__env->startSection('content'); ?>

 <div><h2>Chat</h2></div>
 
         <div class="container">
              <div class="row">
                  
                    <?php $__empty_1 = true; $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    
                       <div class="col-xs-6 col-sm-4 col-md-3">
                			<div class="project project-default">
                				<div class="project-content">
                                    <div class="col-xs-12">
                                         <?php if($conv->other->image!=''): ?>  
                                          <div class="chat-avatar" style="background-image: url('<?php echo e(URL::to('/uploads/avatars')); ?>/<?php echo e($conv->other->image); ?>');">
                                         <?php else: ?> 
                                          <div class="chat-avatar" style="background-image: url('<?php echo e(URL::to('/img/avatar/default.jpg')); ?>');">
                                         <?php endif; ?>
                                            <?php /*
                                                 <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ $conv->other->image }}"/>
                                             @else
                                                <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}"/>
                                             @endif
                                            */ ?>
                                        </div>
                                    </div>
                					<h3 class="lead">
                						<?php echo e($conv->other->name); ?>

                					</h3>
                                     <p class="text-center">
  						                 <a href="#" 
                                                data-page    = "chat-page" 
                                                data-demand  = '{"id":""}'
                                                data-to      = '{"id":"<?php echo e($conv->other->id); ?>","name":"<?php echo e($conv->other->name); ?>"}'
                                                data-conv_id = "<?php echo e($conv->id); ?>" 
                                                class="btn btn-default btn-sm btn-open-chat">
                                                <font color="black"><i class="icon_chat"></i> Chat</font>
                                          </a>
                					</p>
                				</div>
                			</div>
                		</div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-md-12">
                            <h3 class="text-center">Nenhuma conversa encontrada</h3>
                       </div>
                    <?php endif; ?>
                
                
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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>