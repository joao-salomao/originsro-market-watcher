<?php

use App\Model\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $this->createDefaultUser();
    }

    private function createDefaultUser()
    {
        $properties = $this->getProperties();
        $user = new User($properties);
        $user->save();
    }

    private function getProperties(): array
    {
        return [
            'name' => 'Teste',
            'nickname' => 'Teste',
            'email' => 'teste@teste.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'),
            'remember_token' => Str::random(10),
        ];
    }
}
