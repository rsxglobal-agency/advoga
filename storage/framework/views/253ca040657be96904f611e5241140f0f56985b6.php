<?php $__env->startSection('content'); ?>

 <div><h3>Busca de Profissionais</h3></div>

          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Descrição da Busca
                          </header>
                          <div class="panel-body">
                         <form class="form-validate form-horizontal" name="form1" method="post" action="<?php echo e(URL::to('/busca/resultados')); ?>"  enctype="multipart/form-data">
                             <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
                             
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Busca por nomes</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="name" class="form-control round-input">

<!-- Seleção de estado -->
<br>

<div class="row">
  <label class="col-md-4">Estado:</label>
    <div class="col-md-4">
     <?php echo Form::select('state_id', App\State::pluck('name', 'id'), null, ['class'=>'form-control','id'=>'state_id', 'placeholder'=>'Selecione um Estado' ]);; ?>

   </div>

</div>
<p><br /></p>
<div class="row">
  <label class="col-md-4">Cidade:</label>
    <div class="col-md-4 selectContainer">
          <select id="city_id" name="city_id"  class="form-control">
            <option value="">Selecione o Estado</option>
         </select>
    </div>
    
</div>

<!-- Fim Seleção de estado -->

<p><h3>Perfil do profissional buscado</h3></p>
<div class="form-group">
    <p><h4>Área de Atuação</h4></p>
    <br>
     <table align="left" width=850 height=100>
               <tr>
                <?php $__currentLoopData = $atuations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col=>$values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <td>
                      <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <input type="checkbox" name="atuation_id[]" value="<?php echo e($val['id']); ?>"> <?php echo e($val['name']); ?><br>                      
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tr>                                 
    </table>
</div>

<div class="form-group">
    <p><h4>Serviços</h4></p>
    <br />
      <table align="left" width=850 height=100>
           <tr>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col=>$values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td>
                  <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <input type="checkbox" name="service_id[]" value="<?php echo e($val['id']); ?>"/> <?php echo e($val['name']); ?><br/>                      
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tr>                                 
      </table>
    <br/>
</div>

</div>
</div>
</div>



<div class="form-group">
<label class="col-md-4 control-label"></label>
<div class="col-md-4">

<input class="btn-wide" type="submit" value="Buscar"><br><br>


  </div>
</div>

</fieldset>
</form>
</div>
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>