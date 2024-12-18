<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    protected $fillable = ['name', 'title','blurb'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute(){
        return "https://ddragon.leagueoflegends.com/cdn/14.24.1/img/champion/{$this->name}.png";
    }

    public static function getTwoChampions(){
        return self::inRandomOrder()->limit(2)->get();
    }
}
