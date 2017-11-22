<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Etkinlikler extends Model
{
    protected $table = 'etkinlik';

    public static function PersonelBilgi($id) 
    {   $ogrelemani=User::where('tip', 2)->where('id',$id)->first();
       return $ogrelemani->adsoyad;
    }
}
