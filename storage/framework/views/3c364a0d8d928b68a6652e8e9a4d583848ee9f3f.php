<?php $__env->startSection('content'); ?>

 <div><h2>Candidaturas</h2></div>

          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">

                           <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                      <div class="profile-activity">
                                          <div class="act-time">
                                           <?php $__currentLoopData = $demands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <div class="activity-body act-in" data-id="<?php echo e($demand->id); ?>">
                                                  <span class="arrow"></span>
                                                  <div class="text">
                                                      <a href="#" class="activity-img">
                                                            <?php if($demand->user->image!=''): ?>   
                                                                 <img alt="" src="<?php echo e(URL::to('/uploads/avatars')); ?>/<?php echo e($demand->user->image); ?>" height="500" width="500"/>
                                                             <?php else: ?>
                                                                <img alt="" src="<?php echo e(URL::to('/img/avatar/default.jpg')); ?>" height="500" width="500"/>
                                                             <?php endif; ?>
                                                      </a>
                                                      <p class="attribution"><a href="#"><?php echo e($demand->user->name); ?></a>  <br>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star"></i></span>
                                                      <span><i class="icon_star-half_alt"></i></span>
                                                      <span><i class="icon_star_alt"></i></span></p>
                                                      <tr><br>

                                                          <th><strong> <?php echo e($demand->name); ?></strong></th><br>
                                 <p class="attribution"><i class="icon_pin_alt"></i><?php echo e($demand->state->name); ?>, <?php echo e($demand->city->name); ?></span> - <i class="icon_calendar"></i> <?php echo e($demand->created_at->format('d-m-Y')); ?> - <i class="icon_clock"></i> <?php echo e($demand->created_at->format('H:i')); ?></p>
                                                          <th><br>
                                                         <td><th><strong>Áreas de Atuação: </strong></th> <?php echo e($demand->atuations); ?> </td><br>
                                                         <td><strong>Serviços Prestados: </strong> <?php echo e($demand->services); ?> </td><br>
                                                         <td><strong>Descrição: </strong><?php echo e($demand->description); ?></td>
                                                         </th>
                                                          </tr>

                                                      <div align="right">
                                                      <td>

                                                      <li class="btn btn-default btn-sm">
                                                      <a href="#" 
                                                        data-page   = "candidaturas" 
                                                        data-demand = '{"id":"<?php echo e($demand->id); ?>","name":"<?php echo e($demand->name); ?>","executor_id":"<?php echo e($demand->executor_id); ?>","user_name":"<?php echo e($demand->user->name); ?>","user_id":"<?php echo e($demand->user->id); ?>"}'
                                                        data-to     = '{"id":"<?php echo e($demand->user->id); ?>","nome":"<?php echo e($demand->user->name); ?>"}'
                                                        class="btn-open-chat">
                                                        <font color="black"><i class="icon_chat"></i> Chat</font></a>
                                                      </li>
                                                      
                                                      <li class="btn btn-default btn-sm"><a class="btn-cancelar-demanda" href="#" data-id="<?php echo e($demand->id); ?>"><font color="black"><i class="icon_trash" ></i> Cancelar</a></font></li>
                                                         </td>
                                                       </div>
                                                  </div>
                                              </div><br>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>