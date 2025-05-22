<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    /**
     * Name of the table in the database.
     * 
     * @var string
     */
    protected $table = 'booking';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'pair_number',
        'day_week',
        'group_name',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'pair_number' => 'integer',
        'day_week'    => 'integer',
        'group_name'  => 'string',
        'status'      => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}