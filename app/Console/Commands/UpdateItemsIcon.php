<?php

namespace App\Console\Commands;

use App\Model\Item;
use Illuminate\Console\Command;

class UpdateItemsIcon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ragnarok:update-items-icon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $icons = $this->getIcons();
        foreach($icons as $icon) {
            $this->updateItemIcon($icon['item_id'], $icon['icon']);
        }
    }

    private function getIcons(): array
    {
        $fileStr = file_get_contents(storage_path() . '\icons.json');
        $json = json_decode($fileStr, true);
        return $json['icons'];
    }
    
    private function updateItemIcon(int $itemId, string $icon)
    {
        Item::where('item_id', $itemId)->update(['icon' => $icon]);
    }
}
