<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PrivateChat;
use App\Models\PrivateMessage;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class PrivateChatController extends Controller
{
    public function getMessages($userId){

        try{
            $currentUserId = Auth::id();

            $chat = PrivateChat::where(function ($query) use ($currentUserId, $userId) {
                $query->where('user_one_id',$currentUserId)
                      ->where('user_two_id',$userId);
            })->orWhere(function ($query) use ($currentUserId, $userId){
                $query->where('user_one_id',$userId)
                      ->where('user_two_id',$currentUserId);
            })->first();

            $messages = PrivateMessage::where('private_chat_id',$chat->id)
                ->with('user')
                ->orderBy('created_at','asc')
                ->get();

            return response()->json(['messages' => $messages], 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }

    }

    public function sendMessage(Request $request){

        try{
            $request->validate([
                'content' => 'required|string',
                'receiver_id' => 'required|exists:users,id',
            ]);

            //Obtener el usuario que envia
            $currentUserId = Auth::id();
            $currentUserName = Auth::user()->name;

            //Obtener el usuario receptor
            $receiverId = $request->receiver_id;
            $receiver = User::find($request->receiver_id);
            $receiverName = $receiver ? $receiver->name : 'Usuario Desconocido';

            //Verificar si existe la conversacion
            $chat = PrivateChat::where(function ($query) use ($currentUserId, $receiverId) {
                $query->where('user_one_id',$currentUserId)
                    ->where('user_two_id',$receiverId);
            })->orWhere(function ($query) use ($currentUserId, $receiverId){
                $query->where('user_one_id',$receiverId)
                    ->where('user_two_id',$currentUserId);
            })->first();

            //Si no existe, crea una nueva conversacion
            if(!$chat){
                $chat = PrivateChat::create([
                    'user_one_id' => $currentUserId,
                    'user_two_id' => $receiverId,
                ]);
            }

            //Crea el mensaje en la tabla private_messages
            $message = PrivateMessage::create([
                'private_chat_id' => $chat->id,
                'user_id' => $currentUserId,
                'content' => $request->content,
            ]);

            //Enviar el mensaje al servidor de Node JS
            $client = new \GuzzleHttp\Client();
            $client->post('http://localhost:3000/send-message',[
                'json' => [
                    'message' => [
                        'user_id' => $currentUserId,
                        'sender_name' => $currentUserName,
                        'receiver_id' => $receiver->id,
                        'receiver_name' => $receiverName,
                        'content' => $request->content,
                    ],
                    'receiverId' => $receiverId,
                ]
            ]);

            return response()->json(['message' => 'Mensaje enviado con exito', 'data' => $message],201);
        }catch(\Exception $e){
            return response()->json(['error' => 'Ocurrio un error al enviar el mensaje: '. $e->getMessage()],500);
        }
    }
}
