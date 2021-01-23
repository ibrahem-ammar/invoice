<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function details()
    {
        return $this ->hasMany(InvoiceDetails::class,'invoice_id','id');
    }

}
