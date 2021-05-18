<?php

namespace App\Console\Commands;

use App\Model\Item;
use Illuminate\Console\Command;
use App\Http\Services\OriginsRoApiClient;

class UpdateItemsIcon extends Command
{
    protected $signature = 'ragnarok:update-items-icon';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $icons = (new OriginsRoApiClient)->getItemsIcons();
        foreach ($icons as $icon) {
            $this->updateItemIcon($icon['item_id'], $icon['icon']);
        }
    }

    private function updateItemIcon(int $itemId, string $icon)
    {
        Item::where('item_id', $itemId)->update(['icon' => $icon]);
    }
}
