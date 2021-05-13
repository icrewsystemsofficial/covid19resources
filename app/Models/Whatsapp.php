<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Whatsapp extends Model
{
    use HasFactory;

    protected $table = 'whatsapp';

    protected $fillables = [
        'title',
        'body',
        'location',
        'state',
        'city',
        'wa_phone',
        'wa_name',
        'status',
    ];

    public const PENDING = '0';
    public const VERIFIED = '1';
    public const REFUTED = '2';

    public const SPAM = '3';
    public const INADEQUATE = '4';
    public const DUPE = '5';
    public const SCREENED = '6';
    public const OLD = '7';

    public static function getAllTweetStatus() {
        $status = array();

        $status[] = self::PENDING;
        $status[] = self::VERIFIED;
        $status[] = self::REFUTED;
        $status[] = self::SPAM;
        $status[] = self::INADEQUATE;
        $status[] = self::DUPE;
        $status[] = self::SCREENED;

        foreach($status as $status) {

        }
        return $status;
    }

    public function getStatus($status = '') {

        if($status == '') {
            $status = $this->status;
        }
        $response = array();
        $response['id'] = $status;
        //Update the switch code on API/Twitter.php as well.
        switch($status) {
            case 0:
                $response['name'] = 'Pending';
                $response['color'] = 'dark';
                $response['gradient'] = 'bg-warning-gradient';
                $response['icon'] = 'question';
            break;

            case 6:
                $response['name'] = 'Screened';
                $response['color'] = 'warning';
                $response['gradient'] = 'bg-warning-gradient';
                $response['icon'] = 'check';
            break;

            case 1:
                $response['name'] = 'Verified';
                $response['color'] = 'success';
                $response['gradient'] = 'bg-success-gradient';
                $response['icon'] = 'check-circle';
            break;

            case 2:
                $response['name'] = 'Refuted';
                $response['color'] = 'danger';
                $response['gradient'] = 'bg-danger-gradient';
                $response['icon'] = 'exclamation-triangle';
            break;

            case 3:
                $response['name'] = 'Spam';
                $response['color'] = 'dark';
                $response['gradient'] = 'bg-dark';
                $response['icon'] = 'times-circle';
            break;

            case 4:
                $response['name'] = 'Inadequate Info';
                $response['color'] = 'dark';
                $response['gradient'] = 'bg-dark';
                $response['icon'] = 'question';
            break;

            case 5:
                $response['name'] = 'Duplicate';
                $response['color'] = 'primary';
                $response['gradient'] = 'bg-gradient-primary';
                $response['icon'] = 'check';
            break;

            case 7:
                $response['name'] = 'Old';
                $response['color'] = 'dark';
                $response['gradient'] = 'bg-dark';
                $response['icon'] = 'clock';
            break;


            default:
                throw new Exception('Unknown status ID type provided');
            break;
        }

        $response = (object) $response;
        return $response;
    }

    public function status_data() {
        return $this->getStatus($this->status);
    }

}
