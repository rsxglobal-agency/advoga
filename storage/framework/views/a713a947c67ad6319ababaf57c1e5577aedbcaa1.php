

<?php $__env->startSection('content'); ?>

 <div><h2>Demanda / Candidados</h2></div>

          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">

                           <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                      <div class="profile-activity">
                                          <div class="act-time">
                                            
                                              <?php if($demand): ?>
                                              <div class="tab-content" data-id="<?php echo e($demand->id); ?>">
                                                  <div id="recent-activity" class="tab-pane active">
                                                        <div class="profile-activity">
                                                          <div class="act-time">
                                                              <div class="activity-body act-in">
                                                                  <span class="arrow"></span>
                                                                  <div class="text">
                
                                                                      <tr>
                
                                                                          <th><strong> <?php echo e($demand->name); ?></strong></th><br>
                                                                          <th>                                                          
                                                                          <p class="attribution"><i class="icon_pin_alt"></i><?php echo e($demand->state->name); ?>, <?php echo e($demand->city->name); ?></span> - <i class="icon_calendar"></i> <?php echo e($demand->created_at->format('d-m-Y')); ?> - <i class="icon_clock"></i> <?php echo e($demand->created_at->format('H:i')); ?></p>
                                                                         <td><th><strong>Áreas de Atuação: </strong></th> <?php echo e($demand->atuations); ?> </td><br>
                                                                         <td><strong>Serviços Prestados: </strong> <?php echo e($demand->services); ?> </td><br>
                                                                          <td><strong>Descrição: </strong><?php echo e($demand->description); ?></td>
                                                                          </th>
                                                                   </tr>
                
                                                                      <div align="right" style="display: none;">
                                                                      <td >
                                                                      <li class="btn btn-default btn-sm"><a href="<?php echo e(asset('/demands/'.$demand->id.'/edit')); ?>" ><font color="black"><i align="center" class="icon_pencil-edit"></i> Editar</font></a></li>
                                                                      <li class="btn btn-default btn-sm"><a href="#>" class="btn-excluir" data-id="<?php echo e($demand->id); ?>" ><font color="black"><i class="icon_trash"></i> Excluir</font></a></li>
                                                                         </td>
                                                                       </div>
                                                                  </div>
                                                              </div>
                                                            </div>
                                                         
                                                              </div>
                                                          </div>
                
                                                      </div>
                    
                                          
                                          
                                              <?php $__currentLoopData = $demand->candidatos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                               <div class="activity-body act-in" data-id="<?php echo e($demand->id); ?>">
                                                  <span class="arrow"></span>
                                                  <div class="text">
                                                      <a href="#" class="activity-img">
                                                            <?php if($user->image!=''): ?>   
                                                                 <img alt="" src="<?php echo e(URL::to('/uploads/avatars')); ?>/<?php echo e($user->image); ?>" height="500" width="500"/>
                                                             <?php else: ?>
                                                                <img alt="" src="<?php echo e(URL::to('/img/avatar/default.jpg')); ?>" height="500" width="500"/>
                                                             <?php endif; ?>
                                                      </a>
                                                      <p class="attribution"><a href="#"><?php echo e($user->name); ?></a>  <br>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star-half_alt"></i></span>
                                                      <span><i class="icon_star_alt"></i></span></p>
                                                    
                                                    <div align="left">  
                                                        <tr>
                                                              <th>                                                          
                                                               <p class="attribution"><i class="icon_pin_alt"></i><?php echo e($user->state->name); ?>, <?php echo e($user->city->name); ?></span> - <i class="icon_calendar"></i> <?php echo e($user->created_at->format('d-m-Y')); ?> - <i class="icon_clock"></i> <?php echo e($user->created_at->format('H:i')); ?></p>
                                                               <td><th><strong>Áreas de Atuação: </strong></th> <?php echo e($user->atuations); ?> </td><br>
                                                               <td><strong>Serviços Prestados: </strong> <?php echo e($user->services); ?> </td><br>
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
                                                               data-demand='{"id":"<?php echo e($demand->id); ?>","name":"<?php echo e($demand->name); ?>","executor_id":"<?php echo e($demand->executor_id); ?>","user_name":"<?php echo e($demand->user->name); ?>","user_id":"<?php echo e($demand->user->id); ?>"}' 
                                                               data-to    ='{"id":"<?php echo e($user->id); ?>","nome":"<?php echo e($user->name); ?>"}'
                                                               class="btn-open-chat">
                                                               <font color="black"><i class="icon_chat"></i> Chat</a></font>
                                                           </li>
                                                       </td>
                                                       </div>
                                                  </div>
                                              </div><br/>
                                        
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                             
                                            <?php else: ?>
                                           <p>Demanda não encontrada!</p>
                                         <?php endif; ?>
                                          </div>
                                      </div>
                                  </div>

                 </div>
</div> 

</fieldset>
</form>
</div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>