    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/img/advogaicon.ico">
    
    
    <title>Advoga - Aproximando comarcas, unindo profissionais, agilizando o Direitos</title>
    
    <base href="<?php echo e(URL::to('/')); ?>/"/>
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    
<!-- Bootstrap CSS -->

    <link href="./css/bootstrap.min.css" rel="stylesheet">
<!-- bootstrap theme -->

    <link href="./css/bootstrap-theme.css" rel="stylesheet">
<!--external css-->
<!-- font icon -->
    <link href="./css/elegant-icons-style.css" rel="stylesheet" />
    <link href="./css/font-awesome.min.css" rel="stylesheet" />
        <!-- Custom styles -->
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/style-responsive.css" rel="stylesheet" />
    
    <link href="./css/chat.css?v=<?php echo rand(0,1000); ?>" rel="stylesheet"/>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js?v=2"></script>

    <script type="text/javascript">
        setInterval(function() {
            // method to be executed;
            runstatus();
        }, 5000); 

        function runstatus(){

          mensagesstatus();
          executorstatus();
        }

        function mensagesstatus(){




        $.ajax({
            url:"<?php echo e(asset('status')); ?>"

        })
        .done(function(data){
            
            $('#chat_ul').html('');
            str='<div class="notify-arrow notify-arrow-blue"></div><li><p class="white">Você tem '+data.chat_counter+' mensagens não lidas</p> </li>';
            $('#chat_ul').append(str);

            var urlimg = "<?php echo e(asset('/uploads/avatars')); ?>/";
            var urlchat = "<?php echo e(asset('/chat')); ?>";
                                       

            for(i=0;i<data.messages.length;i++){
                var m=data.messages[i];
                var img=m.user.image==""?"/img/avatar/default.jpg":urlimg+m.user.image; 

                var str='<li><a href="'+urlchat+'"> <span class="photo"><img alt="avatar" src="'+img+'"></span>';
                str+='<span class="subject"><span class="from">'+m.user.name+'</span><span class="time">1 min</span></span>'; 
                str+= '<span class="message">'+m.text+'</span></a></li>'; 

                $('#chat_ul').append(str);
            }


                            
            str='<li> <a href="chat">Ver todas as mensagens</a></li>';
            $('#chat_ul').append(str);
                               
                           
                                
                          

            $("#badge_chat").html(data.chat_counter);
        });

        } 

         function executorstatus(){




        $.ajax({
            url:"<?php echo e(asset('executor')); ?>"

        })
        .done(function(data){

            var url="<?php echo e(asset('demanda/cadidatos/')); ?>/";
            
            $('#executor_ul').html('');
            str='<div class="notify-arrow notify-arrow-blue"></div> <li><a href="minhas-demandas">Veja todas suas demandas</a></li>';
            $('#executor_ul').append(str);
                                       

            for(i=0;i<data.demands.length;i++){
                
                var d=data.demands[i];
                var str='<li><p class="black"><a href="'+url+d.id+'">Você tem um novo candidato para a demanda: '+d.name+'</a></p></li>'; 

                $('#executor_ul').append(str);
            }

           

            $("#badge_executor").html(data.demand_counter);
        });

        } 
        runstatus();
        
    </script>

  <style type="text/css">
    
    .modal-dialog{
        
        left: auto !important;
        width: 700px;

      }

      .modal-lg {
        
        width: auto;
      } 

      /* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
  
}

/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
  font-size:2.5em; /* Change the size of the stars */
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
  color:#FFCC36;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
}



  </style>
    
  </head>
