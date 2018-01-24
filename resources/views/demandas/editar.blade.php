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
    
         
    @if($up=='ok')
       <div class="col-xs-12">
            <div class="alert alert-success">
              <p>Dados atualizados com sucesso!</p>
           </div>
      </div>
    @endif
    
   @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    

           <form class="form-horizontal" method="POST" action="demandas/update" enctype="">
               {{ csrf_field() }}
            <input type="hidden" value="{{$demand->id}}" name="id"/>   
             
             
    <div class="form-group">
    <label class="col-sm-2 control-label">Título da solicitação:</label>
    <div class="col-sm-10">
    <input type="text" class="form-control round-input" name="name" value="{{$demand->name}}"/>

<!-- Seleção de estado -->
<p><h3>Localização</h3></p>
<p><h4>Local onde você deseja que a demanda seja efetivada:</h4></p>
<br>
<div class="row">

  <!-- INÍCIO Seleção de estado -->

                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Estado:</label>
                                      <div class="col-lg-3">
                                          {!! Form::select('state_id', App\State::pluck('name', 'id'), $demand->state_id, ['class'=>'form-control selectpicker','id'=>'state_id', 'placeholder'=>'Selecione um Estado' ]); !!}

                                          </div></div>

                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Cidade:</label>
                                      <div class="col-lg-3">
                                         {!! Form::select('city_id', App\City::pluck('name', 'id'), $demand->city_id, ['class'=>'form-control selectpicker','id'=>"city_id",'data-cidade'=>"$demand->city_id", 'placeholder'=>'Selecione um Estado' ]); !!}
                                      </div>
                                          
                                          </div>

<!-- FIM Seleção de estado -->

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
                                                 <input type="checkbox" name="atuation_id[]" {{$val['checked']}} value="{{$val['id']}}"> {{$val['name']}}<br>                      
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
                                                 <input type="checkbox" name="service_id[]" {{$val['checked']}} value="{{$val['id']}}"> {{$val['name']}}<br>                      
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

  <textarea class="form-control" id="description" name="description" placeholder="Descrição da demanda">{{$demand->description}}</textarea>

</div>
</div>
</div>
</div>
</div>


<div class="form-group">
<label class="col-md-4 control-label"></label>
<div class="col-md-4">

<br>

  <input class="btn-wide" type="submit"><br><br>


</div>
</div>

</fieldset>
</form>
</div>
</div>

 
<!-- page end-->
@endsection
