<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Item;
use Illuminate\Support\Facades\Cache;
// use GuzzleHttp\Client;

class FetchDataFromAPI extends Command
{
    protected $signature = 'fetch:data';
    protected $description = 'Fetch data from API and store in database';

    public function handle()
    {
        // com verificação
        // $request = $client->request('GET','https://jsonplaceholder.typicode.com/posts', ['verify' => false]);   
        // sem verificação:
        $response = Http::withoutVerifying()->get('https://jsonplaceholder.typicode.com/posts');
        $data = $response->json();

        foreach ($data as $item) {
            Item::firstOrCreate(
                ['id' => $item['id']],
                ['title' => $item['title'], 'body' => $item['body']]
            );
        }

        // Cache the data for 24 hours
        Cache::put('api_data', $data, now()->addHours(24));

        $this->info('Data fetched and stored successfully.');
    }
}