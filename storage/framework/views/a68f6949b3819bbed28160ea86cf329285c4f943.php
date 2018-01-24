  

<?php $__env->startSection('content'); ?>

 <section class="panel">
       <header class="panel-heading">
         Minha Conta
        </header>

<!-- page start-->

<div class="panel-body">

<div class="form">
<form class="form-validate form-horizontal">
  <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Nome Completo</strong></label>
      
      <label for="fullname" class="control-label col-lg-2"><?php echo e(Auth::user()->name); ?></label>                                       
    
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>E-mail</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2"><?php echo e(Auth::user()->email); ?></label>                                       
      </div>
  </div>
 
  <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Imagem de Perfil</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2"> <?php if(Auth::user()->image!=''): ?>   
             <img alt="" src="<?php echo e(URL::to('/uploads/avatars')); ?>/<?php echo e(Auth::user()->image); ?>" height="150"/>
         <?php else: ?>
            <img alt="" src="<?php echo e(URL::to('/img/avatar/default.jpg')); ?>" height="50"/>
         <?php endif; ?></label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Estado</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2"><?php echo e(Auth::user()->state->name); ?></label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Cidade</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2"><?php echo e(Auth::user()->city->name); ?></label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Título</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2"><?php echo e(Auth::user()->titulation->name); ?></label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Data de Cadastro</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2"><?php echo e(Auth::user()->created_at->format('d/m/Y')); ?> - <?php echo e(Auth::user()->created_at->format('H:i')); ?></label>                                       
      </div>
  </div>

  <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Última Atualização</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2"><?php echo e(Auth::user()->updated_at->format('d/m/Y')); ?> - <?php echo e(Auth::user()->updated_at->format('H:i')); ?></label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Contato</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2">contato@advogaapp.com.br</label>                                       
      </div>
  </div>

</form>
</div>
</div>

  </section>

<!-- page end-->


<!--

<?php $__currentLoopData = Auth::user()->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php echo e($payment->created_at->format('d-m-Y')); ?>

<?php echo e($payment->plano); ?>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

-->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>