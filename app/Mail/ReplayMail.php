<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Setting;

class ReplayMail extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $content;
    public $to_email;

    public function __construct($title, $content, $to_email)
    {
        $this->title = $title;
        $this->content = $content;
        $this->to_email = $to_email;
    }

    public function build()
    {
        $data['title']= $this->title;
        $data['content']= $this->content;
        $data['to_email']= $this->to_email;
        $data['header_text'] = $this->title;
        $item= new Setting();
        
        return $this->from($item->valueOf('email'), $item->valueOf('title_en'))->subject($this->title)->view('mail.replay',$data);
        }
}
