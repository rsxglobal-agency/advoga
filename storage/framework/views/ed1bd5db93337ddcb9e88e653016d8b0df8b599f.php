<?php $__env->startSection('content'); ?>

 <div><h2>Demandas Lançadas</h2></div>

          <div class="row">
                 
                      <section class="panel">
                           <div class="panel-body">
                           <?php $__empty_1 = true; $__currentLoopData = $demands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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

                                                      <div align="right">
                                                      <td>
                                                      <li class="btn btn-default btn-sm"><a href="<?php echo e(asset('/demands/'.$demand->id.'/edit')); ?>" ><font color="black"><i align="center" class="icon_pencil-edit"></i> Editar</font></a></li>
                                                      <li class="btn btn-default btn-sm"><a href="<?php echo e(asset('/demanda/cadidatos/'.$demand->id.'/')); ?>"><font color="black"><i class="icon_contacts"></i> Candidatos</font></a></li>
                                                      <li class="btn btn-default btn-sm"><a href="#" class="btn-excluir-demanda" data-id="<?php echo e($demand->id); ?>" ><font color="black"><i class="icon_trash"></i> Excluir</font></a></li>
                                                         </td>
                                                       </div>
                                                  </div>
                                              </div>
                                            </div>
                                         
                                              </div>
                                          </div>

                                      </div>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                      <p>Não existem demandas lançadas!</p>
                                        <?php endif; ?>
                                  </div>




  </div>
</div>

</fieldset>
</form>
</div>
    </div>


<script type="text/javascript">
 
/*  
$(".btn-excluir").on("click", function(){
    
    e.preventDefault();
    
  var id=$(this).attr("data-id");
  
  $.ajax("<?php echo e(asset('/removerdemanda/')); ?>/"+id).done(function(data){
    $("div[data-id='"+id+"']").remove();
  });
  

});

$(".btn-concluida").on("click", function(){
  var id=$(this).attr("data-id");
  $.ajax("<?php echo e(asset('/demandaconcluida/')); ?>/"+id).done(function(data){
    $("div[data-id='"+id+"']").remove();
  });

});
*/


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>