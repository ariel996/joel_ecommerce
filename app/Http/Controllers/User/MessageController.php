<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $received_messages = Message::where('destinataire_id', Auth::user()->id)->get();
        $sent_messages = Message::where('expediteur_id', Auth::user()->id)->get();
        return view('messages.index', compact('received_messages', 'sent_messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::query()->where('id','!=', Auth::user()->id)->get();
        return view('messages.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Message::create([
            'expediteur_id' => Auth::user()->id,
            'destinataire_id' => $request->input('destinataire_id'),
            'type' => $request->input('type'),
            'objet' => $request->input('objet'),
            'contenue' => $request->input('contenue'),
            'date' => Carbon::now()->toDateString(),
            'heure' => Carbon::now()->toTimeString(),
            'status' => 0
        ]);
        session()->flash('session', __('Message successfully deleted'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        if ($message->expediteur_id != Auth::user()->id) {
            $message->status = 1;
            $message->save();
        } elseif ($message->destinataire_id == Auth::user()->id) {
            $message->status = 1;
            $message->save();
        }
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        $message->status = 1;
        $message->save();
        return view('messages.reply', compact('message'));
    }

    public function reply_message(Request $request, $id)
    {
        try {
            $message = Message::findOrFail($id);
            $message->expediteur_id = Auth::user()->id;
            $message->destinataire_id = $request->input('destinataire_id');
            $message->contenue = $request->input('contenue');
            $message->objet = $message->objet;
            $message->type = $message->type;
            $message->heure = Carbon::now()->toTimeString();
            $message->date = Carbon::now()->toDateString();
            $message->status = 0;
            $message->save();
            session()->flash('session', __('Message successfully updated'));
            return back();
        } catch (\Exception $exception) {
            return back()->withInput()->withErrors(['unexpected_error' => __('messages.unexpected_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $message = Message::findOrFail($id);
            $message->delete();
            session()->flash('session', __('Message successfully deleted'));
            return back();
        } catch (\Exception $exception) {
            return back()->withInput()->withErrors(['unexpected_error' => __('messages.unexpected_error')]);
        }
    }
}
