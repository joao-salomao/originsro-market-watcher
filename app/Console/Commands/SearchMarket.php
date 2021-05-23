<?php

namespace App\Console\Commands;

use App\Model\Alert;
use App\Model\AlertMatch;
use Illuminate\Console\Command;
use App\Http\Services\OriginsRoApiClient;

class SearchMarket extends Command
{
    protected $signature = 'ragnarok:search-market';
    protected $description = 'TODO';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        // $shops = json_decode(file_get_contents(storage_path() . '\market.json'), true)['shops'];
        $alerts = Alert::all();
        $shops = (new OriginsRoApiClient)->getMarketShops();

        foreach ($alerts as $alert) {
            $this->checkAlertMatch($alert, $shops);
        }
    }

    private function checkAlertMatch(Alert $alert, array $shops)
    {
        $items = collect();
        foreach ($shops as $shop) {
            $itemsFounded = array_filter($shop['items'], function ($item) use ($alert) {
                return $item['item_id'] == $alert->item->item_id && $item['price'] <= $alert->max_price;
            });

            if (!empty($itemsFounded)) {
                $itemsFounded = array_map(function ($item) use ($shop) {
                    $item['location'] = $shop['location'];
                    $item['shop_name'] = $shop['title'];
                    $item['owner_name'] = $shop['owner'];

                    return $item;
                }, $itemsFounded);

                $items = $items->merge($itemsFounded);
            }
        }

        if ($items->count()) {
            $bestOffer = $items->sortBy('price')->values()->first();
            AlertMatch::create([
                'alert_id' => $alert->id,
                'shop_name' => $bestOffer['shop_name'],
                'owner_name' => $bestOffer['owner_name'],
                'map' => $bestOffer['location']['map'],
                'location_x' => $bestOffer['location']['x'],
                'location_y' => $bestOffer['location']['y'],
            ]);
        }
    }
}
