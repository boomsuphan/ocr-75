<?php

namespace App\Models;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'majors';

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
    protected $fillable = ['name', 'faculty_id'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    
}
