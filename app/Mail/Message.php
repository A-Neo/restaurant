<?php

namespace App\Mail;

use App\Models\Callback;
use App\Models\Messages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message extends Mailable
{
    use Queueable, SerializesModels;
    public $id;

    /**
     * Create a new message instance.
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Дэди. Обратная связь';
        $data = Messages::find($this->id);
        return $this->subject($subject)->view('mail.message', compact('data'));
    }
}
