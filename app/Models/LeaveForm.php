<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveForm extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'leave_type',
        'leave_start',
        'leave_end',
        'reason',
        'file1',
        'file2',
        'sel_rep',
        'sel_pm',
        'approve_rep',
        'approve_pm',
        'approve_hr',
        'approve_ceo',
        'status',
        'case_no_rep',
        'reason_pm',
        'allowed_pm',
        'not_allowed_pm',
        'reason_hr',
        'not_allowed_hr',
        'reason_ceo',
        'not_allowed_ceo',
    ];

    public function representative()
    {
        return $this->belongsTo(User::class, 'sel_rep', 'id');
    }

    public function relation_user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function relation_user_pm(){
        return $this->belongsTo(User::class,'sel_pm','id');
    }
}
