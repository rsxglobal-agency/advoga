
<!--SIDEBAR START-->

<aside>
  <div id="sidebar"  class="nav-collapse ">

<!-- sidebar menu start-->

    <ul class="sidebar-menu">
    @if($_SERVER['REQUEST_URI'] == "/dashboard")
    <li class="sub-menu active">
    <a class="" href="dashboard">
    <i class="icon_house_alt"></i>
    <span>Feed de Demandas</span>
    </a>
    </li>
    @else
     <li class="sub-menu">
    <a class="" href="dashboard">
    <i class="icon_house_alt"></i>
    <span>Feed de Demandas</span>
    </a>
    </li>
    @endif

    @if(($_SERVER['REQUEST_URI'] == "/lancar-demanda") || ($_SERVER['REQUEST_URI'] == "/busca") )
    <li class="sub-menu active">
    <a href="javascript:;" class="">
    <i class="icon_document_alt"></i>
    <span>Serviços Lançados</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="lancar-demanda">Lançar Demandas</a></li>
    <li><a class="" href="busca">Buscar Profissionais</a></li>
    <li><a class="" href="minhas-demandas">Minhas Demandas</a></li>
    <li><a class="" href="demandas-em-execucao">Demandas Em Execução</a></li>
    </ul>
    </li>
    @else
    <li class="sub-menu">
    <a href="javascript:;" class="">
    <i class="icon_document_alt"></i>
    <span>Serviços Lançados</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="lancar-demanda">Lançar Demandas</a></li>
    <li><a class="" href="busca">Buscar Profissionais</a></li>
    <li><a class="" href="minhas-demandas">Minhas Demandas</a></li>
    <li><a class="" href="demandas-em-execucao">Demandas Em Execução</a></li>
    </ul>
    </li>
    @endif

    @if(($_SERVER['REQUEST_URI'] == "/candidaturas") || ($_SERVER['REQUEST_URI'] == "/emexecucao") )
    <li class="sub-menu active">
    <a href="javascript:;" class="">
    <i class="icon_toolbox"></i>
    <span>Serviços Prestados</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="candidaturas">Candidaturas</a></li>
    <li><a class="" href="emexecucao">Em Execução</a></li>
    </ul>
    </li>
    @else
    <li class="sub-menu">
    <a href="javascript:;" class="">
    <i class="icon_toolbox"></i>
    <span>Serviços Prestados</span>
    <span class="menu-arrow arrow_carrot-right"></span>
    </a>
    <ul class="sub">
    <li><a class="" href="candidaturas">Candidaturas</a></li>
    <li><a class="" href="emexecucao">Em Execução</a></li>
    </ul>
    </li>
    @endif

    @if($_SERVER['REQUEST_URI'] == "/historical")
    <li class="sub-menu active">
    <a class="" href="historical">
    <i class="icon_archive"></i>
    <span>Histórico</span>
    </a>
    </li>
    @else
    <li>
    <a class="" href="historical">
    <i class="icon_archive"></i>
    <span>Histórico</span>
    </a>
    </li>
    @endif

    @if($_SERVER['REQUEST_URI'] == "/chat")
    <li class="sub-menu active">
    <a class="" href="chat" id="btn-chat">
    <i class="icon_chat_alt"></i>
    <span>Chat</span>
    </a>
    </li>
    @else
     <li class="sub-menu">
    <a class="" href="chat" id="btn-chat">
    <i class="icon_chat_alt"></i>
    <span>Chat</span>
    </a>
    </li>
    @endif

</ul>

<!-- sidebar menu end-->

  </div>
</aside>

<!--sidebar end-->
