<?php

namespace App\Console\Commands;

use App\Mail\NotifyMail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $user = User::select('email')->get();
        $emails = User::pluck('email')->toArray();
//        $data = ['title' => 'Corona various'] ;
        foreach ($emails as $email){
            Mail::to($email)->send(new NotifyMail());
        }
    }
}
