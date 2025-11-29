<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable; // Added
use Illuminate\Queue\InteractsWithQueue;    // Added
use Illuminate\Queue\SerializesModels;      // Added
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Mail\User\PasswordMail;
use App\Models\User;

class StoreUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // 1. You MUST define the property here
    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        // 2. Now this assignment will persist to the queue
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Debugging: Uncomment if needed to check logs
        // \Log::info('Processing StoreUserJob', $this->data);

        $password = Str::random(10);
        
        // Ensure we don't modify the original array reference unexpectedly, 
        // though strictly not an error, it's safer logic.
        $userData = $this->data;
        $userData['password'] = Hash::make($password);

        $user = User::firstOrCreate(['email' => $userData['email']], $userData);

        // Send mail
        Mail::to($userData['email'])->send(new PasswordMail($password));
        
        event(new Registered($user));
    }
}