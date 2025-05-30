<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Chat AnderCode</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    @vite('resources/js/app.js')
</head>
<body>
    <div class="container">
        <h1>Lista de Usuarios</h1>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"> Cerrar Sesion</button>
        </form>

        <ul>
            @foreach ($users as $user)
                <li id="user-{{ $user->id }}">
                    <a href="#" onclick="loadchat({{ $user->id }}, '{{ $user->name }}')">{{ $user->name }}</a>
                    <span id="status-{{ $user->id }}" class="user-status">

                    </span>
                </li>
            @endforeach
        </ul>

        <div id="chat-container">
            <h2>Chat con <span id="chat-username"></span></h2>
            <div id="chat-messages" style="height: 300px; padding: 10px; border: 1px solid #ccc; overflow-y: auto;">

            </div>
            <input type="text" id="chat-input" placeholder="Escribe un mensaje..." style="width: 92%;">
            <button id="send-message" onclick="sendMessage()">Enviar</button>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
    <script>
        const socket = io('http://127.0.0.1:3000');

        window.onload = function(){
            const currentUserId = {{ auth()->id() }};
            socket.emit('register', currentUserId);

            socket.on('user-online', (userId) =>{
                console.log(`Evento recibido: Usuario ${userId} esta online`);

                const statusElement = document.getElementById(`status-${userId}`);
                if (statusElement){
                    statusElement.innerHTML = '<span class="online-status" style="color: green;">(Online)</span>';
                }
            });

            socket.on('user-offline', (userId) =>{
                console.log(`Evento recibido: Usuario ${userId} esta offline`);

                const statusElement = document.getElementById(`status-${userId}`);
                if (statusElement){
                    statusElement.innerHTML = '';
                }
            });

            socket.on('message', (message) =>{
                if(message.receiver_id === currentUserId){
                    console.log('Nuevo mensaje recibido:', message);

                    //Mostrar Notificacion usando Notify.js
                    $.notify(`Nuevo Mensaje de ${message.sender_name}: ${message.content}`,"info");

                    const chatMessages = document.getElementById('chat-messages');
                    const li = document.createElement('div');
                    li.textContent = `${message.user_id === currentUserId ? 'Tú' : message.sender_name}: ${message.content}`;
                    chatMessages.appendChild(li);
                    chatMessages.scrollTop = chatMessages.scrollHeight;

                }
            });

            window.loadchat = loadchat;
            window.sendMessage = sendMessage;
        }

        let currentReceiverId = null
        const currentUserId = {{ auth()->id() }};

        function loadchat(userId, userName){
            console.log(userId);
            currentReceiverId = userId;

            document.getElementById('chat-container').style.display = 'block';
            document.getElementById('chat-username').innerText = userName;

            fetch(`/chat/${userId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Mensajes:',data.messages);

                    const chatMessages = document.getElementById('chat-messages');

                    chatMessages.innerHTML = '';

                    data.messages.forEach(message =>{
                        const li = document.createElement('div');
                        li.textContent = `${message.user.name}: ${message.content}`;
                        chatMessages.appendChild(li);
                    });

                    chatMessages.scrollTop = chatMessages.scrollHeight;
                });
        }

        function sendMessage(){
            const input = document.getElementById('chat-input');
            const content = input.value;

            if(content.trim() === '') return;

            //Crear un objeto de mensaje localmente
            const message = {
                user_id : currentUserId,
                content : content,
            }

            //Emitir Mensaje al servidor Node JS
            socket.emit('message', message);

            const chatMessages = document.getElementById('chat-messages');
            const li = document.createElement('div');
            li.textContent = `Tú : ${message.content}`;
            chatMessages.appendChild(li);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            fetch('/send-message', {
                method: 'POST',
                headers:{
                    'Content-Type' : 'application/json',
                    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({content : content , receiver_id : currentReceiverId})
            }).then(response => response.json())
            .then(
                data=>{
                    console.log(data);
                    input.value = '';
                }
            )
        }
    </script>

</body>
</html>
