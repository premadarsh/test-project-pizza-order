<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pizzaoptions extends Model
{
    use HasFactory;

    protected $table = 'pizza_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'price',
        'size_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getNamePriceAttribute()
    {
        return $this->name . ' RM ' . $this->price;
    }

    public function ScopeToppings($query)
    {
        return $query->where('type',  'topping');
    }

    public function ScopeExtraCheese($query)
    {
        return $query->where('type',  'extra_cheese');
    }


}
