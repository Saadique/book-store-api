<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GenerateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate_data:books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://fakerapi.it/api/v1/books?_quantity=100');
        $body = json_decode($response->body());
        $data = $body->data;
        foreach ($data as $item){
          DB::table('books')->insert(
              [
                  'title' => $item->title,
                  'author' => $item->author,
                  'isbn' => $item->isbn,
                  'genre' => $item->genre,
                  'description' => $item->description,
                  'image' => $item->image,
                  'published' => $item->published,
                  'publisher' => $item->publisher
              ]
          );
        }
        return Command::SUCCESS;
    }
}
