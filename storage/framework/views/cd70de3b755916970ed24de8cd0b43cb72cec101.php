<?php $__env->startSection('content'); ?>

 <div><h2>Histórico de Demandas</h2></div>

          <div class="row">
                 
                      <section class="panel">


                           <div class="panel-body">
                           <?php $__empty_1 = true; $__currentLoopData = $demands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                                                         <div class="profile-activity">
                                          <div class="act-time">
                                              <div class="activity-body act-in">
                                                  <span class="arrow"></span>
                                                  <div class="text">

                                                      <tr>

                                                          <th><strong> <?php echo e($demand->name); ?></strong></th><br>
                                                             <th><br>
                                                             <td><th><strong>Áreas de Atuação: </strong></th> <?php echo e($demand->atuations); ?> </td><br>
                                                             <td><strong>Serviços Prestados: </strong> <?php echo e($demand->services); ?> </td><br>
                                                             <td><strong>Descrição: </strong><?php echo e($demand->description); ?></td>
                                                             </th>
                                                          </tr>

                                                      
                                                  </div>
                                              </div>
                                          </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                          <p>Não existem demandas finalizadas!</p>
                                          <?php endif; ?>
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