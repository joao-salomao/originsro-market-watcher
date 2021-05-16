<?php

namespace App\Console\Commands;

use App\Model\Item;
use Illuminate\Console\Command;

class UpdateItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ragnarok:update-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update items table';

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
        $items = $this->getItems();
        foreach ($items as $item) {
            $this->createOrUpdateItem($item);
        }
    }

    private function getItems(): array
    {
        $fileStr = file_get_contents(storage_path() . '\items.json');
        $json = json_decode($fileStr, true);
        return $json['items'];
    }

    private function createOrUpdateItem(array $item)
    {
        Item::updateOrCreate(['item_id' => $item['item_id']], $item);
    }
}
