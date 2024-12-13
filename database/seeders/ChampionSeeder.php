<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ChampionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function getAllChampions()
    {
        $query = 'https://ddragon.leagueoflegends.com/cdn/14.24.1/data/en_US/champion.json';
        $response = Http::get($query)->throw()->json();
        return array_map(fn ($champion) => [
            'name' => $champion['name'],
            'title' => $champion['title'],
            'blurb' => $champion['blurb'],
        ], $response['data']);
    }
    public function run(): void
    {
        $champions = $this->getAllChampions();
        $totalChampions = count($champions);
        $iterator = 0;
        foreach ($champions as $index => $champion) {
            $this->command->info("Processing {$champion['name']} (".($iterator + 1)."/{$totalChampions})");
            $champion = array_merge($champion, [
                'name' => $champion['name'],
                'blurb' => $champion['blurb'],
                'title' => $champion['title'],
            ]);
            \App\Models\Champion::create($champion);
            $iterator++;
        }
    }
}
