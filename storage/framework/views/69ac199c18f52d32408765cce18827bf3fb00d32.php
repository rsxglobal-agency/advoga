
<!--SIDEBAR START-->

<aside>
  <div id="sidebar"  class="nav-collapse ">

<!-- sidebar menu start-->

    <ul class="sidebar-menu">
    <?php if($_SERVER['REQUEST_URI'] == "/dashboard"): ?>
    <li class="sub-menu active">
    <a class="" href="dashboard">
    <i class="icon_house_alt"></i>
    <span>Feed de Demandas</span>
    </a>
    </li>
    <?php else: ?>
     <li class="sub-menu">
    <a class="" href="dashboard">
    <i class="icon_house_alt"></i>
    <span>Feed de Demandas</span>
    </a>
    </li>
    <?php endif; ?>

    <?php if(($_SERVER['REQUEST_URI'] == "/lancar-demanda") || ($_SERVER['REQUEST_URI'] == "/busca") ): ?>
    <li class="sub-menu active">
    <a href="javascript:;" class="">
    <i class="icon_document_alt"></i>
    <span>Ações</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="lancar-demanda">Lançar Demandas</a></li>
    <li><a class="" href="busca">Buscar Profissionais</a></li>
    </ul>
    </li>
    <?php else: ?>
    <li class="sub-menu">
    <a href="javascript:;" class="">
    <i class="icon_document_alt"></i>
    <span>Ações</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="lancar-demanda">Lançar Demandas</a></li>
    <li><a class="" href="busca">Buscar Profissionais</a></li>
    </ul>
    </li>
    <?php endif; ?>
    
   <?php if(($_SERVER['REQUEST_URI'] == "/minhas-demandas") || ($_SERVER['REQUEST_URI'] == "/demandas-em-execucao") ): ?>
    <li class="sub-menu active">
    <a href="javascript:;" class="">
    <i class="icon_balance"></i>
    <span>Demandas</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="minhas-demandas">Lançadas</a></li>
    <li><a class="" href="demandas-em-execucao">Em Execução</a></li>
    </ul>
    </li>
    <?php else: ?>
    <li class="sub-menu">
    <a href="javascript:;" class="">
    <i class="icon_balance"></i>
    <span>Demandas</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="minhas-demandas">Lançadas</a></li>
    <li><a class="" href="demandas-em-execucao">Em Execução</a></li>
    </ul>
    </li>
    <?php endif; ?>

    <?php if(($_SERVER['REQUEST_URI'] == "/candidaturas") || ($_SERVER['REQUEST_URI'] == "/emexecucao") ): ?>
    <li class="sub-menu active">
    <a href="javascript:;" class="">
    <i class="icon_toolbox"></i>
    <span>Diligências</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="candidaturas">Candidaturas</a></li>
    <li><a class="" href="emexecucao">Em Execução</a></li>
    </ul>
    </li>
    <?php else: ?>
    <li class="sub-menu">
    <a href="javascript:;" class="">
    <i class="icon_toolbox"></i>
    <span>Diligências</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="candidaturas">Candidaturas</a></li>
    <li><a class="" href="emexecucao">Em Execução</a></li>
    </ul>
    </li>
    <?php endif; ?>

    <?php if($_SERVER['REQUEST_URI'] == "/historical"): ?>
    <li class="sub-menu active">
    <a class="" href="historical">
    <i class="icon_archive"></i>
    <span>Histórico</span>
    </a>
    </li>
    <?php else: ?>
    <li>
    <a class="" href="historical">
    <i class="icon_archive"></i>
    <span>Histórico</span>
    </a>
    </li>
    <?php endif; ?>

    <?php if($_SERVER['REQUEST_URI'] == "/chat"): ?>
    <li class="sub-menu active">
    <a class="" href="chat" id="btn-chat">
    <i class="icon_chat_alt"></i>
    <span>Chat</span>
    </a>
    </li>
    <?php else: ?>
     <li class="sub-menu">
    <a class="" href="chat" id="btn-chat">
    <i class="icon_chat_alt"></i>
    <span>Chat</span>
    </a>
    </li>
    <?php endif; ?>

</ul>

<!-- sidebar menu end-->

  </div>
</aside>

<!--sidebar end-->