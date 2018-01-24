<?php $__env->startSection('content'); ?>


    <section class="panel">
        <header class="panel-heading">
          Edição de Cadastro
        </header>

<!-- INÍCIO do Formulário -->

 <div class="panel-body">
 
    <?php if($up=='ok'): ?>
       <div class="col-xs-12">
            <div class="alert alert-success">
              <p>Dados atualizados com sucesso!</p>
           </div>
      </div>
    <?php endif; ?>
 
 
                              <div class="form">
                                  <form class="form-validate form-horizontal" method="POST" action="<?php echo e(URL::to('/atualizar-cadastro')); ?>"  enctype="multipart/form-data">
                                      
                                       <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                      
                                      <input type="hidden" name="id" value="<?php echo e($user->id); ?>"/>
                                      <input type="hidden" name="old_photo" value="<?php echo e($user->image); ?>"/>
                                      
                                      
                                      <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">Nome Completo </label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="name" name="name" type="text" value="<?php echo e($user->name); ?>" required/>
                                          </div>
                                      </div>

                                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                            <label for="password" class="col-lg-2 control-label">Atualizar Senha</label>
                                            <div class="col-lg-10">
                                                <input id="password" type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-lg-2 control-label">Confirmação de Senha </label>
                                            <div class="col-lg-10">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                            </div>
                                        </div>
                                        
                                      
                                     <?php /*
                                       <div class="form-group">
                                          <label for="add_foto" class="control-label col-lg-2">Selecione uma foto de perfil <span class="required">*</span></label>
                                           <div class="col-lg-5">
                                              <input type="file" id="photo" name="photo"/>
                                          </div> 
                                          <div class="col-lg-5">
                                                @if($user->image!='')   
                                                     <img alt="" src="{{ $user->image }}" style="width:80px;height: auto;"/>
                                                @endif
                                          </div>
                                      </div>
                                      */ ?>
                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="">Imagem do perfil</label>
                                      <div class="col-lg-5">
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
                                        <div class="col-lg-5">
                                                <?php if($user->image!=''): ?>   
                                                     <img alt="" src="<?php echo e(URL::to('/uploads/avatars')); ?>/<?php echo e($user->image); ?>" style="width:80px;height: auto;"/>
                                                <?php endif; ?>
                                       </div>    
                                    </div>
                                      
<!-- INÍCIO Seleção de estado -->

                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Estado:</label>
                                      
                                      <div class="col-lg-3">
                                          <?php echo Form::select('state_id', App\State::pluck('name', 'id'), $user->state_id, ['class'=>'form-control selectpicker','id'=>"state_id",'data-cidade'=>"$user->city_id", 'placeholder'=>'Selecione um Estado', 'required' ]);; ?>

                                      </div> 
                                    
                                    </div>
    
                                          

                                    <div class="form-group">
                                        <label class="control-label col-lg-2" for="inputSuccess">Cidade:</label>
                                         <div class="col-lg-3">
                                          <?php echo Form::select('city_id', App\City::pluck('name', 'id'), $user->city_id, ['class'=>'form-control selectpicker','id'=>"city_id",'data-cidade'=>"$user->city_id", 'placeholder'=>'Selecione um Estado', 'required' ]);; ?>

                                       </div>
                                    </div>

<!-- FIM Seleção de estado -->

                                    <!-- INÍCIO da Titulação -->

                                      <?php if(!(Auth::user()->titulation_id===5)): ?>

                                      <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Titulação:</label>
                                      <div class="col-lg-3">
                                      <?php echo Form::select('titulation_id', App\Titulation::pluck('name', 'id'), $user->titulation_id, ['class'=>'form-control selectpicker', 'placeholder'=>'Selecione uma Titulação' ]);; ?>

                                          </div></div>

                                       <?php endif; ?>

                                      

                                        <!-- FIM da Titulação -->

<!-- INÍCIO da Formação -->
  

                                    <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Formação:</label>
                                      <div class="col-lg-3">
                                      <?php echo Form::select('formation_id', App\Formation::pluck('name', 'id'),$user->formation_id, ['class'=>'form-control selectpicker', 'placeholder'=>'Selecione uma Formação' ]);; ?>

                                          
                                          </div>
                                    </div>
  <?php /*
                               <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Formação:</label>
                                      <div class="col-lg-3">
                                          <select id="titulação" name="formacao" class="form-control selectpicker">
                                              <option>Selecione uma formação</option>
                                              <option value="Estudante">Superior Incompleto</option>
                                              <option value="Graduado(a)">Superior Completo</option>
                                              <option value="Pós-Graduado(a)">Pós-Graduado</option>
                                              <option value="Mestre">Mestre</option>
                                              <option value="Doutor(a)">Doutor</option>
                                              <option value="Pós-Doutorado">Pós-Doutorado</option>
                                          </select></div>
                                </div>
  */ ?>

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
                                                 <input type="checkbox" name="atuation_id[]" <?php echo e($val['checked']); ?> value="<?php echo e($val['id']); ?>"> <?php echo e($val['name']); ?><br>                      
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
                                                 <input type="checkbox" name="service_id[]" <?php echo e($val['checked']); ?> value="<?php echo e($val['id']); ?>"> <?php echo e($val['name']); ?><br>                      
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tr>                                 
                                  </table>
                                <br/><br/>
                            </div>
                            <!-- FIM Serviços Prestados -->

   
