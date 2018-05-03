@extends('layouts.master')

@section('content') 


          <!--div class="row"-->
                  <!--div class="col-lg-12"-->
                   <div class='wrap'>
                     <div class='content'>
                      <section class="panel">

                           <div class="panel-body">

                 <!--teste-->
                 <div class="flex-content" id="flex-content">
                   <div class="chat-item" id="chat-item">   
                    @forelse ($Chat as $conv)
                     <div class="flex-item" id="flex-item">
                       <div class="circular--portrait" id="circular--portrait-chat"> 
                          <img alt="" src="{{ URL::to('/img/avatar/default.jpg') }}"  id="chat_user_image" height="150" >
                       </div>                    
                       <div class="flex-textos" id="flex-textos">
                          <p class="nome" id="nome">{{$conv['user_id']}}</p>                         
                          <a href="#" 
                            data-page    = "chat-page" 
                            class="btn-open-chat" id="button-chat">
                              Chat
                            </a>
                            <!--button type="button" class="btn btn-default" id="button-chat">Chat</button-->   
                       </div>
                     </div>
                       @empty
                        <div class="col-md-12">
                         <h3 class="text-center">Nenhuma conversa</h3>
                       </div>
                       @endforelse 

                        </div>
                       </div>
                 <!--fim do teste-->

             </div> 

</section>
 </div>
</div>

<style type="text/css">
 .panel{
    background-color: transparent;
    width:92.5%;
    height: 100%;
      
  }
.panel-body{
  width: 100%;
  background-color: white;
  border-radius: 10px;

}
#flex-content{
     background-color: transparent;
      height: 100%;
      border: 0px solid;
      max-width: 100%;
      margin: 0;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      overflow-x: hidden;
      -ms-flex-wrap: nowrap;
          flex-wrap: nowrap;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
          -ms-flex-direction: column;
              flex-direction: column;
}

#chat-item{
     background-color: transparent;
      height: 100%;
      border: 0px solid;
      max-width: 100%;
      margin: 0;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      overflow-x: hidden;
      -ms-flex-wrap: wrap;
          flex-wrap: wrap;
      -webkit-box-orient: horizontal;
      -webkit-box-direction: normal;
          -ms-flex-direction: row;
              flex-direction: row;

}

#flex-item{
     background-color: transparent;
      height: 100%;
      border: 0px solid;
      width: 49.52%;
      margin: 0;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      overflow-x: hidden;
      -ms-flex-wrap: nowrap;
          flex-wrap: nowrap;
      -webkit-box-orient: horizontal;
      -webkit-box-direction: normal;
          -ms-flex-direction: row;
              flex-direction: row;
      margin: 0.2%;
      -webkit-box-align: center;
          -ms-flex-align: center;
              align-items: center;
      border: 1px solid #E3E6ED;
      border-radius: 5px;

}

#circular--portrait-chat{
  position: relative;
  width: 100px;
  height: 100px;
  overflow: hidden;
  border-radius: 50%;
  border: 1px solid #EEEEEE;
  margin-left: 4%;
}

  #chat_user_image{
  width: 100%;
  height: 100%;

}

#flex-textos{
  background-color: transparent;
  width: 70%;
  margin-left: 4.5%;
  height: 95%;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  text-align: center;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}


#button-chat{
    border-radius: 40px;
    background-color: #176963;
    color: white;
    -webkit-transition:all 1s ease;
    -o-transition:all 1s ease;
    transition:all 1s ease;
    height: 20%;
    width: 80px;
    text-align: center;
    margin-bottom: 10px;
     box-shadow: 0 0 3px rgba(0, 0, 0, .8);
    -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, .8);
    -moz-box-shadow: 0 0 3px rgba(0, 0, 0, .8);
  }


  #button-chat:hover{
    background-color: #274C48;
  }

  #nome{
    color: #176963;
    font-size: 1.8rem;
    font-weight: 500;
  }

  #demanda{
    font-size: 1.3rem;
    font-weight: 300;
  }

  #demanda-nome{
     font-size: 1.5rem;
    font-weight: 400;
  }
  #demand-empty{
    font-size: 1.5rem;
    font-weight: 400;
  }

  *, :before, :after{
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
   margin: 0;
  padding: 0;
}

body {
  background: #ddd;
  width: 100%;
  height: 100vh;

  position: relative;
   margin: 0;
    padding: 0;

}


.wrap {
  position: absolute;
  overflow: hidden;
  padding: 20px 50px;
  width: 82%;
  display: block;
  border-radius: 4px;
  -webkit-transform: translateY(20px);
      -ms-transform: translateY(20px);
          transform: translateY(20px);
  -webkit-transition: all 0.5s;
  -o-transition: all 0.5s;
  transition: all 0.5s;
  visibility: hidden;
    padding: 0;
    background-color: transparent;
}
.wrap .content {
  opacity: 0;
    background-color: transparent;
}
.wrap:before {
  position: absolute;
  width: 1px;
  height: 1px;
  background: white;
  content: "";
  bottom: 10px;
  left: 50%;
  top: 95%;
  color: #fff;
  border-radius: 50%;
  -webkit-transition: all 600ms cubic-bezier(0.215, 0.61, 0.355, 1);
  -o-transition: all 600ms cubic-bezier(0.215, 0.61, 0.355, 1);
  transition: all 600ms cubic-bezier(0.215, 0.61, 0.355, 1);

}
.wrap.active {
  display: block;
  visibility: visible;
  border-radius: 10px;
  -webkit-transition: all 600ms;
  -o-transition: all 600ms;
  transition: all 600ms;
  -webkit-transform: translateY(0px);
      -ms-transform: translateY(0px);
          transform: translateY(0px);
   -webkit-box-shadow: 2px 3px 16px #cccccc;
           box-shadow: 2px 3px 16px #cccccc;
  -webkit-transition: all 0.5s;
  -o-transition: all 0.5s;
  transition: all 0.5s;
}
.wrap.active:before {
  height: 2000px;
  width: 2000px;
  border-radius: 50%;
  top: 50%;
  left: 50%;
  margin-left: -1000px;
  margin-top: -1000px;
  display: block;
  -webkit-transition: all 600ms cubic-bezier(0.215, 0.61, 0.355, 1);
  -o-transition: all 600ms cubic-bezier(0.215, 0.61, 0.355, 1);
  transition: all 600ms cubic-bezier(0.215, 0.61, 0.355, 1);
  background-color:#DDDDDD;
}
.wrap.active .content {
  position: relative;
  z-index: 1;
  opacity: 1;
  -webkit-transition: all 600ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
  -o-transition: all 600ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
  transition: all 600ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
    background-color: transparent;
}
  }
</style>

<script type="text/javascript">
  $(document).ready(function(){
  $('.wrap').toggleClass('active');
  
  return false;
});
</script>

@endsection