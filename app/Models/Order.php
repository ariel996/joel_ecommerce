<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    use HasFactory;

    protected $fillable = ['user_id', 'billing_email', 'billing_name', 'billing_address', 'billing_city',
                            'billing_province', 'billing_postalcode', 'billing_phone', 'billing_name_on_card',
                            'billing_discount', 'billing_discount_code', 'billing_subtotal', 'billing_tax',
                            'billing_total', 'error', 'ref_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        // adding another field on the collection when accessing the order's products
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function livraisons(): HasMany
    {
        return $this->hasMany(Livraison::class);
    }
}
