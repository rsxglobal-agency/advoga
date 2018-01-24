<!DOCTYPE html>  
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Advoga - Aproximando comarcas, unindo profissionais, agilizando o Direitos</title>

    <base href="{{ $app->make('url')->to('/') }}/"/>
    
    <meta name="description" content="">
    <meta name="author" content=""/>
    <meta name="keyword" content=""/>
    <link rel="shortcut icon" href="img/img/advogaicon.ico">

  
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
     
    <style type="text/css">
    <!--
      body .modal-lg .modal-dialog{
         width: 700px;
        /* max-width: 1024px !important; */
         margin: auto;
      }
      
      @media(max-width:768px){
         body .modal-lg .modal-dialog{
            left: auto !important;
             width: 95%;
             margin: auto;
         }
      }
      .modal-dialog{
        
        left: auto !important;
        width: 700px;

      }

      .modal-lg {
        
        width: auto;
      }
      
    -->
    </style>
     
     
  </head>

  <body>
 
    

<section>
<section class="panel-body">

    <div align="center"><h2><img src="img/ADVOGA_Branco.png" height="55" width="250"></h2></div>
    <div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Cadastro de novo usuário
        </header>

<!-- INÍCIO do Formulário -->  

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
                              <div class="form">
                                  

                                  {!!  Form::open(['route' => 'user.store','files'=>true,'id'=>"formCadastro",'class'=>"form-validate form-horizontal"]) !!}


                                      <!--<form method="post" id="formzera" class="form-validate form-horizontal" onsubmit=" register(); return true;"> -->

                                      {{ csrf_field() }}
                                     
                                      <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">Nome Completo <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class=" form-control" id="name" name="name" type="text" required/>
                                          </div>
                                      </div>
                                       
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-control-label col-lg-2 control-label">E-Mail <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                            
                                        </div>
                                    </div>
                                    

                                      
                                       <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-lg-2 control-label">Senha <span class="required">*</span></label>
                                            <div class="col-lg-10">
                                                <input id="password" type="password" class="form-control" name="password" required>
                                            </div>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-lg-2 control-label">Confirmação de Senha <span class="required">*</span></label>
                                            <div class="col-lg-10">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>
                                        

                                    <!-- INÍCIO Seleção de estado -->

                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Estado:</label>
                                      <div class="col-lg-3">
                                          {!! Form::select('state_id', App\State::pluck('name', 'id'), null, ['class'=>'form-control selectpicker', 'placeholder'=>'Selecione um Estado', 'required' ]); !!}
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Cidade:</label>
                                      <div class="col-lg-3">
                                          <select id="city_id" name="city_id"  class="form-control selectpicker" required>
                                          </select></div>
                                    </div>

                                    <!-- FIM Seleção de estado -->

                                    <!-- INÍCIO da Titulação -->

                                      <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Titulação:</label>
                                      <div class="col-lg-3">
                                      {!! Form::select('titulation_id', App\Titulation::pluck('name', 'id'), null, ['class'=>'form-control selectpicker', 'placeholder'=>'Selecione uma Titulação', 'required' ]); !!}
                                          </div></div>

                                        <!-- FIM da Titulação -->
                                        
                                        <!-- INÍCIO da Formação -->

                                      <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Formação:</label>
                                      <div class="col-lg-3">
                                      {!! Form::select('formation_id', App\Formation::pluck('name', 'id'), null, ['class'=>'form-control selectpicker', 'placeholder'=>'Selecione uma Formação','required' ]); !!}
                                          
                                          </div></div>

                                    <!-- FIM da Formação -->
                                    
                             <!-- INÍCIO da Áreas de Atuação -->
                              <!--<div class="form-group">
                                  <label class="control-label col-lg-2" for="inputSuccess">Selecione uma Área de Atuação</label>
                                  <p><h4></h4></p>
                                    
                                
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
                              
                             </div> -->
                             <!-- FIM da Áreas de Atuação -->
                            
                             <!-- INÍCIO Serviços Prestados -->
                                
                            <!--<div class="form-group">
                                <label class="control-label col-lg-2" for="inputSuccess">Selecione serviços para prestar:</label>
                                <p><h4></h4></p>
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
                                <br/><br/>
                            </div> -->
                            <!--FIM Serviços Prestados -->

                    <!-- INÍCIO Currículo -->
                    
                   <!-- <div class="form-group">
                       <label class="control-label col-lg-2" for="inputSuccess">Escreva uma frase de apresentação: (max. 200 caracteres)</label>
                       <div class="col-lg-10">
                          <p><h4></h4></p>
                          <textarea class="form-control" name="description" maxlength="200" placeholder="Olá, meu nome é *** e trabalho com direito Penal." required></textarea>
                       </div> 
                    </div> -->
                    
                    <!-- FIM Currículo -->

<!-- INÍCIO rede social -->


 <!-- <div class="form-group">
  <label class="control-label col-lg-2" for="inputSuccess">Qual o link da sua principal rede social?</label>
  <div class="col-lg-10">
    <p><h4></h4></p>
    <textarea class="form-control" name="social" maxlength="200" placeholder="linkedin.com/seu_perfil" required></textarea><br/>

      </div> 
      
      </div> -->

