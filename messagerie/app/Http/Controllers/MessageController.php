<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      if (Auth::user()) {
         $this->user = Auth::user();
         $this->user_id = json_decode($this->user['id']);
      }
   }
   public function index()
   {

      $messages = Message::all();

      return response()->json($messages);
   }

   public function create(Request $request)
   {
      $message = new Message;

      $message->message = $request->message;
      $message->transmitter_id = $this->user_id;
      $message->receiver_id = $request->receiver_id;

      $message->save();

      return response()->json($message);
   }

   public function showOne($id)

   {
      $message = Message::find($id);
      $transmitter_id = json_decode(json_decode($message)->transmitter_id);
      $receiver_id = json_decode(json_decode($message)->receiver_id);
      if ($transmitter_id !== $this->user_id && $receiver_id !== $this->user_id ) {
        
         return response()->json('user is not a member of this conversation');
      }
      

      return response()->json($message);
   }
   
public function showConversation($recipient){
   //SELECT * FROM `messages` WHERE `transmitter_id` IN(51,2) AND `receiver_id` IN(51,2) ORDER BY `created_at` DESC

   $messages = app('db')->select(
      "SELECT * FROM `messages` WHERE `transmitter_id` IN (".$this->user_id.",".$recipient.") AND `receiver_id` IN (".$this->user_id.",".$recipient.") ORDER BY id");
   
  

return response()->json($messages);

}
   public function update(Request $request, $id)
   {
      $message = Message::find($id);
      
      $transmitter_id = json_decode(json_decode($message)->transmitter_id);

      if ($transmitter_id !== $this->user_id) {
        

         return response()->json('user is not owner of the message');
      }
      $message->message = $request->input('message');


      $message->save();
      return response()->json($message);
   }

   public function destroy($id)
   {
      $message = Message::find($id);
      $transmitter_id = json_decode(json_decode($message)->transmitter_id);
      if ($transmitter_id == $this->user_id) {
         $message->delete();

         return response()->json('message removed successfully');
      } else {
         return response()->json('user is not owner of the message');
      }
   }
}
