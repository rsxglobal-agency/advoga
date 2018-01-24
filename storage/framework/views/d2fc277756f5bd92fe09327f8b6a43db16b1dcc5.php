<!DOCTYPE html>  
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Advoga - Aproximando comarcas, unindo profissionais, agilizando o Direitos</title>

    <base href="<?php echo e($app->make('url')->to('/')); ?>/"/>
    
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
         width: 80%;
         max-width: 1024px !important;
         margin: auto;
      }
      
      @media(max-width:768px){
         body .modal-lg .modal-dialog{
             width: 95%;
             margin: auto;
         }
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
 
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                              <div class="form">
                                  

                                  <?php echo Form::open(['route' => 'user.store','files'=>true,'id'=>"formCadastro",'class'=>"form-validate form-horizontal"]); ?>

                                     
                                      <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">Nome Completo <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class=" form-control" id="name" name="name" type="text" required/>
                                          </div>
                                      </div>
                                       
                                    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                        <label for="email" class="col-md-control-label col-lg-2 control-label">E-Mail <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>
                                            
                                        </div>
                                    </div>
                                    

                                      
                                       <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
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
                                          <?php echo Form::select('state_id', App\State::pluck('name', 'id'), null, ['class'=>'form-control selectpicker', 'placeholder'=>'Selecione um Estado' ]);; ?>

                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Cidade:</label>
                                      <div class="col-lg-3">
                                          <select id="city_id" name="city_id"  class="form-control selectpicker">
                                          </select></div>
                                    </div>

                                    <!-- FIM Seleção de estado -->

                                    <!-- INÍCIO da Titulação -->

                                      <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Titulação:</label>
                                      <div class="col-lg-3">
                                      <?php echo Form::select('titulation_id', App\Titulation::pluck('name', 'id'), null, ['class'=>'form-control selectpicker', 'placeholder'=>'Selecione uma Titulação' ]);; ?>

                                          </div></div>

                                        <!-- FIM da Titulação -->
                                        
                                        <!-- INÍCIO da Formação -->

                                      <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Formação:</label>
                                      <div class="col-lg-3">
                                      <?php echo Form::select('formation_id', App\Formation::pluck('name', 'id'), null, ['class'=>'form-control selectpicker', 'placeholder'=>'Selecione uma Formação' ]);; ?>

                                          
                                          </div></div>

                                    <!-- FIM da Formação -->
                                    
                             <!-- INÍCIO da Áreas de Atuação -->
                              <div class="form-group">
                                  <label class="control-label col-lg-2" for="inputSuccess">Selecione uma Área de Atuação</label>
                                  <p><h4></h4></p>
                                    
                                
                                  <table align="left" width=850 height=100>
                                       <tr>
                                        <?php $__currentLoopData = $atuations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col=>$values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <td>
                                              <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <input type="checkbox" name="atuation_id[]" value="<?php echo e($val['id']); ?>"> <?php echo e($val['name']); ?><br>                      
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tr>                                 
                                  </table>
                              
                             </div>
                             <!-- FIM da Áreas de Atuação -->
                            
                             <!-- INÍCIO Serviços Prestados -->
                                
                            <div class="form-group">
                                <label class="control-label col-lg-2" for="inputSuccess">Selecione serviços para prestar:</label>
                                <p><h4></h4></p>
                                  <table align="left" width=850 height=100>
                                       <tr>
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col=>$values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <td>
                                              <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <input type="checkbox" name="service_id[]" value="<?php echo e($val['id']); ?>"> <?php echo e($val['name']); ?><br/>                      
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tr>                                 
                                  </table>
                                <br/><br/>
                            </div>
                            <!-- FIM Serviços Prestados -->

                    <!-- INÍCIO Currículo -->
                    
                    <div class="form-group">
                       <label class="control-label col-lg-2" for="inputSuccess">Escreva uma frase de apresentação: (max. 200 caracteres)</label>
                       <div class="col-lg-10">
                          <p><h4></h4></p>
                          <textarea class="form col-lg-10" name="description" maxlength="200" placeholder="Olá, meu nome é fulano e trabalho em uma determinada área."></textarea>
                       </div> 
                    </div>
                    
                    <!-- FIM Currículo -->

<!-- INÍCIO rede social -->


 <div class="form-group">
  <label class="control-label col-lg-2" for="inputSuccess">Qual o link da sua principal rede social?</label>
  <div class="col-lg-10">
    <p><h4></h4></p>
    <textarea class="form col-lg-10" name="social" maxlength="200" placeholder="linkedin.com/fulanodetal"></textarea><br/>

  </div> 
      
</div>

<div class="form-group">
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
</div>


<div class="form-group">
  <label class="control-label col-lg-2" for="">Telefone</label>
  <div class="col-lg-2">
        <input class="form-control" id="area_code" name="area_code" type="text" maxlength="2" required/>                            
  </div>  
  <div class="col-lg-3">
        <input class="form-control" id="telefone" name="telefone" type="text" required/> 
  </div>      
</div>


<div class="form-group">
  <label class="control-label col-lg-2" for="">CPF</label> 
  <div class="col-lg-5">
        <input class="form-control" id="cpf" name="cpf" type="text" required/> 
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
            <input type="checkbox" name="tour_gratuito"  id="tour_gratuito"/>
            Tour gratuito de uma semana
         </label>
      </div>      
    </div>


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
         <h2 class="text-center">TERMO DE USO E CADASTRO</h2>
          <p>
             O website e o aplicativo AdvogaApp (“Plataforma AdvogaApp”) são pertencentes a S.D.Q PARTICIPAÇÕES SOCIETÁRIAS LTDA, sociedade empresária limitada nos termos da Lei 10.406/02, registrada sob o CNPJ 27.353.238/0001-57, com sede à Rodovia Br 290, S/N, Km 121, Eldorado do Sul - RS, CEP 92990-000.
          </p>
          <p>Você pode entrar em contato conosco pelo e-mail: contato@advogaapp.com.br.</p>
          
          <p>ADVOGAApp atua como facilitador do contato entre advogados e sociedades de advogados que, interessados na realização de diligências e outras atividades de suporte à prática jurídica, contratem estes serviços através da plataforma ADVOGAApp junto a correspondentes jurídicos cadastrados no sistema.</p>
          <p>Além da atividade descrita acima, a plataforma advoga app oferece consultoria jurídica a todo e qualquer cidadão que procure nossos serviços, dirimindo dúvidas acerca de contendas e direcionando a parte a um dos advogados especialistas cadastrados em nosso sistema.</p>
          <p>Prestando esta consultoria, a ADVOGAApp não assume o papel de advogado particular da parte, atuando tão somente no sentido de estabelecer qual o próximo passo a ser dado com relação a demanda/situação que nos é apresentada, direcionando então a parte aos advogados que dispomos em nosso cadastro. Daí então a diferença entre prestar assessoria, ação que não executamos e a consultoria, atividade com a qual trabalhamos.</p>
          <p>Além destes termos e condições de uso, a nossa política de privacidade e as leis n.º 8.078/1990 (“Código de Defesa do Consumidor”), n.º 8.904/1994 (“Estatuto da Ordem dos Advogados do Brasil”) e o Código de Ética e Disciplina da Ordem dos Advogados do Brasil, regulam os termos e condições aplicáveis à utilização de nossa plataforma e a todo e qualquer serviço prestado pela ADVOGAApp. Ao utilizar nossos Serviços o usuário assume concordância com estes termos e condições de uso.</p>
          <p>Estes termos e condições podem ser alterados a qualquer momento, o que gerará aviso na plataforma. Caso você não concorde com alguma mudança feita, recomendamos que encerre sua conta e interrompa a utilização do advoga app. Caso não encerre sua conta, considerar-se-ão aceitos estes termos e condições de uso com suas alterações. </p>
        
          <p>Qualquer pessoa que utilizar nossos serviços, o que inclui a simples visita à plataforma, assume expressamente estar de pleno acordo com estes termos e condições de uso, bem como com os dispositivos legais mencionados.</p>
        
          <p>
           <strong>Parte I</strong> <br />
           <strong>Condições Gerais</strong><br />
           <strong>1.</strong> Sobre o AdvogaApp<br />
           <strong>1.1.</strong> A Plataforma AdvogaApp um portal pelo qual contratantes podem encontrar correspondentes jurídicos através de simples listagem de cadastrados. Na contratação, não há qualquer envolvimento da Plataforma AdvogaApp, bem como o AdvogaApp não atua como intermediário, agenciador ou parte na contratação de correspondentes jurídicos.<br />
           <strong>1.2.</strong> A plataforma AdvogaApp oferece consultoria jurídica limitada, a todo e qualquer cidadão que procure nossos serviços, dirimindo dúvidas acerca de contendas e direcionando a parte a um dos advogados especialistas cadastrados em nosso sistema, sem que com isso assuma o papel de advogado particular da parte. Atuamos dirimindo dúvidas apenas, o restante do atendimento é realizado pelo advogado escolhido pela parte.<br />
         </p>
         
         <p>
            <strong>2.1.4.</strong> Pela observância das condutas e regras da ordem dos advogados do brasil (“oab”) pelos correspondentes, mesmo que aconselhemos que as regras bem como a valorização do profissional sejam sempre observadas.<br />
         </p>
         <p>
            <strong>3. Capacidade</strong><br />
            <strong>3.1.</strong> A Plataforma AdvogaApp é destinada a pessoas físicas capazes e pessoas jurídicas devidamente representadas.<br />
            <strong>3.1.1.</strong> O Usuário que realizar o cadastro em nome de uma pessoa jurídica assume e declara possuir poderes para representa-la no tocante a estes termos e condições de uso e em outras disposições referentes ao uso da plataforma. O usuário que realizar o cadastro em nome de pessoa jurídica responderá solidariamente perante o AdvogaApp por qualquer violação aos termos, pelo abuso dos poderes de representação que tiver ou à legislação aplicável.<br />
            <strong>3.2.</strong> O AdvogaApp recomenda que a utilização de nossa plataforma pelos usuários não se dê em confronto com as determinações da OAB com relação à prestação de serviços de diligências e outras atividades de suporte à prática jurídica.
         </p>
         
         <p>
        <strong>4. Disponibilidade da Plataforma AdvogaApp</strong><br />
        <strong>4.1.</strong> O AdvogaApp não se responsabiliza por qualquer indisponibilidade da Plataforma JC ou de seus serviços, por qualquer período ou momento.<br />
        <strong>4.2.</strong> O acesso à plataforma pode ser interrompido, suspenso ou ficar intermitente temporariamente, sem qualquer aviso prévio, em caso de falha de sistema ou servidor, manutenção, alteração de sistemas, ou por qualquer motivo que escape ao nosso controle, sem que se faça devida qualquer reparação por parte deste.<br />
        <strong>4.2.1.</strong> Para que as ocorrências acima não causem dano, prejuízo ou perda aos usuários, recomendamos fortemente que contratantes e contratados mantenham formas redundantes em sua parceria, sendo certo que não será devida qualquer reparação ou indenização por parte do AdvogaApp, isentando-o de responsabilidade.<br />
        </p>
        
        <p>
          <strong>5. Conteúdo</strong><br />
          <strong>5.1.</strong> O AdvogaApp não é responsável por quaisquer defeitos ou vírus e outros possíveis problemas que possam atingir a plataforma. <br />
          <strong>5.2.</strong> O AdvogaApp poderá alterar o conteúdo da plataforma a qualquer momento, sem prévio aviso.<br />
          <strong> 5.3.</strong> O AdvogaApp poderá, a qualquer momento e a seu exclusivo critério, adicionar ou remover conteúdos e funcionalidades da plataforma sem que isso caracterize, sob qualquer forma, ofensa aos direitos adquiridos dos usuários.<br />
        </p>
        
        
         <p>
            <strong>6. Direitos de Propriedade Intelectual</strong><br />
            <strong>6.1.</strong> O uso comercial do nome, dos desenhos e da expressão “AdvogaApp” como nome empresarial, marca, ou nome de domínio, bem como os conteúdos das telas relativas aos Serviços do AdvogaApp assim como os programas, bancos de dados, documentos e demais utilidades e aplicações que permitem ao usuário acessar e usar sua conta de usuário são de propriedade do AdvogaApp e estão protegidos por todas as leis e tratados aplicáveis.<br />
            <strong>6.2.</strong> O uso indevido e a reprodução total ou parcial dos conteúdos referidos no item 1 são proibidos. Caso deseje utilizar algum destes conteúdos, Você deverá entrar em contato conosco antes de fazê-lo. Usar qualquer conteúdo aqui mencionado sem a prévia e expressa autorização do AdvogaApp poderá acarretar em responsabilizações penais e civis.
         </p>
         <p>
          <strong>7. Privacidade</strong><br />
          <strong>7.1.</strong> Ao nos prover com suas informações pessoais, você nos autoriza a divulgar e/ou utilizar estas informações estritamente nos termos previstos na política de privacidade disponível na plataforma em https://www.advogaapp.com.br
        </p>
         <p>
            <strong>8. Rescisão</strong><br />
            <strong>8.1.</strong> Para promover o bom funcionamento e qualidade dos serviços da plataforma, o AdvogaApp se reserva no direito de, sem a necessidade de notificação prévia, impedir ou interromper o acesso do usuário que, segundo nossa gerência, estiver atuando de qualquer forma a violar qualquer disposição destes termos e condições de uso, da política de privacidade ou de qualquer contrato celebrado por meio da plataforma AdvogaApp.
        </p>
        <p>
            <strong>9. Demais Condições</strong><br />
            <strong>9.1.</strong> O AdvogaApp é uma empresa brasileira. A Plataforma AdvogaApp e seus serviços são criados e mantidos em fiel cumprimento às leis brasileiras e demais tratados que são incorporados à jurisdição brasileira. Caso a utilização dos nossos serviços esteja sendo feita fora do Brasil, o usuário será responsável pelo cumprimento das leis locais, na medida em que forem aplicáveis.<br />
            <strong>9.2.</strong> Estes termos e condições de uso, bem como qualquer outra disposição referente ao uso da plataforma, não estabelece qualquer vínculo societário, trabalhista de representação, agenciamento, consórcio ou de qualquer outra natureza entre os usuários e o AdvogaApp.<br />
            <strong>9.3.</strong> Caso o AdvogaApp deixe de exercer qualquer direito previsto nestes termos e condições de uso, isto não deverá ser interpretado como uma renúncia, abdicação ou revogação de disposição.<br />
            <strong>9.4.</strong> Todos os itens destes termos e condições de uso serão regidos pelas leis vigentes da República Federativa do Brasil. Para dirimir quaisquer controvérsias é eleito o Foro da Cidade de Porto Alegre no Estado do Rio Grande do Sul, exceção feita a reclamações apresentadas por usuários que se enquadrem no conceito legal de consumidores, que poderão submeter suas queixas que não encontrarem solução amigável ao foro da cidade em que forem radicados, conforme artigo 101, I do Código de Defesa do Consumidor.
        </p>
        
        <p>
            <strong>Parte II</strong><br />
            <strong>Termos e Condições Adicionais para Usuários Contratantes</strong><br />
            Para usufruir das funcionalidades da plataforma AdvogaApp, é preciso que você logado em uma conta de usuário, a partir deste momento, deverão ser observados os termos que seguem:
        </p>
        
        <p>
            <strong>10. Sobre o AdvogaApp</strong><br />
            <strong>10.1.</strong> O usuário contratante expressamente reconhece que não há entre o AdvogaApp e o correspondente qualquer vínculo trabalhista ou societário.<br />
            <strong>10.2.</strong> O AdvogaApp é remunerado, entre outras formas, por uma comissão incidente sobre o valor cobrado do usuário correspondente na contratação de serviços por meio de pagamento disponível na plataforma.<br />
            <strong>10.3.</strong> Nenhuma pessoa que não o AdvogaApp está autorizada a cobrar qualquer taxa em nome do AdvogaApp.
        </p>
        
        <p>
            <strong>11. Condições Aplicáveis aos Serviços</strong><br />
            <strong>11.1. O Serviço</strong><br />
            <strong>11.1.1.</strong> O AdvogaApp não participa e não assume qualquer responsabilidade pela negociação ou ajuste de qualquer questão relacionada com a contratação e a prestação de serviço entre o usuário contratante e o correspondente, incluindo, mas não se limitando a valor da contratação, data da prestação do serviço, etc.<br />
            <strong>11.1.2.</strong> Todas as informações relativas à contratação anunciadas na plataforma são fornecidas pelos correspondentes sem qualquer envolvimento do AdvogaApp.<br />
            <strong>11.1.3</strong> É fortemente recomendável que o usuário contratante se certifique de todas as condições estabelecidas pelo correspondente. As informações presentes na plataforma AdvogaApp podem não corresponder à totalidade das regras aplicáveis na relação do usuário contratante com o correspondente.<br />
            <strong>11.1.4</strong> Seja antes ou depois da contratação de serviços de correspondentes anunciados, os usuários contratantes expressamente reconhecem que o AdvogaApp não é e nem será responsável por qualquer monitoramento ou supervisão sobre as práticas e políticas adotadas na contratação e na realização dos serviços entre o usuário contratante e o correspondente.<br />
            <strong>11.1.5.</strong> Eventuais avaliações de outros usuários disponibilizadas na plataforma não têm qualquer participação ou interferência do AdvogaApp.<br />
            <strong>11.1.6.</strong> Eventuais mudanças nas condições gerais da contratação e na realização de serviços de correspondente (mudança de preço, disponibilidade do serviço e outras características intrínsecas aos serviços) devem ser sempre confirmadas com o correspondente envolvido. O AdvogaApp não tem acesso a tais informações e não tem responsabilidade em oferecê-las aos usuários.<br />
            <strong>12.1.6.1.</strong> O AdvogaApp não tem qualquer obrigação de notificar as mudanças mencionadas no item anterior, sendo sempre recomendável que o usuário contratante consulte de tempos em tempos eventuais alterações com os correspondentes.<br />
         </p>
        <p>
            <strong>11.2. Pagamento</strong><br />
            <strong>11.2.1.</strong> O pagamento de serviços de correspondentes anunciados por meio da plataforma pode ser realizado via cartão de crédito, débito em conta corrente, boleto bancário ou outro meio de pagamento online, desde que disponível na plataforma AdvogaApp.<br />
            <strong>11.2.1.</strong> Ao escolher um dos meios de pagamento oferecidos no site, o usuário contratante expressamente reconhece que o processamento de seus pagamentos pelos serviços prestados a ele será efetuado por terceiros prestadores desses serviços, sem qualquer envolvimento do AdvogaApp. Qualquer erro ou falha no processamento nestas transações poderá prejudicar a continuidade dos serviços prestados pelo correspondente, sem culpa ou responsabilidade do AdvogaApp.<br />

        </p>
        <p><strong>11.3. Direitos e Obrigações do Usuário Contratante</strong><br />
            11.3.1. É responsabilidade exclusiva do usuário contratante garantir a solvência para a contratação de advogado.<br />
            11.3.2. Ao Usuário Contratante será sempre garantida a livre escolha na contratação do correspondente.
        </p>
        <p>
        <strong>11.4. Exclusões de responsabilidade</strong><br />
        <strong>11.4.1.</strong> O usuário contratante expressamente reconhece que ao usar a plataforma AdvogaApp, o AdvogaApp não se responsabiliza por questões intrínsecas a contratação e/ou prestação de serviços de correspondentes contratados por meio da plataforma, o que inclui, mas não se limita a:<br />
        <strong>11.4.1.1.</strong> Qualidade, disponibilidade ou completude dos serviços realizados pelos correspondentes anunciados na plataforma.<br />
        <strong>11.4.1.2.</strong> Danos eventualmente causados ao usuário contratante ou a terceiro pelo correspondente ou por terceiro na prestação de serviços contratados.<br />
        <strong>11.4.1.3.</strong> Indenizações ou reparações de danos sofridos por usuário contratante ou terceiros causados por outros usuários contratantes, por correspondentes ou por terceiros na contratação de correspondentes anunciados na plataforma ou na prestação de serviços de correspondentes.<br />
        <strong>11.4.1.4.</strong> É expressamente assegurado ao AdvogaApp o direito de regresso caso o AdvogaApp venha a arcar com qualquer reparação relativa aos itens destes termos.
        </p>
        
        <p>
        <strong>11.5. Práticas vedadas</strong> <br />
        <strong>11.5.1.</strong> Os Usuários Contratantes aceitam e se comprometem a utilizar a plataforma AdvogaApp sem que haja:<br />
        <strong>11.5.2.</strong> Violação destes termos e condições de uso e quaisquer outras disposições referentes ao uso da plataforma AdvogaApp; e,<br />
        <strong>11.5.3.</strong> Violação de qualquer lei ou norma vigente no ordenamento jurídico brasileiro<br />
       </p>
       
       <p>

            <strong>12. Cadastro e Registro</strong><br />
            <strong>12.1.</strong> Quando o usuário contratante realiza o seu cadastro na plataforma AdvogaApp, o usuário contratante atesta que todos os dados fornecidos por ele são verdadeiros, completos e precisos.<br />
            <strong>12.1.1.</strong> Prover informações incompletas, imprecisas ou falsas constitui violação dos deveres destes termos e condições de uso, estando o usuário contratante inteiramente responsável pelos danos a que tal violação der causa.<br />
            <strong>12.1.2.</strong> O AdvogaApp pode necessitar de mais informações e documentos sobre o usuário contratante a qualquer tempo, seja para melhor identificá-lo ou para conduzir diligências internas, caso em que o usuário contratante será requerido a fornecê-las. Não fornecer prontamente tais informações e documentos quando requisitado constituirá violação destes termos e condições de uso.<br />
            <strong>12.2.</strong> As informações que o usuário contratante utilizar para preencher o nosso cadastro podem mudar e este assume o compromisso de mantê-las sempre atualizadas, alterando-as tão logo ocorra alguma modificação.<br />
            <strong>12.3.</strong> O AdvogaApp poderá se valer de todas as formas lícitas para verificar, a qualquer tempo, se as informações que o usuário contratante nos proveu são verdadeiras.<br />
            <strong>12.3.1.</strong> Se o AdvogaApp constatar que as informações disponibilizadas pelo usuário contratante são de alguma forma incompletas, imprecisas ou falsas, o usuário  contratante poderá ter sua conta de usuário suspensa ou cancelada, a exclusivo critério do AdvogaApp, sem prejuízos de outras medidas que sejam aplicáveis, caso em que não serão devidos quaisquer reembolsos.<br />
            <strong>12.4.</strong> O cadastro na plataforma AdvogaApp é pessoal e intransferível.<br />
            <strong>12.5.</strong> Cada usuário contratante só poderá manter um único cadastro junto à plataforma.<br />
            <strong>12.6.</strong> O AdvogaApp emprega seus melhores esforços para garantir a segurança do seu cadastro, contudo, o sigilo e a segurança do seu nome de usuário e senha são de sua única e exclusiva responsabilidade. Nenhuma contratação poderá ser anulada ou cancelada em razão de má proteção do usuário contratante sobre seus dados de acesso.<br />
            
       </p>
       
       <p>
            <strong>13. Rescisão</strong><br />
            <strong>13.1.</strong> As condições para o cancelamento de serviços de correspondentes são tratadas exclusivamente entre usuário contratante e o correspondente contratado, sem qualquer interferência do AdvogaApp.<br />
            <strong>13.2.</strong> O usuário contratante poderá cancelar sua conta na plataforma AdvogaApp a qualquer tempo.<br />
            <strong>13.2.1.</strong> O cancelamento da conta na plataforma AdvogaApp em nenhuma hipótese escusará o usuário contratante do cumprimento de obrigações previamente assumidas perante o AdvogaApp e outros usuários.<br />
            <strong>13.3.</strong> Para promover o bom funcionamento e qualidade dos serviços da plataforma, o Advoga se reserva no direito de, sem a necessidade de notificação prévia, suspender, impedir ou interromper o acesso do usuário contratante, que, segundo o AdvogaApp, estiver atuando de qualquer forma a violar qualquer disposição destes termos e condições de uso, da política de privacidade ou de qualquer contrato celebrado por meio da plataforma AdvogaApp.<br />
            <strong>13.4.</strong> O AdvogaApp poderá suspender o cadastro de usuário contratante quando o uso da plataforma AdvogaApp violar qualquer condição estabelecida por estes termos ou por outra disposição referente ao uso da plataforma.<br />
            <strong>13.4.1.</strong> A suspensão de cadastro de usuário contratante na plataforma ocorrerá após notificação de qualquer usuário ao AdvogaApp sobre o uso inadequado da plataforma por usuário contratante infrator.<br />
            <strong>13.4.2.</strong> Nas hipóteses de suspeita de uso inadequado ou de reincidência de tal uso da plataforma, o usuário contratante também poderá ter seu cadastro cancelado na plataforma AdvogaApp.<br />
            <strong>13.5.</strong> O AdvogaApp poderá interromper o acesso e uso do serviço de usuário contratante que tenha decretada a sua falência ou que perca qualquer autorização necessária ao desenvolvimento de sua atividade.<br />
            <strong>13.6.</strong>Caso o cadastro do usuário contratante seja interrompido ou cancelado pelo AdvogaApp, todas as contratações de correspondentes pendentes na plataforma AdvogaApp deverão ser concluídas com a totalidade dos pagamentos aos devidos usuários correspondentes.
       </p>
       
           <p>
    
    <strong>Parte III</strong><br />
    <strong>Termos e Condições Adicionais Para Usuários Contratados</strong><br />
    Quando o correspondente ou o advogado estiverem usufruindo das funcionalidades da plataforma AdvogaApp para as quais é necessário estarem “logados” em uma conta de usuário contratado, deverão ser observados estes termos e condições adicionais para usuários contratados.
           </p>
         <p>
           <strong> A - Usuário Contratado como Correspondente (“Usuário Correspondente”)</strong>
         </p> 
         
         <p>
           <strong>14. Sobre o AdvogaApp</strong><br />
           <strong>14.1.</strong> O AdvogaApp é remunerado, entre outras formas, pela aquisição de Plano pelo Usuário Correspondente para a utilização da Plataforma JC, conforme item 20.1 destes Termos e Condições de Uso.<br />
           <strong>14.2.</strong> Nenhuma pessoa que não o AdvogaApp está autorizada a cobrar qualquer taxa em nome do AdvogaApp.
        </p> 
        
        <p>
                    
            <strong>15. Condições Aplicáveis aos Serviços</strong><br />
            <strong>15.1.</strong> O Serviço<br />
            <strong>15.1.1.</strong> O AdvogaApp não participa e não assume qualquer responsabilidade pela negociação ou ajuste de qualquer questão relacionada com a contratação e a prestação de serviço entre o contratante e o usuário correspondente, incluindo, mas não se limitando a valor da contratação, tipo de serviço, prazo de entrega etc.<br />
            <strong>15.1.2.</strong> Para realizar o anúncio como correspondente na plataforma AdvogaApp, o usuário correspondente deverá possuir pleno conhecimento e capacidade sobre o serviço ao qual se prontifica a fazer.<br />
            <strong>15.1.2.1.</strong> O usuário correspondente responde civilmente por quaisquer danos causados aos contratantes nos termos dos artigos 186 e 927 do Código Civil Brasileiro.<br />
            <strong>15.1.3.</strong> Todas as informações relativas aos correspondentes anunciados na plataforma são fornecidas pelo usuário correspondente sem qualquer envolvimento do AdvogaApp.<br />
            <strong>15.1.3.1</strong> O Usuário Correspondente é inteiramente responsável pela veracidade e completude dos dados fornecidos através da Plataforma AdvogaApp.<br />
            <strong>15.1.4.</strong> O AdvogaApp não se responsabiliza por eventuais indisponibilidades ou falhas no serviço, o que inclui, mas não se limita a indisponibilidades ou falhas que deem causa:<br />
            <strong>15.1.4.1.</strong> A perda dos dados do usuário correspondente produzidos e armazenados no serviço, motivo pelo qual é fortemente recomendado que o usuário correspondente realize constantemente back-ups de suas informações; e,<br />
            <strong>15.1.4.2.</strong> A impossibilidade de conclusão de uma contratação de correspondente, motivo pelo qual é fortemente recomendado que o usuário correspondente mantenha formas alternativas e redundantes para a disponibilização online de seus serviços.<br />
            <strong>15.2.</strong> A contratação de serviços de usuários correspondentes<br />
            <strong>15.2.1.</strong> O pedido de prestação de serviço realizado pelo contratante será recebido pelo usuário correspondente através da Plataforma AdvogaApp.<br />
            <strong>15.2.2.</strong> O Usuário Correspondente expressamente reconhece que o processamento de seus pagamentos pelos seus serviços prestados será efetuado por terceiros prestadores desses serviços, sem qualquer envolvimento do AdvogaApp. Qualquer erro ou falha no processamento nestas transações não será responsabilidade do AdvogaApp.<br />
            <strong>15.2.3.</strong> Toda e qualquer reclamação ou mudança do serviço contratado deverá ser comunicada diretamente entre o contratante e o usuário correspondente.<br />
            <strong>15.2.3.1.</strong> As reclamações vinculadas à contratação de serviços de correspondentes serão de responsabilidade exclusiva do usuário correspondente, que deverá analisa-las e resolve-las, arcando, em quaisquer hipóteses, com eventual valor de ressarcimento dos serviços.<br />
            <strong>15.2.3.2.</strong> Caso o AdvogaApp venha a arcar com qualquer despesa na intervenção de reclamações recebidas de usuários da plataforma AdvogaApp, caberá ao usuário correspondente o reembolso de todos os valores despendidos pelo AdvogaApp.<br />

        </p> 
        <p>
        <strong>16. O Usuário Correspondente se obriga a:</strong><br />
        <strong>16.1.</strong> Manter o seu perfil atualizado, contendo todas as informações necessárias, incluindo, mas não se limitando a nome, telefone, e-mail e região em que atua;<br />
        <strong>16.2.</strong> Realizar o atendimento aos contratantes conforme previsto nestes termos e condições de uso; e,<br />
        <strong>16.3.</strong> Arcar integralmente com todo e qualquer ônus que advenha de quaisquer fatos da prestação de serviço de correspondente, o que inclui, mas não se limita a inconformidade com os padrões esperados de qualidade etc.<br />
        <strong>16.4.</strong> O Usuário Correspondente se obriga em caráter irrevogável e irretratável a indenizar e manter indene o AdvogaApp por toda e qualquer perda proveniente ou relativa ao descumprimento de qualquer termo, condição, disposição e/ou obrigação assumida pelo usuário correspondente nestes termos e nos demais documentos vinculados a este.<br />
        <strong>16.4.1.</strong> Caso o AdvogaApp venha a figurar no polo passivo de qualquer demanda judicial, cujo litígio advenha da prestação de serviço de correspondente anunciada na plataforma AdvogaApp, o usuário correspondente expressamente reconhece que será denunciado à lide nos termos do artigo 125, II da Lei n° 13.105 de 2015 ("Código de Processo Civil"), devendo arcar com todos os ônus que daí ocorra, inclusive com os custos legais para defesa do AdvogaApp.<br />
      </p>
      
      <p>
            <strong>17. Exclusões de responsabilidade</strong><br />
            <strong>17.1.</strong> O usuário correspondente expressamente reconhece que o AdvogaApp, por apenas facilitar o encontro de contratantes e de usuários correspondentes, não é responsável por questões intrínsecas à contratação de correspondente ou à prestação de serviços de usuários correspondentes, o que inclui, mas não se limita a:<br />
            <strong>17.1.1.</strong> Efetiva capacidade ou solvência dos usuários da plataforma para a contratação de serviços de correspondentes anunciados na plataforma AdvogaApp.<br />
            <strong>17.1.2.</strong> Danos eventualmente sofridos pelo usuário correspondente ou terceiros causados pelos contratantes ou por terceiros na contratação e/ou na prestação de serviços de correspondentes anunciados na plataforma AdvogaApp.<br />
            <strong>17.1.3.</strong> Indenizações ou reparações de danos causados pelo usuário correspondente ou por terceiros aos contratantes e/ou a terceiros na contratação ou na prestação de serviços de correspondente anunciados na plataforma AdvogaApp.<br />
            <strong>17.1.4.</strong> É expressamente assegurado ao AdvogaApp o direito de regresso caso o AdvogaApp venha a arcar com qualquer reparação relativa ao item 17.1.3 acima.<br />
      </p>
      
      
     <p>
        <strong>18. Aquisição de Plano</strong><br />
        <strong>18.1.</strong> Para se listar como correspondente no AdvogaApp, o usuário correspondente deverá adquirir um plano. Para tanto, o usuário correspondente será cobrado através do meio de pagamento escolhido.<br />
        <strong>18.1.1.</strong> Os planos têm cobrança mensal, reservando-se o AdvogaApp o direito de modificar o valor da referida mensalidade, mediante aviso prévio.<br />
        <strong>18.1.2.</strong> A cobrança do valor referente a uma mensalidade será cobrada todo início de um período de 30 dias, que pode ou não coincidir com o início do mês-calendário. Uma vez pago um ciclo de cobrança, não haverá reembolso em caso de pedido de cancelamento, ficando o acesso irrestrito à plataforma e seus serviços previsto no plano adquirido disponível até o fim do referido ciclo de cobrança.<br />
        <strong>18.1.3.</strong> Um pedido de cancelamento deverá ser feito utilizando as ferramentas indicadas na plataforma. A cobrança da mensalidade será interrompida no ciclo mensal subsequente.<br />
     </p>
     
     <p>
        <strong>19. Condições para a Manutenção de Perfis de Correspondente</strong><br />
        <strong>19.1.</strong> A OAB permite que advogados e sociedades de advogados anunciem seus serviços, porém existem certas restrições. O usuário correspondente se compromete a observar as regras relativas à publicidade, informação e propaganda da advocacia, em especial aquelas advindas do Estatuto, do Código de Ética e Disciplina e do Provimento n. 94/2000 da OAB.<br />
        <strong>19.1.1.</strong> O uso das ferramentas e funcionalidades da plataforma AdvogaApp em descumprimento com as regras referidas neste item pode acarretar em sanções disciplinares e responsabilizações civis e penais. O usuário correspondente expressamente reconhece ser o único responsável por essas sanções e responsabilizações, mantendo o AdvogaApp indene de quaisquer prejuízos advindos de sua ação ou omissão no uso da plataforma.<br />
        <strong>19.2.</strong> A criação e manutenção de um perfil de usuário correspondente para ser exposto na plataforma AdvogaApp estão condicionadas à compra de um plano, conforme item 19.1 destes termos e condições de uso.<br />
        <strong>19.2.1.</strong> A exposição do perfil de usuário correspondente é condicionada ao pagamento dos valores relativos ao plano escolhido. O AdvogaApp poderá suspender o perfil caso o pagamento não seja efetuado nos termos do item 19, ou a compra de um plano não seja renovada.<br />
        <strong>19.2.2.</strong> Os planos poderão incluir a atribuição de prioridade na exibição do perfil de usuário correspondente sobre os demais perfis listados. Entretanto, a ordem de exibição de um perfil também poderá ser alterada em função dos critérios disponíveis no item 19.4, abaixo.<br />
        <strong>19.2.3.</strong> O AdvogaApp poderá, a seu exclusivo critério, suspender, excluir ou cancelar perfis de usuários correspondentes que não observem as regras previstas nos itens deste termo e demais regras legislativas mencionadas, sem que se façam devidas quaisquer reparações, reembolsos ou indenizações.<br />
        <strong>19.3.</strong> O AdvogaApp não garante ao correspondente:<br />
        <strong>19.3.1.</strong> Qualquer exclusividade geográfica, temática ou de qualquer outra sorte;<br />
        <strong>19.3.2.</strong> Qualquer direito de reembolso por arrependimento na aquisição de um plano, para além dos direitos previstos em lei. Qualquer devolução de valores para além das requeridas por lei será feita por mera liberalidade do AdvogaApp;<br />
        <strong>19.3.3.</strong> A percepção de qualquer incremento em sua clientela; e,<br />
        <strong>19.3.4.</strong> A idoneidade, solvência ou adimplência dos contratantes que venham a entrar em contato por meio da visualização de um perfil na plataforma.<br />
        <strong>19.4.</strong> A exibição do perfil aos contratantes da plataforma AdvogaApp poderá variar e/ou ocorrer de acordo com os seguintes critérios:<br />
        <strong>19.4.1.</strong> Prioridade ou destaque de exibição do plano adquirido;<br />
        <strong>19.4.2.</strong> Recomendações recebidas dos demais usuários; e,<br />
        <strong>19.4.3.</strong> Localização da demanda e disponibilização do usuário correspondente.<br />
        <strong>19.6.</strong> O AdvogaApp poderá, a qualquer momento e a seu exclusivo critério e sempre com vistas a aprimorar a experiência dos usuários, adicionar ou remover conteúdos e funcionalidades de sua plataforma sem que isso caracterize, sob qualquer forma, ofensa a direito adquirido dos usuários.<br />
     </p>    
     
     <p>
        <strong>20. Cadastro e Registro</strong><br />
        <strong>20.1.</strong> Quando o usuário correspondente realiza seu cadastro na plataforma, este atesta que todos os dados fornecidos por ele são verdadeiros, completos e precisos.<br />
        <strong>20.1.1.</strong> Prover informações incompletas, imprecisas ou falsas constitui violação dos deveres destes termos e condições de uso, estando o usuário correspondente inteiramente responsável pelos danos a que tal violação der causa.<br />
        <strong>20.1.2.</strong> O AdvogaApp pode necessitar de mais informações e documentos sobre o usuário correspondente a qualquer tempo, seja para melhor identificá-lo ou para conduzir diligências internas, caso em que o usuário será requerido a fornecê-las. Não fornecer prontamente tais informações e documentos quando requisitado constituirá violação dos termos e condições de uso.<br />
        <strong>20.2.</strong> As informações que o usuário correspondente utilizar para preencher o nosso cadastro podem mudar, assim este assume o compromisso de mantê-las sempre atualizadas, alterando-as tão logo ocorra alguma modificação.<br />
        <strong>20.3.</strong> O AdvogaApp poderá se valer de todas as formas lícitas para verificar, a qualquer tempo, se as informações que o usuário nos proveu são verdadeiras.<br />
        <strong>20.3.1.</strong> Se o  constatar que as informações do usuário são de alguma forma incompletas, imprecisas ou falsas, o usuário correspondente poderá ter sua conta suspensa ou cancelada, a exclusivo critério do AdvogaApp, sem prejuízos de outras medidas que sejam aplicáveis, caso em que não serão devidos quaisquer reembolsos.<br />
        <strong>20.4.</strong> O cadastro na plataforma AdvogaApp é pessoal e intransferível.<br />
        <strong>20.5.</strong> Cada usuário só poderá manter um único cadastro junto à plataforma AdvogaApp.<br />
        <strong>20.6.</strong> O AdvogaApp emprega seus melhores esforços para garantir a segurança do seu cadastro, contudo, o sigilo e a segurança do seu nome de usuário e senha são de sua única e exclusiva responsabilidade.
     </p>  
           
     <p><strong>21. Rescisão</strong></p>
     
    <p><strong>21.1.</strong> O usuário correspondente poderá cancelar sua conta na plataforma a qualquer tempo.<br />
        <strong>21.1.1</strong>. Ao encerrar a conta, o AdvogaApp enviará um e-mail ao usuário correspondente, no prazo de 1 (um) dia útil, para que este forneça sua confirmação ao procedimento de cancelamento de cadastro.<br />
        <strong>21.1.2.</strong> O encerramento da conta não desobriga o usuário correspondente de obrigações já previamente assumidas ou devido à época em que o cancelamento foi processado.<br />
        <strong>21.2.</strong> Para promover o bom funcionamento e qualidade dos serviços da plataforma, o AdvogaApp se reserva no direito de, sem a necessidade de notificação prévia, suspender, impedir ou interromper o acesso do usuário, que, segundo o AdvogaApp, estiver atuando de qualquer forma a violar qualquer disposição destes termos e condições de uso, da política de privacidade ou de qualquer contrato celebrado por meio da plataforma AdvogaApp.<br />
        <strong>21.3.</strong> O AdvogaApp poderá suspender o cadastro de usuário quando o uso da plataforma AdvogaApp violar qualquer condição estabelecida por estes termos ou por outra disposição referente ao uso.<br />
        <strong>21.3.1.</strong> A suspensão de cadastro ocorrerá após notificação do contratante ou de outro usuário correspondente que foi prejudicado pelo uso inadequado da plataforma.<br />
        <strong>21.3.2.</strong> Nas hipóteses de suspeita de uso inadequado ou de reincidência de tal uso da plataforma, o usuário também poderá ter seu cadastro cancelado.<br />
        <strong>21.3.1.</strong> O AdvogaApp poderá interromper o acesso e uso do serviço de qualquer usuário que tenha decretada a sua falência ou que perca qualquer autorização necessária ao desenvolvimento de sua atividade.
   </p>
   
   <p><strong>B - Usuário Contratado como Advogado</strong></p>
   
   <p>
        <strong>22. A Contratação de Serviços Jurídicos</strong><br />
        <strong> 22.1.</strong> Todas as condições aplicáveis aos usuários correspondentes, dispostas acima nestes termos e condições de uso, são aplicáveis aos usuários advogados, exceto as condições para a contratação de serviços de usuários correspondentes dispostas.<br />
        <strong>22.2.1.</strong> O pedido de prestação de serviço jurídico será encaminhado diretamente ao advogado bem como demais comunicações sobre a prestação de serviço jurídico contratado, sem qualquer intervenção do AdvogaApp.<br />
        <strong>22.2.2.</strong> A escolha e contratação de advogado são exclusivamente exercidas pelo contratante, e o AdvogaApp não será responsável por disponibilizar quaisquer informações sobre os serviços jurídicos do advogado, se comprometendo somente junto ao contratante de lhe repassar os contatos dos advogados cadastrados em nossa plataforma de acordo com a área de atuação e região desejados .<br />
        <strong>22.3.</strong> O advogado se compromete a observar as regras relativas ao exercício da advocacia, em especial aquelas advindas do Código de Ética e Disciplina da OAB, bem como do Estatuto da Advocacia. <br />
        <strong>22.3.1.</strong> É expressamente vedado ao advogado estabelecer honorários abaixo daqueles recomendados pela OAB. O AdvogaApp recomenda que o advogado, antes de estabelecer o valor de seus honorários, verifique a tabela de honorários atualizada disponibilizada no site de sua respectiva Seccional.<br />
   </p>
   
   
   <p>
    <strong>C- Consultoria Jurídica</strong><br />
    <strong>23. Prestação de Consultoria Jurídica AdvogaApp</strong><br />
    <strong>23.1.</strong> O AdvogaApp disponibiliza a população em geral a possibilidade de contratar junto a plataforma os serviços de consultoria jurídica.<br />
    <strong>23.2.</strong> Os serviços de consultoria tratam de matéria procedimental, ou seja, analisa-se se os fatos constituem fatos de direito processual e, em já havendo demanda judicial, a consultoria analisa a situação do processo instruindo a parte quanto ao próximo passo a ser dado, sempre aconselhando a procura de profissional do direito devidamente credenciado junto a OAB para o patrocínio da demanda.<br />
    <strong>23.2.1.</strong> No caso de a parte não possuir advogado, dentro do contexto da primeira consulta feita junto ao AdvogaApp, o app disponibiliza a lista de advogados cadastrados na plataforma conforme região e especialidade solicitados pela parte.<br />
    <strong>23.3.</strong> A parte fica ciente de que a contratação da consultoria jurídica AdvogaApp é de cunho puramente procedimental e não substitui a contratação de advogado que patrocine a causa.<br />
    <strong>23.4.</strong> O pagamento pelo serviço de consultoria jurídica é feito na plataforma AdvogaApp, através dos meios disponibilizados pelo sistema.<br />
    <strong>23.5.</strong> A consultoria é dada por profissional do direito devidamente registrado na Ordem de Advogados do Brasil.<br />
    <strong>23.6.</strong> O AdvogaApp não se responsabiliza por perda de direitos, perda de causa ou qualquer prejudicialidade jurídica que a parte venha a sofrer.<br />
   </p>
         
        
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
            <h2 class="text-center">Política de Privacidade</h2>
            
            <p>O website e o aplicativo AdvogaApp são pertencentes e operados pela S.D.Q PARTICIPAÇÕES SOCIETÁRIAS LTDA (“ADVOGAApp”), sociedade empresária limitada nos termos da Lei 10.406/02, registrada sob o CNPJ 27.353.238/0001-57, com sede à Rodovia Br 290, S/N, Km 121, Eldorado do Sul - RS, CEP 92990-000.
            O Usuário pode entrar em contato conosco pelo e-mail: contato@advogaapp.com.br.
            Esta Política de Privacidade estabelece o compromisso do AdvogaApp com a sua privacidade.</p>
            
            <p>Dentre outras regras aplicáveis ao caso, regem este contrato  as Leis nº 8.078/1990 (“Código de Defesa do Consumidor”) e n° 12.965/2014 ("Marco Civil da Internet").</p>
            
            <p>Esta Política de Privacidade pode ser alterada a qualquer momento, caso você não concorde com alguma mudança, recomendamos que interrompa a utilização da plataforma AdvogaApp. </p>
             
            <p>Qualquer pessoa que utilizar nossos serviços, o que inclui a simples visita à plataforma AdvogaApp, assume expressamente a concordância com a nossa Política de Privacidade.</p> 
            
            <p><strong>1. Informações coletadas pela plataforma AdvogaApp</strong></p> 
            
            <p>
             <strong>(a) Informações Pessoais:</strong> Ao se cadastrar, poderemos coletar seu nome, e-mail, endereço, telefone de contato, CPF, RG, data de nascimento, sexo, profissão e outras informações que podem ser necessárias para mantermos o seu perfil sempre completo e atualizado.<br />
             <strong>I. Meios de pagamento:</strong> Ao adquirir um dos nossos planos para anúncio de seu perfil ou quando da finalização da contratação de um serviço jurídico, poderá ser efetuado o pagamento através dos meios de pagamento disponíveis em nossa plataforma. Neste caso, os dados bancários ou de cartão de crédito serão coletados diretamente pelas administradoras de cartão de crédito, instituições financeiras e outros meios de pagamento, sem qualquer envolvimento do AdvogaApp. Não utilize um meio de pagamento caso não concorde com a forma como este serviço trata as suas informações.
            </p>
            
            <p><strong>II. Conteúdo postado:</strong></p>
            
            
            <p>
              <strong>(a) Informações Não-Pessoais:</strong> Poderemos coletar informações e dados sobre a sua experiência de navegação. Ao longo de sua visita poderão ser automaticamente coletados o seu Internet Protocol (IP), seu tipo de computador, tipo de celular, tipo de navegador, páginas e serviços acessados, entre outros. Além disso, para detectarmos sua localização, poderemos ter acesso aos sinais de Global Positioning System (GPS) e outras informações enviadas por seu dispositivo móvel.
Poderemos cruzar Informações pessoais com Informações não-pessoais. Neste caso, as Informações não-pessoais que forem relacionadas as suas Informações pessoais serão tratadas como informações pessoais, para os propósitos desta Política de Privacidade.
Sempre que as nossas tecnologias permitirem identificar determinado usuário através da análise isolada e independente de uma informação ou dado, tal informação ou dado será considerada, para os fins desta Política de Privacidade, uma informação pessoal. 
            </p>
            <p>
            <strong>III. Como Coletamos informações:</strong> A coleta e armazenamento de informações se dá através<br />
            <strong>(a)</strong> Do seu cadastro na plataforma AdvogaApp.
            <strong>(b)</strong> Do seu uso das funcionalidades da plataforma AdvogaApp.
            <strong>(c)</strong> De Cookies. Cookies são identificações da interação com nossa Plataforma ou nossas publicidades que são transferidas para o aparelho do cliente visando reconhecê-lo na próxima navegação. Utilizamos cookies para proporcionar uma melhor experiência em nossa Plataforma e viabilizar recursos personalizados como recomendações de artigos e publicidades e informações adicionais do seu interesse.
            </p>
            <p>
                <strong>IV. Como Interromper a coleta de informações:</strong> para não ter suas informações pessoais coletadas (mencionadas no item 1 "a”, acima), recomendamos fortemente que você não as forneça. Neste caso, alertamos que certas funcionalidades da plataforma AdvogaApp não poderão ser utilizadas. Por questões de viabilidade técnica, o AdvogaApp não se compromete a apagar suas informações pessoais após você tê-las fornecido.
                Caso deseje interromper a coleta de informações não-pessoais (mencionadas no item II "b”, acima), você deverá desabilitar o salvamento de cookies em seu navegador de internet, além de apagar e gerenciar a utilização desses cookies por meio da configuração do navegador que utiliza para acessar a plataforma AdvogaApp.<br />
                Os principais navegadores de Internet possibilitam aos seus clientes gerenciar a utilização dos cookies em seu computador. A nossa recomendação é que você mantenha o salvamento de cookies ligados. Desta forma, é possível explorar todos os recursos de navegação personalizada oferecidos na AdvogaApp.
            </p>
            <p>
           <strong>V. Armazenamento e proteção das informações coletadas:</strong> Após coletarmos os dados e informações mencionados nessa Política de Privacidade, iremos armazená-los sob rígidas práticas de segurança de informação. Nosso banco de dados terá seu acesso criteriosamente restringido apenas a alguns funcionários habilitados, que são obrigados a preservar a confidencialidade de suas informações.<br />
            Ainda assim, você deve saber que nós não somos responsáveis por eventual quebra de segurança de nossa base de dados que cause a divulgação ou acesso indevido de suas informações de usuário. Em tal caso, nenhuma compensação por parte do AdvogaApp será devida a você. 
          </p>
            <p>
               <strong>VI. Uso das informações:</strong> todas as Informações coletadas pelo AdvogaApp em sua plataforma servem para permitir que prestemos serviços cada vez melhores. O uso das Informações dos Usuários pelo AdvogaApp não implicará na divulgação de conteúdo na plataforma, salvo prévia autorização do usuário. Nós poderemos utilizar essas Informações (Pessoais ou Não Pessoais) principalmente para:<br />
               <strong>(a)</strong> Concluir suas solicitações e permitir o uso de certas funcionalidades da plataforma AdvogaApp;<br />
               <strong>(b)</strong> Traçar perfis e tendências demográficas;<br />
               <strong>(c)</strong> Entrar em contato com você para confirmar ou verificar as informações que você nos forneceu;<br />
               <strong>(d)</strong> Garantir que a plataforma AdvogaApp se mantenha sempre interessante e útil, o que poderá incluir a personalização de anúncios e sugestões de conteúdos, produtos ou serviços;<br />
               <strong>(e)</strong> Proteger a segurança e a integridade da nossa base de dados;<br />
               <strong>(f)</strong> Conduzir diligências internas relativas aos negócios do AdvogaApp; e,<br />
               <strong>(g)</strong> Desenvolver, melhorar e oferecer serviços e produtos de terceiros.<br />
            </p>
            <p>
               <strong>VII. Compartilhamento de informações:</strong> a viabilidade de certos serviços prestados pelo AdvogaApp só ocorre pelo compartilhamento de algumas dessas Informações, o que fazemos com responsabilidade e seguindo rigorosos parâmetros.  
            </p>
            <p>
                <strong>Casos nos quais o compartilhamento de informações se faz necessário:</strong><br />
                <strong>(a)</strong> Conclusão de solicitações de contratação: para que os usuários possam anunciar ou contratar serviços jurídicos através da plataforma AdvogaApp, teremos que enviar algumas das informações inseridas pelo usuário, à base de outros usuários da plataforma AdvogaApp (g. nome, e-mail, localização, etc.), dependendo da condição do usuário como contratado ou contratante dos serviços.<br />
                <strong>(b)</strong> Interação com outras pessoas: para que você possa interagir com outros usuários ou pessoas que visitem a plataforma AdvogaApp;<br />
                <strong>(c)</strong> Novos negócios: no contínuo desenvolvimento do nosso negócio, processos de aquisição e fusão de empresas, estabelecimento de parcerias comerciais, joint ventures e outros negócios podem ocorrer. Nesses negócios, informações dos respectivos clientes também poderão ser transferidas, mas ainda assim, será mantida a Política de Privacidade;<br />
                <strong>(d)</strong> Ordem judicial: o AdvogaApp pode compartilhar dados pessoais em caso de requisição judicial;<br />
                <strong>(e)</strong> Mídias, Redes Sociais e Parcerias Comerciais: O AdvogaApp poderá compartilhar informações não-pessoais para gerar e divulgar estatísticas em redes sociais, na mídia ou junto a parceiros comerciais. Isso poderá incluir informações, dados e tendências demográficas oriundos de informações pessoais e não-pessoais de usuários cadastrados na plataforma AdvogaApp. Em nenhum caso, na hipótese deste item, ocorrerá divulgação não-agregada de informações pessoais; e,<br />
                <strong>(f)</strong> Com a autorização do usuário: em demais casos, havendo a necessidade de compartilhamento das informações, enviaremos a você uma notificação solicitando sua aprovação.<br />
            </p>
                          
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
               
                $.get("<?php echo e(url('ajax/cities')); ?>", 
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
  </script>
  
  
  </body>
</html>

