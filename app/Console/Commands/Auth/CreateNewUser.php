<?php

namespace App\Console\Commands\Auth;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateNewUser
 * @pakege App\Console\Commands\Auth
 *
 * @author Otinov Ilya
 */
class CreateNewUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-new-user {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $secretCode = config('user.code');
        if (empty($secretCode)) {
            $this->info("Secret code not configured. Pleas ask Ilya for help");
        }

        $userGuess = $this->ask('Print secret code');

        if ($userGuess !== $secretCode) {
            $this->error("Code is invalid");
            return;
        }

        $userIsCreated = $this->createNewUser($this->argument('email'), $this->argument('password'));
        if ($userIsCreated) {
            $this->info("user was created!");
        } else {
            $this->error('Something went wrong. Please ask Ilya for some help.');
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    private function createNewUser(string $email, string $password): bool
    {
        $user = new User();
        $password = Hash::make($password);
        $user->password = $password;
        $user->name = $email;
        $user->email = $email;
        $user->email_verified_at = now();
        return $user->save();
    }

}
