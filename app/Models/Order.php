<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus($st)
    {
        $arr = [
            'new' => 'Новая',
            'process' => 'В процессе',
            'success' => 'Завершен',
            'canceled' => 'Отменен',
        ];
        return $arr[$st];
    }

    public function getStatusColor($st)
    {
        $arr = [
            'new' => 'text-primary',
            'process' => 'text-warning',
            'success' => 'text-success',
            'canceled' => 'text-danger',
        ];
        return $arr[$st];
    }

    public function getType($st)
    {
        $arr = [
            'card' => 'Картой',
            'phone' => 'По телефону',
        ];
        return $arr[$st];
    }
}
