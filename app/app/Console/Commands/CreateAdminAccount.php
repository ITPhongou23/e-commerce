<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CreateAdminAccount extends Command
{
    protected $signature = 'admin:create
        {--name= : Admin display name}
        {--email= : Admin email address}';

    protected $description = 'Create an admin account with a one-time generated password';

    public function handle(): int
    {
        $name = $this->option('name') ?: $this->ask('Admin name');
        $email = $this->option('email') ?: $this->ask('Admin email');

        $validator = Validator::make(
            ['name' => $name, 'email' => $email],
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            ],
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $password = Str::password(32);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $user->forceFill(['role' => UserRole::Admin])->save();

        $this->info("Admin account created: {$email}");
        $this->line("One-time password: {$password}");
        $this->warn('Save this password now; it will not be shown again.');

        return self::SUCCESS;
    }
}
