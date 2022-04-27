<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    public const PER_PAGE = 10;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'reference',
        'description',
    ];


    public function storeRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'description' => 'required',
        ];
    }
}
