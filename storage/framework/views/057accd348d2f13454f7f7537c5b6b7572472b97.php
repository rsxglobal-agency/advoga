

<?php $__env->startSection('content'); ?> 

 <div><h3>Chat</h3></div>

          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">

                           <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                      <div class="profile-activity">
                                          <div class="act-time">
                                            
                                              <?php $__empty_1 = true; $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                               <div class="activity-body act-in" data-id="">
                                                  <span class="arrow"></span>
                                                  <div class="text">
                                                    <div align="left">  
                                                          <a href="#" class="activity-img">


                                                             <?php if($conv->other->image!=''): ?>  
                                                        <img alt="" src="<?php echo e(URL::to('/uploads/avatars')); ?>/<?php echo e($conv->other->image); ?>">
                                                      <?php else: ?> 
                                                        <img alt="" src="<?php echo e(URL::to('/img/avatar/default.jpg')); ?>">
                                                      <?php endif; ?>
                                                      </a>


                                                      <p class="attribution"><a href="#"><h4><?php echo e($conv->other->name); ?></h4></a><br>

                                                        <!-- <?php if(Auth::user()->rate >=1 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?>

                                                          <?php if(Auth::user()->rate >=2 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?>
    
                                                          <?php if(Auth::user()->rate >=3 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?>
    
                                                          <?php if(Auth::user()->rate >=4 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?>
    
                                                          <?php if(Auth::user()->rate >=5 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?> -->
                                              

                                                     </p>
                                        


                                     <div align="right">                
                                     <p class="text-center">

                                        <?php if($conv->demand!=null): ?>
                                              
                                                        <h4> Chat Referente a demanda: <?php echo e($conv->demand->name); ?></h4>
                                              
                                                      <?php endif; ?>
                                      <li class="btn btn-default btn-sm">
                                 <a href="#" 
                                 
                                                data-page    = "chat-page" 
                                                data-demand  = '{"id":""}'
                                                data-to      = '{"id":"<?php echo e($conv->other->id); ?>","name":"<?php echo e($conv->other->name); ?>"}'
                                                data-conv_id = "<?php echo e($conv->id); ?>" 
                                                class="btn-open-chat">
                                                 <font color="black"><i class="icon_chat"></i> Chat</font></a>
                                          </a>
                                        
                                              </div>
                                              </div>
                                            </li>
                                            </p>
                                          </div><br/>
                                             
                                        
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                               <div class="col-md-12">
                                                    <h3 class="text-center">Nenhuma conversa encontrada</h3>
                                               </div>

                                              <?php endif; ?>

                                          </div>
                                      </div>
                    
                      </div>

                 </div>
            </div> 

</section>
</div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>