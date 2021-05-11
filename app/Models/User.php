<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use BeyondCode\Comments\Traits\HasComments;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'state',
        'district',
        'accepted',
        'phone_number',
        'referred_by',
        'referral_link',
        'available_for_mission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['initials'];

    public function states() {
        // return States::where('code', auth()->user()->state)->first();
        return $this->hasOne(States::class, 'code', 'state');
    }




    public function getInitialsAttribute() {
        $nameWords = explode(" ", $this->name);
        
        $initials =  "";
        for($i = 0; $i<count($nameWords); $i++){
        	$initials = $initials . substr($nameWords[$i], 0, 1);
        	if($i > 2) {
            	break;
        	}
        }
        return $initials;
    }
}
