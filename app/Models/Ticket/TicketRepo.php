<?php

namespace App\Models\Ticket;

use App\Mail\NewTicketMail;
use App\Models\BaseRepository;
use App\Models\Message\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketRepo extends BaseRepository
{
    protected $model;

    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    public function isRead($items)
    {
        if (Auth::check()) {
            $items->is_read = 1;
            $items->save();
        }
    }
    public function storeMessage($request)
    {
        $user = Auth::user()->id;
        $request->merge(['user_id' => $user]);
        $request->merge(['ticket_id' => $request->ticket_id]);
        Message::create($request->except('_token', 'email'));
    }

    public function sentMail($item)
    {
        // dd(!is_null($item->reply));

        if (!is_null($item->reply)) {
            //reply mail notification
            Mail::to($item->email)->send(new NewTicketMail($item));
        } else {
            //create mail notification
            Mail::to($item->email)->send(new NewTicketMail($item));
        }
    }
}
