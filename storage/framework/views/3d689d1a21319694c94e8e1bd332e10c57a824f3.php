<?php $__env->startSection('content'); ?>

 <div><h2>Demandas em Execução</h2></div>

          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">

                           <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                      <div class="profile-activity">
                                          <div class="act-time">
                                           <?php $__empty_1 = true; $__currentLoopData = $demands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                              <div class="activity-body act-in" data-id="<?php echo e($demand->id); ?>">
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

                                                      <li class="btn btn-default btn-sm"><a href="#" class="btn-concluir-demanda" data-user-id="<?php echo e($demand->user_id); ?>" data-id="<?php echo e($demand->id); ?>" ><font color="green"><i class="icon_check"><font color="black"></i> Concluída</a></li></font></font>
                                                  
                                                     <li class="btn btn-default btn-sm">
                                                      <a href="#" 
                                                        data-page   = "demandas-exe" 
                                                        data-demand = '{"id":"<?php echo e($demand->id); ?>","name":"<?php echo e($demand->name); ?>","executor_id":"<?php echo e($demand->executor_id); ?>","user_name":"<?php echo e($demand->user->name); ?>","user_id":"<?php echo e($demand->user->id); ?>"}'
                                                        data-to     = '{"id":"<?php echo e($demand->executor->id); ?>","nome":"<?php echo e($demand->executor->name); ?>"}'
                                                        class="btn-open-chat">
                                                        <font color="black"><i class="icon_chat"></i> Chat</a></font>
                                                      </li>

                                                      
                                                      <li class="btn btn-default btn-sm"><a href="#" class="btn-cancelar-executor" data-cancelar="cancelar" data-id="<?php echo e($demand->id); ?>"><font color="black"><i align="center" class="icon_trash"></i> Desistir</a></li></font></font>
                                                         </td>
                                                       </div>
                                                  </div>
                                              </div><br>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                              <p>Não existem demandas em execução!</p>
                                              <?php endif; ?>
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

    <div class="modal fade modal-lg" tabindex="-1" role="dialog" id="modal-estrelas">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">
        Avalie o serviço:

         <div class='rating-stars text-center'>
    <ul id='stars'>
      <li class='star' title='Poor' data-value='1'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Fair' data-value='2'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Good' data-value='3'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Excellent' data-value='4'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='WOW!!!' data-value='5'>
        <i class='fa fa-star fa-fw'></i>
      </li>
    </ul>
  </div>
  <input type="hidden" name="demand_rating" value="0" id="demand_rating">
  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


<script type="text/javascript">

  $(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
   

    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    
    $.ajax({
            url : "<?php echo e(asset('/avaliar-demanda/')); ?>",
            data   : {
                     demand_id : $("#demand_rating").val(),
                     stars : ratingValue
            },
            type: 'POST'
          }).done(function(data){

               $("#modal-estrelas").modal("hide");
          });
      
  });
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}

  
 /* 
$(".btn-cancelar").on("click", function(){
  var id=$(this).attr("data-id");
  $.ajax("<?php echo e(asset('/removerexecutor/')); ?>/"+id).done(function(data){
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