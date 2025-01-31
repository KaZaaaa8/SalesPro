<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'user_id',
        'subtotal',
        'tax',
        'total_amount',
        'payment_method',
        'payment_amount',
        'change_amount',
        'status',
        'notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'payment_amount' => 'decimal:2',
        'change_amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
