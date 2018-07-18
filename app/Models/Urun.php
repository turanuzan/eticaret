<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Urun extends Model
{
    // laravel otomatik olarak tablonun sonuna s eki getirerek ariyor uruns seklinde.
    // Bu durumdan kurtulmak icin table degiskenine tablonun ismi verilir.
    protected $table = 'urun';

    // laravel default olarak her tabloda created_at ve update_at kolonlarının olduğunu varsayar
    // Bu durumdan kurtulmak için aşağıdaki gibi $timestamp degeri false yapılır.
    public $timestamp = false;
}
