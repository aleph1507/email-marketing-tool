<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

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

    public function scopeUnscheduled($query) {
        return $query->where('scheduled', false);
    }

    public function scopeUnsent($query) {
        return $query->where('sent', false);
    }

    public function scopeFuture($query) {
        return $query->where(new DateTime('send_at'), '>', now());
    }
}
