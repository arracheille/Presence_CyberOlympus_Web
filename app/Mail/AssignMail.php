<?php

namespace App\Mail;

use App\Models\Board;
use App\Models\TaskItem;
use App\Models\Workspace;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssignMail extends Mailable
{
    use Queueable, SerializesModels;

        public $board;
        public $workspace;
        public $taskitem;
    /**
     * Create a new message instance.
     */
    public function __construct(Board $board, Workspace $workspace, TaskItem $taskitem)
    {
        $this->board = $board;
        $this->workspace = $workspace;
        $this->taskitem = $taskitem;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You Are Assigned to a Task Item',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.assign',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
