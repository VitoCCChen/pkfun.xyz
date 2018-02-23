<!doctype html>
<html>
  <head>
    <title>Socket.IO chat</title>
    <style>
      * { margin: 0; padding: 0; box-sizing: border-box; }
      body { font: 13px Helvetica, Arial; }
      form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
      form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
      form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
      #messages { list-style-type: none; margin: 0; padding: 0; }
      #messages li { padding: 5px 10px; id:"li"}
      #messages li:nth-child(odd) { background: #eee; }
      #messages { margin-bottom: 120px }
    </style>
  </head>
  <body>
    <ul id="messages"></ul>
    <form action="" id="form">
      <input id="r" readonly="true" placeholder="上線名單">
      <!-- <input id="s" autocomplete="off" placeholder="試著私訊別人"/><button id="clear">Clear</button> -->
      <input id="m" autocomplete="off"/><button id="send">Send</button>
    </form>
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.js"></script>
    <script>
      $(function () {
          var name;

          do {
              name = prompt("請問您叫什麼名子", "");
          }while(name == null || name == "");

          var room;
          room = prompt("room?", "");
          room = '1-'+room;
          document.title = "Socket.IO chat room "+ room;

          var socket = io.connect('ws.pkfun.xyz:9501', {query: 'name='+name});
          socket.emit('create', room);

          <!--region client send event to server-->
          //send message
          $('#send').click(function(){
              /*if($('#s').val() != "" && $('#m').val() != "")
              {
                  socket.emit('secret message', name, $('#s').val(), $('#m').val());
                  $('#m').val('');
                  return false;
              }*/

              if($('#m').val() != "")
              {
                  socket.emit('chat message', name, $('#m').val());
              }
              else
                  alert("請輸入點東西");

              $('#m').val('');
              return false;
          });

          //let user could clear the message board
          $('#clear').click(function(){
              $('#messages').text("");
              return false;
          });

          //let user send message with enter
          $('#m').on('keypress',function(e){
              if (e.which == 13){
                  console.log("enter is press by "+name);
                  $('#send').trigger('click');
                  return false;
              }
          });//*/

          //listen on how is typing, and show on clint console
          /*$('#m').on('keyup', function(){
              socket.emit('typing', name);
              $('#messages').append($('<li>').text('someone is typing'));
              return false;
          });//*/
          <!--endregion-->


          <!--region client listen event from server-->
          //listen any connection into same room
          socket.on('connected'+room, function(msg){
              $('#messages').append($('<li>').text(msg));
              window.scrollTo(0, document.body.scrollHeight);
          });

          //[try]ask user to a nickname
          /*socket.on('changename', function(username){
              do {
                  name = prompt(username + " has been used, please change a name :)");
              }while(name == null || name == "");

              socket = io.connect('', {query: 'name='+name});
          });*/

          //listen any message for client
          socket.on('chat message'+room, function(name, msg){
            $('#messages').append($('<li>').text(name+": "+msg));
            window.scrollTo(0, document.body.scrollHeight);
          });

          //[try] to listen who is typing
          socket.on('whoistyping', function(name){
              console.log(name + " is typing...");
          });

          //listen any disconnection in same room
          socket.on('disconnected'+room, function(msg){
              $('#messages').append($('<li>').text(msg));
              window.scrollTo(0, document.body.scrollHeight);
          });

          //get history messages and show it
          socket.on('load history'+room, function(history){

              history.msg.forEach(
                function(value){
                  msg = value.cl_record;
                  //$('#messages').prepend($('<li>').text(msg));
                    $('#messages').append($('<li>').text(value.cl_record));
                  window.scrollTo(0, document.body.scrollHeight);//*/

              });

              //told cerver losding history done
              socket.emit('welcome', name);

              //console.log("history-> ", history);
              //console.log('history done');
          });

          socket.on('update roomInfo'+room, function(info){
              $('#r').val(info);

              console.log(info);
          });
          <!--endregion-->

        });
    </script>
  </body>
</html>
