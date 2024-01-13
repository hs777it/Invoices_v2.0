<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'users:create';
    //protected $signature = 'users:create {name} {email} {password?}';
    protected $signature = 'users:create {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

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
    // public function handle()
    // {
    //     $name = $this->argument('name');
    //     $email = $this->argument('email');
    //     $password = $this->argument('password');
    //     $user = User::updateOrCreate([
    //         'name' => $name,
    //         'email' => $email,
    //         'password' => $password ? \bcrypt($password) : \bcrypt('123456'),
    //     ]);
    //     if ($user) $this->info('User created successfully');
    // }

    // params optional 
    //  php artisan users:create --name="Hussein" --email="hts07@gmil.com" --password="123"
    public function handle()
    {
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');
    
        $user = User::updateOrCreate([
            'name' => $name,
            'email' => $email,
            'password' => $password ? \bcrypt($password) : \bcrypt('123456'),
        ]);
        if ($user) $this->info('User created successfully');
    }
}
