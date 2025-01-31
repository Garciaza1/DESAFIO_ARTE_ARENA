<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Item;
use Illuminate\Support\Facades\Log;

class SyncDataFromAPI implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        try {
            $response = Http::get('https://jsonplaceholder.typicode.com/posts');
            $data = $response->json();

            $count = 0;
            foreach ($data as $item) {
                $existingItem = Item::where('id', $item['id'])->first();
                if (!$existingItem) {
                    Item::create([
                        'id' => $item['id'],
                        'title' => $item['title'],
                        'body' => $item['body']
                    ]);
                    $count++;
                }
            }

            Log::info("SyncDataFromAPI: $count new items added.");
        } catch (\Exception $e) {
            Log::error('Erro ao executar o job: ' . $e->getMessage());
        }
    }
}
