  @extends('layouts.master')

@section('content')

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
      
      <label for="fullname" class="control-label col-lg-2">{{Auth::user()->name}}</label>                                       
    
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>E-mail</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2">{{Auth::user()->email}}</label>                                       
      </div>
  </div>
 
  <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Imagem de Perfil</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2"> @if(Auth::user()->image!='')   
             <img alt="" src="{{URL::to('/uploads/avatars')}}/{{ Auth::user()->image }}" height="150"/>
         @else
            <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}" height="50"/>
         @endif</label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Estado</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2">{{Auth::user()->state->name}}</label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Cidade</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2">{{Auth::user()->city->name}}</label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Título</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2">{{ Auth::user()->titulation->name }}</label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Data de Cadastro</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2">{{Auth::user()->created_at->format('d/m/Y')}} - {{Auth::user()->created_at->format('H:i')}}</label>                                       
      </div>
  </div>

  <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Última Atualização</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2">{{Auth::user()->updated_at->format('d/m/Y')}} - {{Auth::user()->updated_at->format('H:i')}}</label>                                       
      </div>
  </div>

    <div class="form-group">
    <label for="fullname" class="control-label col-lg-2"><strong>Contato</strong></label>
      <div class="col-lg-10">
      <label for="fullname" class="control-label col-lg-2">contato@advogaapp.com.br</label>                                       
      </div>
  </div>

  <div class="form-group" align="center">
    
      <div align="center">
    AdvogaApp - versão BETA 1.0.3                                 
      </div>
  </div>

</form>
</div>
</div>

  </section>

<!-- page end-->


<!--

@foreach(Auth::user()->payments as $payment)

{{ $payment->created_at->format('d-m-Y') }}
{{ $payment->plano }}

@endforeach

-->


@endsection
