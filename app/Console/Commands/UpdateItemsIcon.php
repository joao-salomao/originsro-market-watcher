<?php

namespace App\Console\Commands;

use App\Model\Item;
use Illuminate\Console\Command;
use App\Http\Services\OriginsRoApiClient;

class UpdateItemsIcon extends Command
{
    protected $signature = 'ragnarok:update-items-icon {--use-backup}';
    protected $description = 'TODO';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $icons = $this->getIcons();
        foreach ($icons as $icon) {
            $this->updateItemIcon($icon['item_id'], $icon['icon']);
        }
    }

    private function getIcons(): array
    {
        if ($this->option("use-backup")) {
            return $this->getIconsFromBackup();
        }

        return $this->getIconsFromApi();
    }

    private function getIconsFromBackup(): array
    {
        $path = storage_path() . '\icons.json';
        $content = file_get_contents($path);
        $data = json_decode($content, true);
        return $data['icons'];
    }

    private function getIconsFromApi(): array
    {
        return (new OriginsRoApiClient)->getItemsIcons();
    }

    private function updateItemIcon(int $itemId, string $icon)
    {
        Item::where('item_id', $itemId)->update(['icon' => $icon]);
    }
}
