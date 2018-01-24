@extends('layouts.master')

@section('content')

 <div><h2>Histórico de Demandas</h2></div>

          <div class="row">
                 
                      <section class="panel">


                           <div class="panel-body">
                           @forelse ($demands as $demand)
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                                                         <div class="profile-activity">
                                          <div class="act-time">
                                              <div class="activity-body act-in">
                                                  <span class="arrow"></span>
                                                  <div class="text">

                                                      <tr>

                                                          <th><strong> {{ $demand->name }}</strong></th><br>
                                                             <th><br>
                                                             <td><th><strong>Áreas de Atuação: </strong></th> {{$demand->atuations}} </td><br>
                                                             <td><strong>Serviços Prestados: </strong> {{$demand->services}} </td><br>
                                                             <td><strong>Descrição: </strong>{{ $demand->description }}</td>
                                                             </th>
                                                          </tr>

                                                      
                                                  </div>
                                              </div>
                                          </div>
                                          @empty
                                          <p>Não existem demandas finalizadas!</p>
                                          @endforelse
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


@endsection
