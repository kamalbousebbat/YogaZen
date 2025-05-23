<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'subscription_expires_at', 'status', 'last_login'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
