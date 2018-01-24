<!--header start-->

  <header class="header dark-bg" >
  <div class="toggle-nav">
  <div class="icon-reorder tooltips" data-original-title="Menu de Navegação" data-placement="bottom"><i class="icon_menu"></i></div>
  </div>

<!--logo start-->

    <a href="dashboard" class="logo"><img src="img/logo_adv.png" height="21" width="130"></a>


<!--logo end-->

  <div class="nav search-row" id="top_menu">


  </div>
  <div class="top-nav notification-row">
  <ul class="nav pull-right top-menu">

<!-- notificatoin dropdown start-->
 <!-- task notificatoin start -->
                   <!-- <li id="task_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon_box-checked"></i>
                            <span class="badge bg-important">5</span>
                        </a>
                         <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                <p class="white">Você tem 5 candidatos novos</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Igor Godzera</span>
                                    <span class="time">1 min</span>
                                    </span>
                                   
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini2.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Pati Bogno</span>
                                    <span class="time">5 mins</span>
                                    </span>
                                    
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini3.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Edson MTFCR</span>
                                    <span class="time">2 hrs</span>
                                    </span>
                                   
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini4.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Passarinho</span>
                                    <span class="time">1 day</span>
                                    </span>
                                   
                                </a> 
                            </li>
                            <li class="external">
                                <a href="minhas-demandas">Ver todas as candidaturas</a>
                            </li>
                        </ul> 
                    </li>-->
                    <!-- task notificatoin end -->
                    <!-- inbox notificatoin start-->
                    <li id="mail_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon_chat_alt"></i>
                            <span id="badge_chat" class="badge bg-important">0</span>
                        </a>
                        <ul id="chat_ul" class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                <p class="white">Você tem 5 mensagens não lidas</p>
                            </li>
                            
                            <li>
                                <a href="chat">Ver todas as mensagens</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox notificatoin end -->

                    <!-- alert notification start-->
                     <li id="alert_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon_document_alt"></i>
                          
                            <span id="badge_executor" class="badge bg-important">0</span>
                        </a>
                        <ul id="executor_ul" class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                 <a href="minhas-demandas">Veja todas suas demandas</a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- alert notification end--> 

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
    <a href="assinatura"><i class="icon_pencil"></i>Minha Conta</a>
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
