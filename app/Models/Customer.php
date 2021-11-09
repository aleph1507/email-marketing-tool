<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'sex',
        'DOB',
    ];

    public function customerGroups() {
        return $this->belongsToMany(CustomerGroup::class, 'customers_customer_groups');
    }
}
