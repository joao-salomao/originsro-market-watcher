<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('ragnarok:update-items --use-backup');
        Artisan::call('ragnarok:update-items-icon --use-backup');
    }
}
