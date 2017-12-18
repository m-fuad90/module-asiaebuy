    <?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'Chat';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row service-box margin-bottom-40">

    <div class="col-md-12 col-sm-12">

        <h2><?= Html::encode($this->title) ?></h2>



            <div class="panel panel-default">

                <div class="panel-heading">Chat</div>

                <div class="panel-body">


        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">
                <h1 class="text-center">
                    MongoChat 
                    <button id="clear" class="btn btn-danger">Clear</button>
                </h1>
                <div id="status"></div>
                <div id="chat">
                    <input type="text" id="username" class="form-control" placeholder="Enter name...">
                    <br>
                    <div class="card">
                        <div id="messages" class="card-block">

                        </div>
                    </div>
                    <br>
                    <textarea id="textarea" class="form-control" placeholder="Enter message..."></textarea>
                </div>
            </div>
        </div>
                    



                </div>

            </div>

    </div>
</div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

    <script>
        (function(){
            var element = function(id){
                return document.getElementById(id);
            }

            // Get Elements
            var status = element('status');
            var messages = element('messages');
            var textarea = element('textarea');
            var username = element('username');
            var clearBtn = element('clear');

            // Set default status
            var statusDefault = status.textContent;

            var setStatus = function(s){
                // Set status
                status.textContent = s;

                if(s !== statusDefault){
                    var delay = setTimeout(function(){
                        setStatus(statusDefault);
                    }, 4000);
                }
            }

            // Connect to socket.io
            var socket = io.connect('http://127.0.0.1:4000');

            // Check for connection
            if(socket !== undefined){
                console.log('Connected to socket...');

                // Handle Output
                socket.on('output', function(data){
                    //console.log(data);
                    if(data.length){
                        for(var x = 0;x < data.length;x++){
                            // Build out message div
                            var message = document.createElement('div');
                            message.setAttribute('class', 'chat-message');
                            message.textContent = data[x].name+": "+data[x].message;
                            messages.appendChild(message);
                            messages.insertBefore(message, messages.firstChild);
                        }
                    }
                });

                // Get Status From Server
                socket.on('status', function(data){
                    // get message status
                    setStatus((typeof data === 'object')? data.message : data);

                    // If status is clear, clear text
                    if(data.clear){
                        textarea.value = '';
                    }
                });

                // Handle Input
                textarea.addEventListener('keydown', function(event){
                    if(event.which === 13 && event.shiftKey == false){
                        // Emit to server input
                        socket.emit('input', {
                            name:username.value,
                            message:textarea.value
                        });

                        event.preventDefault();
                    }
                })

                // Handle Chat Clear
                clearBtn.addEventListener('click', function(){
                    socket.emit('clear');
                });

                // Clear Message
                socket.on('cleared', function(){
                    messages.textContent = '';
                });
            }

        })();
    </script>