<?php /*
<!-- INÍCIO da Áreas de Atuação -->
<div class="form-group">
<label class="control-label col-lg-2" for="inputSuccess">Selecione uma Área de Atuação</label>
<p><h4></h4></p>


<table align="left" width=850 height=100><tr><td>


<input type="checkbox" name="areasdeatuacao[]" value="Penal"> Penal<br>
<input type="checkbox" name="areasdeatuacao[]" value="Processo Penal"> Processual Penal<br>
<input type="checkbox" name="areasdeatuacao[]" value="Civil"> Civil<br>
<input type="checkbox" name="areasdeatuacao[]" value="Processual Civil"> Processual Civil<br>
<input type="checkbox" name="areasdeatuacao[]" value="Trabalho"> Trabalho<br>
<input type="checkbox" name="areasdeatuacao[]" value="Processual do Trabalho"> Processual do Trabalho<br>
<input type="checkbox" name="areasdeatuacao[]" value="Previdenciário"> Previdenciário<br>
<input type="checkbox" name="areasdeatuacao[]" value="Tributário"> Tributário<br>
<input type="checkbox" name="areasdeatuacao[]" value="Família"> Família<br>
<input type="checkbox" name="areasdeatuacao[]" value="Consumidor"> Consumidor<br>
<input type="checkbox" name="areasdeatuacao[]" value="Bancário"> Bancário<br>
<input type="checkbox" name="areasdeatuacao[]" value="Administrativo"> Administrativo<br>
<input type="checkbox" name="areasdeatuacao[]" value="Ambiental"> Ambiental<br>
<input type="checkbox" name="areasdeatuacao[]" value="Acidentário"> Acidentário<br>
<input type="checkbox" name="areasdeatuacao[]" value="Aeronáutico"> Aeronáutico<br>

</td> <td>

<input type="checkbox" name="areasdeatuacao[]" value="Canônico"> Canônico<br>
<input type="checkbox" name="areasdeatuacao[]" value="Corporativo"> Corporativo<br>
<input type="checkbox" name="areasdeatuacao[]" value="Direito da Mulher"> Direito da Mulher<br>
<input type="checkbox" name="areasdeatuacao[]" value="Sucessões"> Sucessões<br>
<input type="checkbox" name="areasdeatuacao[]" value="Negócios"> Negócios<br>
<input type="checkbox" name="areasdeatuacao[]" value="Trânsito"> Trânsito<br>
<input type="checkbox" name="areasdeatuacao[]" value="Educacional"> Educacional<br>
<input type="checkbox" name="areasdeatuacao[]" value="Marítimo"> Marítimo<br>
<input type="checkbox" name="areasdeatuacao[]" value="Agrário"> Agrário<br>
<input type="checkbox" name="areasdeatuacao[]" value="Médico"> Médico<br>
<input type="checkbox" name="areasdeatuacao[]" value="Militar"> Militar<br>
<input type="checkbox" name="areasdeatuacao[]" value="Empresarial"> Empresarial | Comercial<br>
<input type="checkbox" name="areasdeatuacao[]" value="Tecnologia da Informação"> Tecnologia da Informação<br>
<input type="checkbox" name="areasdeatuacao[]" value="Contratual"> Contratual<br>
<input type="checkbox" name="areasdeatuacao[]" value="Propriedade Intelectual"> Propriedade Intelectual e Industrial<br>

</td> <td>

<input type="checkbox" name="areasdeatuacao[]" value="Mediação"> Mediação, Conciliação e Arbitragem<br>
<input type="checkbox" name="areasdeatuacao[]" value="Desportivo"> Desportivo<br>
<input type="checkbox" name="areasdeatuacao[]" value="Internacional"> Internacional<br>
<input type="checkbox" name="areasdeatuacao[]" value="Financeiro"> Financeiro<br>
<input type="checkbox" name="areasdeatuacao[]" value="Constitucional"> Constitucional<br>
<input type="checkbox" name="areasdeatuacao[]" value="Imobiliário"> Imobiliário<br>
<input type="checkbox" name="areasdeatuacao[]" value="Sanitário"> Sanitário<br>
<input type="checkbox" name="areasdeatuacao[]" value="Securitário"> Securitário<br>
<input type="checkbox" name="areasdeatuacao[]" value="Sindical"> Sindical<br>
<input type="checkbox" name="areasdeatuacao[]" value="Societário"> Societário<br>
<input type="checkbox" name="areasdeatuacao[]" value="Urbanístico"> Urbanístico<br>
<input type="checkbox" name="areasdeatuacao[]" value="Direitos Humanos"> Direitos Humanos<br>
<input type="checkbox" name="areasdeatuacao[]" value="Todos"> Todos<br>

</td>
</tr>
</table>
<br><br>
</div>
<!-- FIM da Áreas de Atuação -->
*/ ?>

