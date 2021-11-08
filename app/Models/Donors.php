<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donors extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'location', 'donation', 'donation_category', 'message', 'bank_payment'];
}
