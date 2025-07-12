<?php

namespace App\Mail;

use App\Models\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IssueReported extends Mailable
{
    use Queueable, SerializesModels;

    public $issue;

    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }

    public function build()
    {
        return $this->subject('แจ้งเตือน: มีการแจ้งปัญหาใหม่')
                    ->markdown('emails.issues.reported');
    }
}