<?php /*
<!-- INÍCIO Serviços Prestados -->

<div class="form-group">
<label class="control-label col-lg-2" for="inputSuccess">Selecione serviços para prestar:</label>
<p><h4></h4></p>

<table align="left" width=850 height=100><tr><td>

<input type="checkbox" name="servicos_prestados[]" value="Acompanhamentos"> Acompanhamentos<br>
<input type="checkbox" name="servicos_prestados[]" value="Andamentos"> Andamentos<br>
<input type="checkbox" name="servicos_prestados[]" value="Certidoes"> Certidões<br>
<input type="checkbox" name="servicos_prestados[]" value="Cópias"> Cópias<br>
<input type="checkbox" name="servicos_prestados[]" value="Exame de Processos"> Exame de Processos<br>
<input type="checkbox" name="servicos_prestados[]" value="Pareceres"> Pareceres<br>
<input type="checkbox" name="servicos_prestados[]" value="Protocolos"> Protocolos<br>
<input type="checkbox" name="servicos_prestados[]" value="Alvarás"> Alvarás<br>
<input type="checkbox" name="servicos_prestados[]" value="Audiências"> Audiências<br>
<input type="checkbox" name="servicos_prestados[]" value="Conciliação"> Conciliação<br>
<input type="checkbox" name="servicos_prestados[]" value="Despachos"> Despachos<br>
<input type="checkbox" name="servicos_prestados[]" value="Guias"> Guias<br>

</td> <td>

<input type="checkbox" name="servicos_prestados[]" value="Elaboração de Peças"> Elaboração de Peças<br>
<input type="checkbox" name="servicos_prestados[]" value="Elaboração de Teses"> Elaboração de Teses<br>
<input type="checkbox" name="servicos_prestados[]" value="Recursos"> Recursos<br>
<input type="checkbox" name="servicos_prestados[]" value="Análises"> Análises<br>
<input type="checkbox" name="servicos_prestados[]" value="Cargas"> Cargas<br>
<input type="checkbox" name="servicos_prestados[]" value="Distribuições"> Distribuições<br>
<input type="checkbox" name="servicos_prestados[]" value="Consultas"> Consultas<br>
<input type="checkbox" name="servicos_prestados[]" value="Preposição"> Preposição<br>
<input type="checkbox" name="servicos_prestados[]" value="Busca e Apreensão"> Busca e Apreensão<br>
<input type="checkbox" name="servicos_prestados[]" value="Mandados"> Mandados<br>
<input type="checkbox" name="servicos_prestados[]" value="Sustentação Oral"> Sustentação Oral<br>
<input type="checkbox" name="servicos_prestados[]" value="Visita in loco"> Visita in loco<br>
<input type="checkbox" name="servicos_prestados[]" value="Outros"> Outros<br>

</td>
</tr>
</table>
<br><br>
</div>


<!-- FIM Serviços Prestados -->
*/ ?>


<!-- INÍCIO Currículo -->

<div class="form-group">
  <label class="control-label col-lg-2" for="brevecurriculo">Escreva uma frase de apresentação: (max. 200 caracteres)</label>


  <table align="left" width=850 height=100><tr><td>
    
       <textarea class="form col-lg-10" name="description" maxlength="200" placeholder="Olá, meu nome é fulano e trabalho em uma determinada área."><?php echo e($user->description); ?></textarea>

     </td>
    </tr>
 </table>
</div>

<!-- FIM Currículo -->

<!-- INÍCIO rede social -->


 <div class="form-group">
<label class="control-label col-lg-2" for="inputSuccess">Qual o link da sua principal rede social?</label>
<table align="left" width=850 height=100><tr><td>
     <textarea class="form col-lg-10" name="social" maxlength="200" placeholder="linkedin.com/fulanodetal"><?php echo e($user->social); ?></textarea><br/>

</td>
</tr>
</table>
</div>



</table>
</div>

</div>
</div>
</div>
</div>


<div class="form-group">
<label class="col-md-4 control-label"></label>
<div class="col-md-4">



  <input class="btn-wide" type="submit" value="Atualizar"><br><br>


</div>
</div>

</fieldset>
</form>
</div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>