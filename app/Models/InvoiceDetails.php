<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $guarded = [];

    public function invoice()
    {
        return $this ->belongsTo(Invoice::class,'invoice_id','id');
    }
}
