  

<?php $__env->startSection('content'); ?>


 <div class="col-lg-12">
  <div class="profile-widget profile-widget-info">
  <div class="panel-body">
  <div class="col-sm-2"><br>
  <div class="follow-ava">
         <?php if(Auth::user()->image!=''): ?>   
             <img alt="" src="<?php echo e(URL::to('/uploads/avatars')); ?>/<?php echo e(Auth::user()->image); ?>" height="500" width="500"/>
         <?php else: ?>
            <img alt="" src="<?php echo e(URL::to('/img/avatar/default.jpg')); ?>" height="500" width="500"/>
         <?php endif; ?>
  </div>
    <h6><?php echo e(Auth::user()->titulation); ?></h6>
    <span><i class="icon_star"></i></span>
    <span><i class="icon_star"></i></span>
    <span><i class="icon_star"></i></span>
    <span><i class="icon_star-half_alt"></i></span>
    <span><i class="icon_star_alt"></i></span>
  </div>
  <div class="follow-info">
    <h4><?php echo e(Auth::user()->name); ?></h4>
    <p><?php echo e(Auth::user()->description); ?></p>
    <p><i class="fa fa-linkedin"> <a href="http://www.<?php echo e(Auth::user()->social); ?>" target="_blank" style="text-decoration:none;color:#FFF "> <?php echo e(Auth::user()->social); ?></a></i></p>
    <p>
    <h6> 

    <span><i class="icon_pin_alt"></i><?php echo e(Auth::user()->state->name); ?>, <?php echo e(Auth::user()->city->name); ?></span>
    </h6>
    </p>
  </div>
  </div>
  </div>
  </div>
  </div>

<!-- page start-->

<br>
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
                               <div  align="right">
                                <td>
                                <br/>
                                <li href="#" data-id="<?php echo e($demand->id); ?>" class="btn btn-success btn-sm">Aceitar Demanda</li>


                                   </td>
                              </div>

                         </div>

                     </div><br>
                      
                 </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                     </div>
                 </div>

             </div>
         </div>
         


<!-- page end-->

<script type="text/javascript">
  
$(".btn-success").on("click", function(){
  var id=$(this).attr("data-id");
  $.ajax("<?php echo e(asset('/aceitar/')); ?>/"+id).done(function(data){
    $("div[data-id='"+id+"']").remove();
  });

});



</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>