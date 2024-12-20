<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['computer_id','reported_by','reported_date','description','urgency','status'];

    /**
     * Define a many-to-one relationship with the Computer model.
     */
    public function computer()
    {
        return $this->belongsTo(Computer::class, 'computer_id'); // 'computer_id' là khóa ngoại
    }
}
