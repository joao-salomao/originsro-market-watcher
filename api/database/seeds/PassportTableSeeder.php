<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class PassportTableSeeder extends Seeder
{
    public function run()
    {
        $this->installPassport();
        $this->updateSecret();
    }

    private function installPassport()
    {
        Artisan::call('passport:install');
    }

    private function updateSecret()
    {
        $secret = env('PASSWORD_GRANT_CLIENT_SECRET', Str::random());
        DB::table('oauth_clients')->where('id', 2)->update(['secret' => $secret]);
    }
}
