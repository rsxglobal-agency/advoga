<!--header start-->

  <header class="header dark-bg" >
  <div class="toggle-nav">
  <div class="icon-reorder tooltips" data-original-title="Menu de Navegação" data-placement="bottom"><i class="icon_menu"></i></div>
  </div>

<!--logo start-->

    <a href="dashboard" class="logo">Advoga <SUP>app</SUP></a>

<!--logo end-->

  <div class="nav search-row" id="top_menu">


  </div>
  <div class="top-nav notification-row">

<!-- notificatoin dropdown start-->

    <ul class="nav pull-right top-menu">

<!-- user login dropdown start-->

    <li class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
    
    <span class="profile-ava">
         <?php if(Auth::user()->image!=''): ?>   
             <img alt="" src="<?php echo e(URL::to('/uploads/avatars')); ?>/<?php echo e(Auth::user()->image); ?>" height="30" width="30"/>
         <?php else: ?>
            <img alt="" src="<?php echo e(URL::to('/img/avatar/default.jpg')); ?>" height="30" width="30"/>
         <?php endif; ?>
    </span>
    
    <span class="username"><?php echo e(Auth::user()->name); ?></span>
    <b class="caret"></b>
    </a>
    <ul class="dropdown-menu extended logout">
  <div class="log-arrow-up"></div>
    <li class="eborder-top">
    <a href="<?php echo e(URL::to('/atualizar-cadastro')); ?>"><i class="icon_toolbox"></i>Editar Perfil</a>
    </li>

    <li>
    <a href="<?php echo e(route('logout')); ?>"
              onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="icon_id_alt"></i> Sair</a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
    </li>

    </ul>
    </li>

<!-- user login dropdown end -->

    </ul>

<!-- notificatoin dropdown end-->

  </div>
    </header>
