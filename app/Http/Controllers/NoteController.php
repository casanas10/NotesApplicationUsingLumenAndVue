<?php

namespace App\Http\Controllers;

use App\User;
use App\Note;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class NoteController extends BaseController
{

    public function show(Request $request, $id) {
    
        $user_notes = User::with('notes')->find($id);
        return $user_notes;
    }

    public function store(Request $request){

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        
        $note = new Note;
        $note->title = $request->title;
        $note->body = $request->body;
        $note->user_id = $request->user()->id;
        $note->save();
        return $note;
    }

    public function update(Request $request, $id){
        $note = Note::find($id);
        $note->title = $request->title;
        $note->body = $request->body;
        $note->save();
        return $note;
    }

    public function deleteNote($id){
        $note = Note::find($id);
        $note->delete();

        return response()->json("Deleted Note");
    }
}