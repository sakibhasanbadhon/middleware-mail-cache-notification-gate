<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;



    public static function get_brand()
    {
        return Cache::remember('_brands', now()->addMinutes(4),function(){
            return Student::orderBy('id','desc')->get();
        });
    }

    public static function cache_forget(){
        return Cache::forget('_brands');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function(){
            self::cache_forget();
        });

        static::updated(function(){
            self::cache_forget();
        });

        static::deleted(function(){
            self::cache_forget();
        });


    }




}
