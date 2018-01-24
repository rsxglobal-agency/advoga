@extends('layouts.master')

@section('content')

<!--
<div class="panel-body">
<div class="alert alert-success fade in">
Demanda lançada com sucesso!
</div>
</div>
 --> 
    <div><h2>Lançamento de demanda</h2></div>
    <div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Descrição da solicitação
        </header>
    <div class="panel-body">
    
               @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
    

     {!!  Form::open(['route' => 'demands.store', 'class'=>"form-validate form-horizontal"]) !!}
    <div class="form-group">
    <label class="col-sm-2 control-label">Título da solicitação:</label>
    <div class="col-sm-10">
    <input type="text" class="form-control round-input" name="name" required/>

<!-- Seleção de estado -->
<p><h3>Localização</h3></p>
<p><h4>Local onde você deseja que a demanda seja efetivada:</h4></p>
<br>
<div class="row">

  <!-- INÍCIO Seleção de estado -->

                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Estado:</label>
                                      <div class="col-lg-3">
                                          {!! Form::select('state_id', App\State::pluck('name', 'id'), null, ['class'=>'form-control selectpicker','id'=>'state_id', 'placeholder'=>'Selecione um Estado', 'required' ]); !!}

                                          </div></div>

                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Cidade:</label>
                                      <div class="col-lg-3">
                                          <select id="city_id" name="city_id"  class="form-control selectpicker" required>
                                            <option value="">Selecione o Estado</option>
                                          </select></div></div>



<p><h3>Perfil do profissional buscado</h3></p>

<!-- INÍCIO da Áreas de Atuação -->
<div class="form-group">
<label class="control-label col-lg-2" for="inputSuccess">Selecione uma Área de Atuação</label>

<br>

                                  <table align="left" width=850 height=100>
                                       <tr>
                                        @foreach($atuations as $col=>$values)
                                          <td>
                                              @foreach($values as $val)
                                                 <input type="checkbox" name="atuation_id[]" value="{{$val['id']}}"> {{$val['name']}}<br>                      
                                              @endforeach
                                          </td>
                                        @endforeach
                                      </tr>                                 
                                  </table>


<br><br>
</div>


<!-- FIM da Áreas de Atuação -->


<!-- INÍCIO Serviços Prestados -->

<div class="form-group">
<label class="control-label col-lg-2" for="inputSuccess">Selecione serviços para a diligência:</label>


                                  <table align="left" width=850 height=100>
                                       <tr>
                                        @foreach($services as $col=>$values)
                                          <td>
                                              @foreach($values as $val)
                                                 <input type="checkbox" name="service_id[]" value="{{$val['id']}}"> {{$val['name']}}<br/>                      
                                              @endforeach
                                          </td>
                                        @endforeach
                                      </tr>                                 
                                  </table>
<br><br>
</div>


<!-- FIM Serviços Prestados -->
<br>


<p><h4>Descrição da demanda:</h4></p>

<div class="row">
<div class="col-md-10">
<div>

  <textarea class="form-control" id="description" name="description" placeholder="Descrição da demanda" required></textarea>

</div>
</div>
</div>
</div>
</div>


<div class="form-group">
<label class="col-md-4 control-label"></label>
<div class="col-md-4">

<br>
@if(!Auth::user()->tour)
  <input class="btn-wide" type="submit"><br><br>
@endif

</div>
</div>

</fieldset>
</form>
</div>
</div>

 
<!-- page end-->
@endsection
