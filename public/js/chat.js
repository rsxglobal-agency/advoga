
 
 $(document).ready(function($){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    //----------------  Open chat Content -----------------//
    function setModalMaxHeight(element) {
        
      this.$element     = $(element);  
      this.$content     = this.$element.find('.modal-content');
      var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
      var dialogMargin  = $(window).width() < 768 ? 20 : 60;
      var contentHeight = $(window).height() - (dialogMargin + borderWidth);
      var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
      var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
      var maxHeight     = contentHeight - (headerHeight + footerHeight);
    
      this.$content.css({
          'overflow': 'hidden'
      });
      
      this.$element
        .find('.modal-body').css({
          'max-height': maxHeight,
          'overflow-y': 'auto'
      });
    }
    
    $('.modal-chat').on('show.bs.modal', function() {
        $(this).show();
        setModalMaxHeight(this);
    });
    
    $(window).resize(function(){
        if ($('.modal-chat.in').length != 0) {
          setModalMaxHeight($('.modal-chat.in'));
        }
     });
    
    //Btn Abrir chat 
    //Envia atributos do botão para o modal
    $('.btn-open-chat').click(function(e){
        e.preventDefault();
        $('#chatModal')
        .data('demand',$(this).data('demand'))
        .data('page',$(this).data('page'))
        .data('to',$(this).data('to'))
        .data('conv_id',$(this).data('conv_id'))
        .modal('show');
    });
    
    var config = {
        apiKey: "AIzaSyDp1p3KRxC_B6SBo6u4K-JLoWYuExn8fE8",
        authDomain: "advogaapp.firebaseapp.com",
        databaseURL: "https://advogaapp.firebaseio.com",
        projectId: "advogaapp",
        storageBucket: "advogaapp.appspot.com",
        messagingSenderId: "373074552675"
    }
    firebase.initializeApp(config);

    const FdataBase = firebase.database();
    //----------------------------- Chat  --------------------------------------//
    var CHAT_RUN = false;
    var CHAT_setInterval;
    var CONV_ST   = {}; // guardará os dados iniciais da conversa
    var CONV_DATA = {}; // guardara as informações da conversa
    
    function setupChat($element){
        
        
      var USER      = $element.data('user'); // usuário atual
      var DEMAND    = $element.data('demand');
      var PAGE      = $element.data('page'); // página atual

      
      var TO_USER   = $element.data('to');
      var post_conv = $element.data('post-conv');
      var post_url  = $element.data('post-url');
      var get_url   = $element.data('get-url');
      var base_url  = $element.data('base-url');
      
      var $inputText    = $('#chatInputText',$element); //Textarea
      var $btnContratar  = $('.btn-contratar',$element);
      var $btnCancelar   = $('.btn-cancelar',$element);
      var $header_user   = $('.header-user',$element);
      var $listMessages  = $('#listMessages',$element);
      var last_loaded_id = 0;
      
      $listMessages.empty();
      $btnContratar.css('display','none').unbind('click');
      $btnCancelar.css('display','none').unbind('click');
      
      
      //------- Verifica quais serão os atributos para o inicio da conversa ---//
      if (PAGE=='candidaturas'){
           CONV_ST.conversation_id = JSON.parse(DEMAND.id);//DEMAND.id;
           CONV_ST.from_user = JSON.parse(USER.id);
           CONV_ST.to_user   = JSON.parse(DEMAND.user_id);
      }
      
      if(PAGE=='candidatos'){
           CONV_ST.conversation_id = JSON.parse(DEMAND.id);//DEMAND.id;
           CONV_ST.from_user = JSON.parse(USER.id);
           CONV_ST.to_user   = TO_USER.id;
      }
      
     if(PAGE=='demandas-exe'){
           CONV_ST.conversation_id = JSON.parse(DEMAND.id);
           CONV_ST.from_user = JSON.parse(USER.id);
           console.log(CONV_ST.from_user);
           console.log(CONV_ST.conversation_id);
           CONV_ST.to_user   = TO_USER.id;
           console.log(CONV_ST.to_user);
      }
      
     if(PAGE=='diligencias-exe'){
        CONV_ST.conversation_id = JSON.parse(DEMAND.id);
        
        console.log(CONV_ST.conversation_id);
        CONV_ST.from_user = JSON.parse(USER.id);
        console.log(CONV_ST.from_user);
        CONV_ST.to_user   = TO_USER.id;
        console.log(CONV_ST.to_user);
      }
      
      
      if(PAGE=='res-busca-prof'){
           CONV_ST.demand_id = '';
           CONV_ST.from_user = USER.id;
           CONV_ST.to_user   = TO_USER.id;
           CONV_ST.page      = 'busca';
      }
      
      if(PAGE=='chat-page'){
           CONV_ST.demand_id = '';
           CONV_ST.from_user = JSON.parse(USER.id);
           CONV_ST.to_user   = JSON.parse(TO_USER.id);
           CONV_ST.conversation_id = DEMAND;
           CONV_ST.page = 'chat';
      }
      
      function get_conv_data(key){
        return CONV_DATA[''+key+''];
      }
      
      
      //------- busca conversa / caso não exista será criada -----------------//
      function getConversation(callback){        
        FdataBase.ref('chat/users/'+CONV_ST.from_user+"/"+CONV_ST.conversation_id)
        .on('value',res => {
            console.log(CONV_ST.conversation_id)
            let key = Object.keys(res.val());
            let msgKey = res.val()[key[0]].messages_key;

            FdataBase.ref("chat/messages/"+msgKey)
            .on('value',resp => {
                let msgArr = Object.values(resp.val());
                callback(msgArr)
            }) 
        })
      }
      
      //Após recuperar dados da conversa
      getConversation(function(data){
        
         CONV_DATA = data;
         
         //Funções específicas para chat na demanda
         if(CONV_DATA.demand_id!=null){
             fnAutor();
             fnDemanda();
         //Funçõe específicas que não for sobre uma demanda   
         }else{
            
         }
         
         init();
         
      });
      
        //----------------- funcções específicas do autor da demanda -------------//
        function fnAutor(){
        
            //Se o usuário é autor da demanda e se ademanda ainda não tem um executor
            if((DEMAND.user_id==USER.id) && (DEMAND.executor_id=="")){
            $btnContratar.css('display','inline-block');
            }
        
            //Se o usuário é autor da demanda e se ademanda já tem um executor
            if((DEMAND.user_id==USER.id) && (DEMAND.executor_id!="")){
                $btnCancelar.css('display','inline-block');
            }
        
        }
        
        //----------------- funcções específicas quando o chat é na demanda ------//
        function fnDemanda(){
         //----set chat modal info --------
         $element.find('.modal-title').html(DEMAND.name);
        
        }
      
      function init(){
      
               //------------------Scroll messages to bottom --//
               function scrollMessagesToBottom(){
                   $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);
               }
        
               //---------------- send message ----------------//
               function sendMessageAjax(text){
                FdataBase.ref('chat/users/'+CONV_ST.from_user+"/"+CONV_ST.conversation_id)
                .on('value',res => {
                    let key = Object.keys(res.val());
                    let msgKey = res.val()[key[0]].messages_key;
                    let msgs = {
                        text: text,
                        timestamp: (new Date()).getTime(),
                        user_id: USER.id
                    }

                    FdataBase.ref('chat/messages/').child(msgKey).push(msgs);
                })
               }
               
               //---------------- verifica se a mensagem já existe ------//
               function checExistsMessage(id){
                
                   var exist = 0;
                   $('li',$listMessages).each(function(){
                       if ($(this).data('id')==id){
                          
                         exist++; 
                       }   
                   });
                   if (exist>0){ 
                      return true;
                   };
                   return false;
               }
               
               //---------------- append message special ----------------//
               function appendMessageSpecial(data){
                
                var text = '';
                
                if (data.special==1){
                     if (USER.id==DEMAND.user_id){
                         text = CONV_DATA.to.name+' foi contratado para a demanda!';
                     }else{
                        text  = 'Você foi contratado para esta demanda!'; 
                     }
                }
                
                if (data.special==2){
                     if (USER.id==DEMAND.user_id){
                         text = 'O contrato com '+ CONV_DATA.to.name+' foi cancelado!';
                     }else{
                        text  = 'A sua contradação foi cancelada!'; 
                     }
                }
                  
                  var html = '<li class="special special-'+data.special+'" data-id="'+data.id+'">'+
                      '<div class="msinfo">'+
                          '<p>Alerta do sistema | <small>'+data.created_at+'</small></p>'+
                       '</div>'+
                      '<div class="mscontent">'+
                          '<h4 class="text-center">'+text+'</h4>'+
                       '</div>'+
                     '</li>';
                  
                   $listMessages.html(html);
                   scrollMessagesToBottom();
        
               }
               
               //---------------- append message ------------------------//
               function appendMessage(dataT){
                    $listMessages.empty();
                    dataT.map((data,id)=>{
                        const dateMin = new Date(data.timestamp).getMinutes();
                        const dateHour = new Date(data.timestamp).getHours();
                        if(checExistsMessage(data.id)){
                            return true;
                        }
                        
                        if(data.special > 0){
                           appendMessageSpecial(data);
                          return true;
                        }
                        
                        var _class_position = 'right';
                        FdataBase.ref('users/'+data.user_id+"/dados").on('value',res => {
                            data.name = res.val().nome;
                            if (USER.id==data.user_id){
                            _class_position = 'left';
                        }
                          
                        var html = '<li class="'+_class_position+'" data-id="'+data.id+'">'+
                                        '<div class="msinfo">'+
                                            '<p>'+data.name+' | <small>'+dateHour+":"+dateMin+" "+new Date(data.timestamp).toLocaleDateString()+'</small></p>'+
                                         '</div>'+
                                         '<div class="avatar" style="background-image: url(\''+res.val().img+'\');">'+
                                            //'<img src="'+base_url+'/uploads/avatars/'+data.user.image+'"/>'+
                                         '</div>'+
                                        '<div class="mscontent">'+
                                            '<p>'+data.text+'</p>'+
                                         '</div>'+
                                     '</li>';
                        
                         $listMessages.append(html);
                         scrollMessagesToBottom();
                        })
                        
                    })
                   return true;
               }
        
               //---------------- load messages ----------------//
               function loadMessages(){
                    FdataBase.ref('chat/users/'+CONV_ST.from_user+"/"+CONV_ST.conversation_id)
                    .on('value',res => {
                        let key = Object.keys(res.val());
                        let msgKey = res.val()[key[0]].messages_key;
                        
                        FdataBase.ref("chat/messages/"+msgKey)
                        .on('value',resp => {
                            let msgArr = Object.values(resp.val());
                            
                            appendMessage(msgArr)
                        }) 
                    })
                }
        
               //---------------- check text ------------------//
               function checkText(text){
                  if (!text.trim()){
                      return false
                  }
                  if(text.length>300){
                     return false;
                  }
                  return true;
               }
               
               //---------------- input text events --------------//
               $inputText.keypress(function (e){
                var code = (e.keyCode ? e.keyCode : e.which);
                if (code == 13){
                    
                    var value = $.trim($(this).val());
                    if(checkText(value)){
                      
                      sendMessageAjax(value);
                       
                      $(this).val("");
                    }
                    return false;
                }
              });
              
               //---------------- send message special ------------//
               //Type 1 contratar candidato 
               //Type 2 cancelar contratação
               function sendMessageSpecial(type,text,callback){
                     
                     
                    $.ajax({
                            url: post_url,
                            data : {
                                text:text,
                                user_id:USER.id,
                                conversation_id:CONV_DATA.id,
                                special:type,
                                to_user:TO_USER.id,
                                demand_id:DEMAND.id
                            },
                            type:'POST',
                            dataType:'json'
                         }).done(function(resp){
                            if (resp.success==true){
                                  appendMessage(resp.data);
                            }else{
                                 alert('Erro ao executar comando!');  
                            }
                            callback(null);
                         });
        
               }
              
              //----------------- aceitar demanda --------------------//
              $btnContratar.unbind('click');
              $btnContratar.bind( "click", function(){
                 $btnContratar.text('Processando...');
                 sendMessageSpecial(1,'O candidato foi contratado', function(callback){
                    $btnContratar.text('Contratação concluída!');
                    setTimeout(function(){
                      $btnContratar.css('display','none').html('Contratar');
                      $btnCancelar.html('Cancelar contrato').css('display','inline-block');
                    },5000);
                 });
              });
        
             //----------------- aceitar demanda --------------------//
              $btnCancelar.unbind('click');
              $btnCancelar.bind( "click",function(){
                 $btnCancelar.text('Processando...');
                 sendMessageSpecial(2,'O contrato foi cancelado', function(callback){
                    $btnCancelar.text('Contrato cancelado!');
                    setTimeout(function(){
                      $btnCancelar.css('display','none');
                      $btnContratar.css('display','inline-block').html('Contratar');
                    },5000);
                 });
              });
              
        loadMessages();
     } // init 
    }// end chat setup
    
    
    $('.modal-chat').on('show.bs.modal',function(){
       CONV_ST   = {};
       CONV_DATA = {}; 
       setupChat($(this));
       CHAT_RUN = true;
    });
    
    $('.modal-chat').on('hide.bs.modal',function(){
       CHAT_RUN = false;
       CONV_ST   = {};
       CONV_DATA = {}; 
       clearInterval(CHAT_setInterval);
    });
    
 });