<?php

namespace App\Mail;

use App\Models\Callback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reservation extends Mailable
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
        $form = Callback::find($this->id);
        if($form->type == 2) {
            $subject = 'Бронь банкета';
        } else {
            $subject = 'Бронь стола';
        }
        
        
        return $this->subject($subject)->view('mail.reservation', compact('form'));
    }
}
