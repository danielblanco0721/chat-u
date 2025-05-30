const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const bodyParser = require('body-parser');

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
    cors:{
        origin: '*',
        methods : ['GET', 'POST'],
    }
});

app.use(bodyParser.json());

let users = {};

io.on('connection', (socket)=>{
    console.log('Nuevo Cliente Conectado:', socket.id);

    socket.on('register',(userId) => {

        if (!users[userId]){
            users[userId] = [];
        }

        users[userId].push(socket.id);

        io.emit('user-online', userId);

        console.log(`Usuario ${userId} registrado con el socket ${socket.id}`);
    });

    socket.on('disconnect',() => {

        for(let userId in users){
            const index = users[userId].indexOf(socket.id);
            if (index !== -1){
                users[userId].splice(index,1);

                if(users[userId].length === 0){
                    delete users[userId];
                    io.emit('user-offline', userId);
                    console.log(`Usuario ${userId} Desconectado`);
                }
            }
        }

    });
});

app.post('/send-message',(req, res) =>{
    const { message, receiverId } = req.body;
    const receiverSocketId = users[receiverId];

    if (receiverSocketId){
        io.to(receiverSocketId).emit('message', message);
        console.log(`Mensaje Enviado a  ${receiverId}:`, message );
    }else{
        console.log(`El usuario ${receiverId} no esta conectado`);
    }

    res.status(200).send('Mensaje Enviado');
});

server.listen(3000, () => {
    console.log('Servidor de Websockets por el puerto 3000');
});