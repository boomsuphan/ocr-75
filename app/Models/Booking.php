<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Room;

class Booking extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['room_id', 'user_id', 'subject', 'name_professor', 'note', 'semester', 'date_booking', 'time_start_booking', 'time_end_booking', 'time_get_key', 'time_return_key', 'code_for_qr', 'id_officer_give_key', 'id_officer_return_key', 'status', 'return_verify_code','cancelled_by','picker_user_id','picker_std_id','returnee_user_id','returnee_std_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    
}
