<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Mission extends Model
{
    use HasFactory;

    public const ASSIGNED = '0';
    public const INPROGRESS = '1';
    public const DELAYED = '2';
    public const COMPLETED = '3';

    public const MISSION_TWEET = '0';
    public const MISSION_RESOURCE = '1';

    public function missionType($type = '') {
        if($type == '') {
            $type = $this->type;
        }
        $response = array();
        $response['type'] = $type;

        switch($type) {
            case 0:
                $response['name'] = 'Tweet Verification';
                $response['color'] = 'primary';
                $response['gradient'] = 'bg-primary-gradient';
                $response['icon'] = 'fab fa-twitter';
            break;

            case 1:
                $response['name'] = 'Resource Verification';
                $response['color'] = 'success';
                $response['gradient'] = 'bg-success-gradient';
                $response['icon'] = 'fas fa-info-circle';
            break;


            default:
                throw new Exception('Unknown Mission type provided');
            break;
        }

        $response = (object) $response;
        return $response;
    }



    protected $fillable = [
        'volunteer_id',
        'uuid',
        'description',
        'slot_start',
        'slot_end',
        'count',
        'data',
        'completed',
        'type',
        'total',
    ];


    public static function getAllTweetStatus() {
        $status = array();

        $status[] = self::ASSIGNED;
        $status[] = self::INPROGRESS;
        $status[] = self::DELAYED;
        $status[] = self::COMPLETED;

        return $status;
    }

    public function getStatus($status = '') {

        if($status == '') {
            $status = $this->status;
        }
        $response = array();
        $response['id'] = $status;

        switch($status) {
            case 0:
                $response['name'] = 'Assigned';
                $response['color'] = 'warning';
                $response['gradient'] = 'bg-warning-gradient';
                $response['icon'] = 'circle-notch';
            break;

            case 1:
                $response['name'] = 'In Progress';
                $response['color'] = 'primary';
                $response['gradient'] = 'bg-primary-gradient';
                $response['icon'] = 'sync fa-spin';
            break;

            case 2:
                $response['name'] = 'Delayed';
                $response['color'] = 'danger';
                $response['gradient'] = 'bg-danger-gradient';
                $response['icon'] = 'exclamation-triangle';
            break;

            case 3:
                $response['name'] = 'Completed';
                $response['color'] = 'success';
                $response['gradient'] = 'bg-success-gradient';
                $response['icon'] = 'check';
            break;


            default:
                throw new Exception('Unknown Mission status ID type provided');
            break;
        }

        $response = (object) $response;
        return $response;
    }

    public function dataArray() {
        return json_decode($this->data);
    }

    public function getVolunteer() {
        return $this->hasOne(User::class, 'id', 'volunteer_id');
        // return User::find($this->volunteer_id)->first();
    }
}
