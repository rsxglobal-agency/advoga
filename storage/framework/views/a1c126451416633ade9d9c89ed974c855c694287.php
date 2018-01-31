<!-- javascripts -->
    <script>
      var routeName = '<?php echo e(Route::currentRouteName()); ?>';
    </script>

    <!--<script src="js/jquery.js"></script> -->
    <!--<script src="js/bootstrap.min.js?v=2"></script> -->
   
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery knob -->
    <?php /*
    <script src="assets/jquery-knob/js/jquery.knob.js"></script>
    */ ?>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <script src="js/advogafuncoes.js?v=3"></script>
    <script src="js/chat.js?<?php echo rand(0,1080); ?>"></script>

<script>
    
 $(document).ready(function($){
    
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        
    //-----------------------------------------Profile ---------------------------------------//  
          //if (routeName=='profile'){
            
        $('#state_id').change(function(){
           
            //cidade relacionada ao usuário
            var id_cidade = $(this).data('cidade');
        
            $.get("<?php echo e(url('ajax/cities')); ?>", 
            { state_id: $(this).val() }, 
            function(data) {
                city = '#city_id';
                selectUpdate(city, data, id_cidade);
            });
        
        });
              
    
    
    /* Página - Demandas lançadas */     
    $(".btn-excluir-demanda").click(function(e){
        
      e.preventDefault();
      
      var id= $(this).attr("data-id");

      $.ajax("<?php echo e(asset('/removerdemanda/')); ?>/"+id).done(function(data){
        $("div[data-id='"+id+"']").remove();
      });

    });
    
    
   
   /* Página candidaturas - cancelar */  
   $(".btn-cancelar-demanda").on("click", function(e){
    
      e.preventDefault();

      var id = $(this).attr("data-id");
      
      $.ajax("<?php echo e(asset('/cancelar/')); ?>/"+id).done(function(data){
        $("div[data-id='"+id+"']").remove();
      });
      
    });
    
   
   /*Diligemncias em execução - desistir */  
    $(".btn-desistir-demanda").on("click", function(){
        
      var id = $(this).attr("data-id");
      
      $.ajax("<?php echo e(asset('/desistirdemanda/')); ?>/"+id).done(function(data){
        $("div[data-id='"+id+"']").remove();
      });
      
    
    });
   
    /* Página demandas em execução / Remover executor */   
    $(".btn-cancelar-executor").on("click", function(){
        
      var id=$(this).attr("data-id");
      
      $.ajax("<?php echo e(asset('/removerexecutor/')); ?>/"+id).done(function(data){
        $("div[data-id='"+id+"']").remove();
      });
      
    });
    
   
  
   $(".btn-concluir-demanda").on("click", function(e){
      
      e.preventDefault();
      
      
      if(confirm('Deseja realmente concluir a demanda?')){
        
          var id = $(this).attr("data-id");
          var user_id = $(this).data("user-id");
          
          $.ajax({
               url : "<?php echo e(asset('/concluir-demanda/')); ?>",
            data   : {
                     demand_id : id,
                     user_id : user_id
            },
            type: 'POST'
          }).done(function(data){
               $("div[data-id='"+id+"']").remove();
               $("#demand_rating").val(id);

               $("#modal-estrelas").modal("show");
          });
      }

      
      return false;
      
     /*
      var id=$(this).attr("data-id");
      $.ajax("<?php echo e(asset('/demandaconcluida/')); ?>/"+id).done(function(data){
        $("div[data-id='"+id+"']").remove();
      });
     */
      
  });
  
  
  $("a[href='#']").on("click", function(e){
    
     e.preventDefault();
   
   }); 
   
    
        
            
});// end document-ready


    </script>
    <?php echo $__env->yieldContent('script'); ?>