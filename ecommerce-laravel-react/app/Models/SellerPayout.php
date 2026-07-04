<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerPayout extends Model
{
    protected $fillable = ['seller_id', 'amount', 'status', 'payout_reference'];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
