<?php

namespace App\Models;
use App\Models\Major;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faculties';

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
    protected $fillable = ['name'];

    public function majors()
    {
        return $this->hasMany(Major::class, 'faculty_id', 'id');
    }
    
}
