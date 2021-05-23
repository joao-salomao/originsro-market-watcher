<?php

namespace App\Console\Commands;

use App\Model\Item;
use Illuminate\Console\Command;
use App\Http\Services\OriginsRoApiClient;

class UpdateItems extends Command
{
    protected $signature = 'ragnarok:update-items {--use-backup}';
    protected $description = 'Update items table';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $items = $this->getItems();
        foreach ($items as $item) {
            $this->createOrUpdateItem($item);
        }
    }

    private function getItems(): array
    {
        if ($this->option('use-backup')) {
            return $this->getItemsFromBackup();
        }
        return $this->getItemsFromApi();
    }

    private function getItemsFromBackup(): array
    {
        $path = storage_path() . '\items.json';
        $content = file_get_contents($path);
        $data = json_decode($content, true);
        return $data['items'];
    }

    private function getItemsFromApi(): array
    {
        return (new OriginsRoApiClient)->getItemsList();
    }

    private function createOrUpdateItem(array $item)
    {
        Item::updateOrCreate(['item_id' => $item['item_id']], $item);
    }
}
