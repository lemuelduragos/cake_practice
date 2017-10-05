<script src="https://socket-io-chat.now.sh/socket.io/socket.io.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>

<div class="container col-md-6" style="margin-bottom: 100px">
  <div class="row">
    <div class="col-12">
    <div style="height:550px; background:#d5e0f2; border-radius: 10px; overflow-y: auto;" id="chatMessages">
    </div>
    <div class="form-group">
      <input class="col-12" id="message" placeholder="Type your message here">
     </div> 
    </div>
  </div>
</div>

<script>
	$(function () {
		var name = window.prompt("Please enter your name","Guest"); 
		var socket = io('http://localhost.com:3000'); 
		socket.emit('userconnected', name);

		// socket.on('userconnected', function(msg){
  //     		$('#chatMessages').append($('<div class="alert alert-info">').text(msg));
  //   	});
  		$('#message').keypress(function(e){
        var rawMessage = $(this).val();
  			var key = e.which;
	       	if(key == 13) {
	       		socket.emit('message', $(this).val(), name);
    				$('#message').val("");
            var id = $('#chatMessages').children().last().attr('id');
            var text = $('#chatMessages').children().last().html();
            if(id == name) {
            text += "<br/>"+rawMessage;
              console.log(text);
              $('#chatMessages').children().last().html(text);
            }
            else {
              $('#chatMessages').append($("<div id="+name+" class='alert alert-warning cloud-me col-8'>").html('Me: '+rawMessage));
          }

	        }

          
  		});

    	socket.on('message', function(msg, name,){
    		var id = $('#chatMessages').children().last().attr('id');
    		var text = $('#chatMessages').children().last().html();
    		console.log(msg);
    		if(id == name) {
    			text += "<br/>"+msg;
    			console.log(text);
    			$('#chatMessages').children().last().html(text);
    		}
    		else {
    			$('#chatMessages').append($("<div id="+name+" class='alert alert-default cloud col-8'>").html(name+": "+msg));
    		}
    	});

	});
</script>