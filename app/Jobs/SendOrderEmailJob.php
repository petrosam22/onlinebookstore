<?php

namespace App\Jobs;

use App\Mail\SendOrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendOrderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $number;
    public $book;
    public $total;
    public $quantities;
    public $user;
    public function __construct($number,$book,$total,$quantities,$user)
    {
        $this->number = $number;
        $this->book = $book;
        $this->total = $total;
        $this->quantities = $quantities;
        $this->user = $user;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->
        send(new SendOrderMail($this->number , $this->book,$this->total,$this->quantities,$this->user));

    }
}
