<?php

namespace App\Console\Commands;

use App\Model\Item;
use Illuminate\Console\Command;
use App\Http\Services\OriginsRoApiClient;

class UpdateItems extends Command
{
    protected $signature = 'ragnarok:update-items';
    protected $description = 'Update items table';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $items = (new OriginsRoApiClient)->getItemsList();
        foreach ($items as $item) {
            $this->createOrUpdateItem($item);
        }
    }

    private function createOrUpdateItem(array $item)
    {
        Item::updateOrCreate(['item_id' => $item['item_id']], $item);
    }
}
