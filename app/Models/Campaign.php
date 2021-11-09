<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'send_at',
        'sent',
        'template_id',
        'customer_group_id'
    ];

    public function template() {
        return $this->belongsTo(Template::class);
    }

    public function customerGroup() {
        return $this->belongsTo(CustomerGroup::class);
    }
}
