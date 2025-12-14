<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Item extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','itemname','brand','image','price','description','condition'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

}
