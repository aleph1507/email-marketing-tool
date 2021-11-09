<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function customers() {
        return $this->belongsToMany(Customer::class, 'customers_customer_groups');
    }

    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }
}
