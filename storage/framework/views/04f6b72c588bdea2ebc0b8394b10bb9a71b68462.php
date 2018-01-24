

<?php $__env->startSection('content'); ?> 

 <div><h2>Busca / Resultados</h2></div>

          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">

                           <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                      <div class="profile-activity">
                                          <div class="act-time">
                                            
                                              <?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>  
                                               <div class="activity-body act-in" data-id="">
                                                  <span class="arrow"></span>
                                                  <div class="text">
                                                      <a href="#" 
                                                      data-target="modal-perfil" 
                                                      class="activity-img perfilmodal">

                                                            <?php if($user->image!=''): ?>   
                                                                 <img alt="" src="<?php echo e(URL::to('/uploads/avatars')); ?>/<?php echo e($user->image); ?>" height="500" width="500"/>
                                                             <?php else: ?>
                                                                <img alt="" src="<?php echo e(URL::to('/img/avatar/default.jpg')); ?>" height="500" width="500"/>
                                                             <?php endif; ?>
                                                      </a>
                                                      <p class="attribution"><a href="#" data-target="#modal-perfil" class="perfilmodal" data-userid="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></a>  <br>
                                                    
                                                      <!-- Votação de Estrelas -->

                                                          <?php if($user->rate >=1 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?>

                                                          <?php if($user->rate >=2 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?>
    
                                                          <?php if($user->rate >=3 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?>
    
                                                          <?php if($user->rate >=4 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?>
    
                                                          <?php if($user->rate >=5 ): ?>
                                                          <span><i class="icon_star"></i></span>
                                                          <?php else: ?> 
                                                          <span><i class="icon_star_alt"></i></span>
                                                          <?php endif; ?>


                                                       <!-- Votação de Estrelas -->


                                                      <div align="right">
                                                      <td>
                                                      <?php if(!Auth::user()->tour): ?>
                                                          <li class="btn btn-default btn-sm">
                                                            <a href="#" 
                                                               data-page  ="res-busca-prof" 
                                                               data-demand='{"id":""}' 
                                                               data-to    ='{"id":"<?php echo e($user->id); ?>","nome":"<?php echo e($user->name); ?>"}'
                                                               
                                                               class="btn-open-chat">
                                                        <font color="black"><i class="icon_chat"></i> Chat</font></a>
                                                          
                                                          </li></font>  <?php endif; ?>
                                                       </td>
                                                       </div>
                                                  </div>
                                              </div><br/>
                                        
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <p>Nenhum candidato encontrado!</p>
                                                <p><a class="btn btn-default btn-sm" href="<?php echo e(URL::to('/busca/')); ?>">Nova busca</a></p>
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
<?php echo $__env->make("includes.modalperfil", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>