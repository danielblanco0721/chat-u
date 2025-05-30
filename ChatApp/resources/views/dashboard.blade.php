<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tropiconecta | Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('dist/media/img/logo-2x.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('dist/css/css2?family=Nunito:wght@200;300;400;600;700&display=swap') }}" >
    <link rel="stylesheet" href="{{ asset('dist/icons/themify/themify-icons.css') }}" >
    <link rel="stylesheet" href="{{ asset('dist/icons/materialicons/css/materialdesignicons.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('dist/vendor/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendor/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendor/fancybox/jquery.fancybox.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/vendor/introjs/introjs.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/css/app.min.css') }}">
</head>
<body>

<div class="preloader">
    <img src="{{ asset('dist/media/img/logo-2x.png') }}" alt="logo">
    <p class="lead font-weight-bold text-muted my-5">Cargando Tropiconecta ...</p>
    <div class="spinner-border" role="status">
        <span class="sr-only">Cargando...</span>
    </div>
</div>

<!-- layout -->
<div class="layout">
    <!-- navigation -->
    <nav class="navigation">
        <div class="nav-group">
            <ul>
                <li class="logo">
                    <a href="#">
                        <img src="{{ asset('dist/media/img/logo-2x.png') }}" alt="logo" style="width: 110px; height: auto;">
                    </a>
                </li>
                <li>
                    <a class="active" data-intro-js="2" data-left-sidebar="chats" href="#" data-toggle="tooltip" title="Chats" data-placement="right">
                        <span class="badge badge-warning"></span>
                        <i data-feather="message-circle"></i>
                    </a>
                </li>

                <li class="brackets">

                </li>

                <li class="d-none d-lg-block" data-toggle="tooltip" title="Settings" data-placement="right">

                </li>

                <li data-toggle="tooltip" title="Cerrar Sesion" data-placement="right">
                    <a href="login.html" data-intro-js="3" data-toggle="dropdown">
                        <figure class="avatar avatar-sm">
                            <img src="{{ asset('dist/media/img/icono-salir.jpg') }}" class="rounded-circle" alt="image">
                        </figure>
                    </a>
                    <div class="dropdown-menu">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"> Cerrar Sesion</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- ./ navigation -->

    <!-- Chat left sidebar -->
    <div id="chats" class="left-sidebar open">
        <div class="left-sidebar-header">
            <div class="story-block">
                <h4 class="mb-4">Contactos</h4>
            </div>
            <form>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn" type="button">
                            <i class="ti-search"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" placeholder="Search chats">
                </div>
            </form>
        </div>
        <div class="left-sidebar-content">
            <ul class="list-group list-group-flush">

                @foreach ($users as $user)
                    <li class="list-group-item" id="user-{{ $user->id }}" onclick="loadchat({{ $user->id }}, '{{ $user->name }}')">
                        <div>
                            <figure class="avatar mr-3">
                                <img src="{{ asset('dist/media/img/avatar1.jpg') }}" class="rounded-circle" alt="image">
                            </figure>
                        </div>
                        <div class="users-list-body">
                            <div>
                                <h5>{{ $user->name }}</h5>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="users-list-action">
                                <small class="text-muted" id="status-{{ $user->id }}" class="user-status"></small>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
    <!-- ./ Chat left sidebar -->

    <!-- chat -->
    <div class="chat" hidden> <!-- no-message -->
        <div class="chat-header">
            <div class="chat-header-user">
                <figure id="chat-avatar" class="avatar">
                    <img src="{{ asset('dist/media/img/avatar1.jpg') }}" class="rounded-circle" alt="image">
                </figure>
                <div>
                    <h5 id="chat-username"></h5>
                    <small id="chat-status" class="text-success"></small>
                </div>
            </div>
            <div class="chat-header-action">

            </div>
        </div>
        <div class="chat-body">
            <div id="chat-messages" class="messages" style="overflow-y: auto;">

            </div>
        </div>

        <div class="chat-footer" data-intro-js="6">
            <form class="d-flex">
                <div class="dropdown">
                    <button class="btn btn-light-info btn-floating mr-3" data-toggle="dropdown" title="Emoji" type="button">
                        <i class="mdi mdi-face"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-big p-0">
                        <div class="dropdown-menu-search">

                        </div>
                        <div class="emojis chat-emojis">
                            <ul>
                                <li>😁</li>
                                <li>😂</li>
                                <li>😃</li>
                                <li>😄</li>
                                <li>😅</li>
                                <li>😆</li>
                                <li>😉</li>
                                <li>😊</li>
                                <li>😋</li>
                                <li>😌</li>
                                <li>😍</li>
                                <li>😏</li>
                                <li>😒</li>
                                <li>😓</li>
                                <li>😔</li>
                                <li>😖</li>
                                <li>😘</li>
                                <li>😝</li>
                                <li>😠</li>
                                <li>😢</li>
                                <li>🙅</li>
                                <li>🙆</li>
                                <li>🙇</li>
                                <li>🙈</li>
                                <li>🙉</li>
                                <li>🙊</li>
                                <li>🙋</li>
                                <li>🙌</li>
                                <li>🙍</li>
                                <li>🙎</li>
                                <li>🙏</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <input type="text" id="chat-input" class="form-control form-control-main" placeholder="Escribe un mensaje...">
                <div>
                    <a class="btn btn-primary ml-2 btn-floating" id="send-message" onclick="sendMessage()">
                        <i class="mdi mdi-send"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!-- ./ chat -->
</div>
<!-- ./ layout -->

<script src="{{ asset('dist/vendor/bundle.js') }}"></script>
<script src="{{ asset('dist/icons/feather/feather.min.js') }}"></script>
<script src="{{ asset('dist/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('dist/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('dist/vendor/introjs/intro.js') }}"></script>
<script src="{{ asset('dist/vendor/jquery.stopwatch.js') }}"></script>
<script src="{{ asset('dist/vendor/sweetalert2.js') }}"></script>
<script src="{{ asset('dist/js/app.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
@vite('resources/js/app.js')

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

            const avatarElement = document.querySelector(`#user-${userId} .avatar`);
            if (avatarElement){
                avatarElement.classList.add('avatar-state-success');
            }

            const userElement = document.getElementById(`user-${userId}`);
            if (userElement){
                userElement.setAttribute('data-is-online','true');
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

                const formattedMessage =`
                        ${message.content.length > 50
                        ? message.content.substring(0,50) + '...'
                        : message.content
                    }
                `;

                //Mostrar Notificacion usando Notify.js
                $.notify(`Nuevo Mensaje de ${message.sender_name}: ${formattedMessage}`,"info");

                const chatMessages = document.getElementById('chat-messages');

                const messageItem = document.createElement('div');
                const isCurrentUser = message.user_id === currentUserId;
                messageItem.className = `message-item ${isCurrentUser ? 'out' : 'in'}`;

                messageItem.innerHTML = `

                    ${!isCurrentUser ? `
                    <div class="message-avatar">
                        <figure class="avatar avatar-sm">
                            <img src="{{ asset('dist/media/img/avatar1.jpg') }}" class="rounded-circle" alt="image">
                        </figure>
                        <div>
                            <h5>${message.sender_name}</h5>
                            <div class="time">10:12 PM</div>
                        </div>
                    </div>
                    `:`
                    <div class="message-avatar">
                        <figure class="avatar avatar-sm">
                            <img src="{{ asset('dist/media/img/avatar1.jpg') }}" class="rounded-circle" alt="image">
                        </figure>
                        <div>
                            <h5>Yo</h5>
                            <div class="time">10:12 PM</div>
                        </div>
                    </div>`}
                    <div class="message-content">
                        <div class="message-text">${message.content}</div>
                    </div>
                `;

                chatMessages.appendChild(messageItem);

                scrollToBottom();

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

        const chat = document.querySelector('.chat');
        chat.removeAttribute('hidden');

        document.getElementById('chat-username').innerText = userName;

        const userElement = document.getElementById(`user-${userId}`);
        const isOnline = userElement?.getAttribute('data-is-online') === 'true';

        const chatStatus = document.getElementById('chat-status');
        if(chatStatus){
            chatStatus.textContent = isOnline ? 'Online' : 'Offline';
            chatStatus.className = isOnline ? 'text-success' : 'text-muted';
        }

        const chatAvatar = document.getElementById('chat-avatar');
        if(chatAvatar){
            if(isOnline){
                chatAvatar.classList.add('avatar-state-success');
            }else{
                chatAvatar.classList.remove('avatar-state-success');
            }
        }

        fetch(`/chat/${userId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Mensajes:',data.messages);

                const chatMessages = document.getElementById('chat-messages');

                chatMessages.innerHTML = '';

                const CURRENT_USER_ID = {{ auth()->id() }}

                data.messages.forEach(message =>{

                    const isCurrentUser = message.user.id === CURRENT_USER_ID;

                    const messageItem = document.createElement('div');
                    messageItem.className = `message-item ${isCurrentUser ? 'out' : 'in'}`;

                    messageItem.innerHTML = `
                        <div class="message-avatar">
                            <figure class="avatar avatar-sm">
                                <img src="{{ asset('dist/media/img/avatar1.jpg') }}" class="rounded-circle" alt="image">
                            </figure>
                            <div>
                                <h5>${isCurrentUser ? 'Yo' : message.user.name}</h5>
                                <div class="time">10:12 PM</div>
                            </div>
                        </div>
                        <div class="message-content">
                            <div class="message-text">${message.content}</div>
                        </div>
                    `;

                    chatMessages.appendChild(messageItem);
                });

                scrollToBottom();
            });


    }

    function sendMessage(){
        const input = document.getElementById('chat-input');
        const content = input.value;

        if(content.trim() === '') return;

        console.log(currentUserId);
        console.log(content);

        //Crear un objeto de mensaje localmente
        const message = {
            user_id : currentUserId,
            content : content,
        }

        //Emitir Mensaje al servidor Node JS
        socket.emit('message', message);

        const chatMessages = document.getElementById('chat-messages');

        const messageItem = document.createElement('div');
        messageItem.className = `message-item out`;

        messageItem.innerHTML = `
            <div class="message-avatar">
                <figure class="avatar avatar-sm">
                    <img src="{{ asset('dist/media/img/avatar1.jpg') }}" class="rounded-circle" alt="image">
                </figure>
                <div>
                    <h5>Yo</h5>
                    <div class="time">10:12 PM</div>
                </div>
            </div>
            <div class="message-content">
                <div class="message-text">${message.content}</div>
            </div>
        `;

        chatMessages.appendChild(messageItem);

        scrollToBottom();

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

    function scrollToBottom(){
        const chatBody = document.querySelector('.chat .chat-body');
        if(chatBody) {
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    }

    document.querySelectorAll('.emojis ul li').forEach(emoji =>{
        emoji.addEventListener('click', ()=>{
            const chatInput = document.getElementById('chat-input');
            chatInput.value += emoji.textContent;
            chatInput.focus();
        });
    });
</script>
</body>
</html>