<!--<div class="form-group">
  <label class="control-label col-lg-2" for="">Imagem do perfil</label>
  <div class="col-lg-10">
    <p><h4></h4></p>
      <div style="position:relative;">
        		<a class='btn btn-default' href='javascript:;'>
        			Escolher arquivo
        			<input type="file" id="photo" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="photo" size="40"/>
        		</a>
        		&nbsp;
        		<span class='label label-info' id="upload-file-info"></span>
       </div>
  </div>     
</div> -->


<!--<div class="form-group">
  <label class="control-label col-lg-2" for="">Telefone</label>
  <div class="col-lg-2">
        <input class="form-control" placeholder="DDD" id="area_code" name="area_code" type="text" maxlength="2" required/>                            
  </div>  
  <div class="col-lg-3">
        <input class="form-control" placeholder="Telefone" id="telefone" name="telefone" type="text" required/> 
  </div>      
</div>


<div class="form-group">
  <label class="control-label col-lg-2" for="">CPF</label> 
  <div class="col-lg-5">
        <input class="form-control" placeholder="CPF" id="cpf" name="cpf" type="text" required/> 
  </div>      
</div>

<div class="form-group">
  <label class="control-label col-lg-2" for="">Plano</label>
  <div class="col-lg-10">
         <select class="form-control" id="plano">
             <option value="2">Plano mensal R$ 50,00 - 40% de desconto - Valor final: R$ 30,00</option>
         </select>                          
  </div>    
</div>


    <div class="form-group">
      <label class="control-label col-lg-2" for=""></label> 
      <div class="col-lg-10">
         <label>
            <input type="checkbox" name="tour_gratuito" value="1" id="tour_gratuito"/>
            Tour gratuito de uma semana
         </label>
      </div>      
    </div> -->


    <div align="center">

    <input required type="checkbox" name="agree" align="center" id="agree"/>
    <table>Concordo com os <a href="#" class="termos-uso"> termos de uso </a> e <a href="#" class="politica-privacidade"> política de privacidade</a> 
                              
    </table>
    </div>
                                       
</div>
</div>
</div>
</div>
      

<div class="form-group">
<label class="col-md-4 control-label"></label>
<div class="col-md-4">



  <input class="btn-wide" type="submit"><br><br>
    

</div>
</div>

</fieldset>
</form>

 <!-- <form id="comprar" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
    <input type="hidden" name="code" id="code" value="" />
       {{ csrf_field() }}
    </form>
    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script> -->

</div>
</div>


</section>
</section>

<div class="text-right">
  <div class="credits">

<!-- 
    All the links in the footer should remain intact. 
    You can delete the links only if you purchased the pro version.
    Licensing information: https://bootstrapmade.com/license/
    Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
-->
                
  </div>
  </div>
  </section>
  
  
  
<div class="modal fade modal-lg" tabindex="-1" role="dialog" id="modal-termos">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">
         @include('includes.termos')
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

  
<div class="modal fade modal-lg" tabindex="-1" role="dialog" id="politica-privacidade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">
           @include('includes.politica')
                          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 





    <!-- javascripts -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery knob -->
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <script src="js/advogafuncoes.js?v=3"></script>


  <script>

     $(document).ready(function($){
      
        $('select[name=state_id]').change(function(){
               
                $.get("{{ url('ajax/cities')}}", 
                { state_id: $(this).val() }, 
                function(data) {
                    city = 'select[name="city_id"]';
                    selectUpdate(city, data ,"");
                });
        });
        
        $('#photo').change(function(){
           
           var filename = $(this).val().split('\\').pop();
           
           $("#upload-file-info").html(filename);
        });
        
        $('.termos-uso').click(function(e){
             
            e.preventDefault(); 
            
            $('#modal-termos').modal('show');
        
        });
        
        $('.politica-privacidade').click(function(e){
             
            e.preventDefault(); 
            
            $('#politica-privacidade').modal('show');
        
        });
        
        
        $('#formCadastro').on('submit',function(e){
            
            if ($('#agree').prop('checked')!=true){
                
                alert('Você deve concordar com os termos de uso.');
                
                e.preventDefault();
                return false;
            }
            
            return true;
        });
       
        
        
      });

 

   function register(){
      $.post("{{route('user.store')}}", $("#formzera").serialize() , function (data) {
        if(data.errors!==undefined){

          $.each(data.errors, function(index, value){

             alert( index + ": " + value );
          });

        }
       // var id = data.replace("ID: ", "");
        
      //  if ($('#tour_gratuito').prop('checked')){
      //    window.location.href="{{asset('redirectpath')}}";
       //   return;
       // }
          

     //   var url="{{asset('user/pagamento')}}/"+id;

     //   $.post(url, $("#comprar").serialize(), function(data) {
          

     //     $('#code').val(data);
      //   $('#comprar').submit();
      //  })
        return true;
      })
    }
   


  </script>
  
  
  </body>
</html>

