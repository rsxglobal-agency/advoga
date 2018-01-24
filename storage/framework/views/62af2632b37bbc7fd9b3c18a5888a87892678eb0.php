<!-- Modal -->
<div class="modal modal-chat fade" id="chatModal" 
        tabindex ="-1" role="dialog"  
        aria-labelledby ="chatModalLabel" 
        aria-hidden    ="true" 
        data-demand    ="" 
        data-conv_id   ="" 
        data-user      = '{"id":"<?php echo e(Auth::user()->id); ?>","name":"<?php echo e(Auth::user()->name); ?>"}'
        data-post-conv = "<?php echo e(URL::to('/messages/conversa')); ?>"
        data-post-url  = "<?php echo e(URL::to('/messages/insert')); ?>"
        data-get-url   = "<?php echo e(URL::to('/messages/json')); ?>"
        data-base-url  = "<?php echo e(URL::to('/')); ?>"
        
>     
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <table width="100%">
                <tr>
                   <td width="65%"><h4 class="modal-title"></h4></td>
                   <td width="35%">
                     <button class="btn btn-success btn-contratar">Contratar</button>
                     <button class="btn btn-warning btn-cancelar">Cancelar contrato</button>
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 </td>
                </tr>
                <tr style="display: none;">
                  <td>
                     <?php /*<p class="header-user"><strong>Candidato:</strong> Edson Luiz Siqueira</p> */ ?>
                  </td>
                  <td>
                      <ul class="list-inline pull-right">
                         <li><button class="btn btn-default btn-sm" role="button">Atualizar</button></li>
                     </ul>
                  </td>
               </tr>
            </table> 
        </div>
        <div class="modal-body" id="chat-body">
            <ul class="list-messages" id="listMessages">
              <?php /*
               <li class="right" data-id="78">
                   <div class="msinfo">
                      <p>Edson Luiz Siqueira / <small>15/08/2017 15:27</small> </p>
                   </div>
                   <div class="avatar">
                      <img src="http://localhost/advoga/public/uploads/avatars/1501947036.jpeg"/>
                   </div>
                   <div class="mscontent">
                      olá
                   
                   </div>
               </li>
               <li class="left" data-id="78">
                    <div class="msinfo">
                      <p>Edson Luiz Siqueira | <small>15/08/2017 15:27</small> </p>
                   </div>
                   <div class="avatar">
                      <img src="http://localhost/advoga/public/uploads/avatars/1501947036.jpeg"/>
                   </div>
                   <div class="mscontent">
                      olá
                   </div>
               </li>
               
               <li class="right" id="87">
                   <div class="msinfo">
                      <p>Edson Luiz Siqueira | <small>15/08/2017 15:27</small> </p>
                   </div>
                   <div class="avatar">
                      <img src="http://localhost/advoga/public/uploads/avatars/1501947036.jpeg"/>
                   </div>
                   <div class="mscontent">
                      olá
                   
                   </div>
               </li>
               */ ?>
               <?php /*
                <li class="special" data-id="78">
                   <div class="msinfo">
                      <p>Alerta do sistema | <small>15/08/2017 15:27</small> </p>
                   </div>
                   <div class="mscontent">
                      <h4 class="text-center">Claudemir de siqueira aceitou a demanda</h4>  
                   </div>
               </li>
               */ ?>
            </ul>
        </div>
        <div class="modal-footer">
          <textarea id="chatInputText" class="form-control" placeholder="Escrever mensagem"></textarea>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->