<?php

namespace App\Models;

use Exception;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'body',
        'phone',
        'url',
        'author_id',
        'verified',
        'verified_by',
    ];


    public const PENDING = '0';
    public const VERIFIED = '1';
    public const REFUTED = '2';
    public const SPAM = '3';
    public const INADEQUATE = '4';
    // public const OLD = '5';
    // public const SCREENED = '6';

    public static function getAllResourceStatus() {
        $status = array();

        $status[] = self::PENDING;
        $status[] = self::VERIFIED;
        $status[] = self::REFUTED;
        $status[] = self::SPAM;
        $status[] = self::INADEQUATE;
        // $status[] = self::RETWEET;
        // $status[] = self::SCREENED;

        foreach($status as $status) {

        }
        return $status;
    }
    /*
        0 - Pending
        1 - Verified
        2 - Refuted
        3 - Spam
        4 - Inadequate Info
        5 - Retweet
        6 - Screened
    */
    public function getStatus($status = '') {

        if($status == '') {
            $status = $this->verified;
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

            // case 5:
            //     $response['name'] = 'Retweet';
            //     $response['color'] = 'primary';
            //     $response['gradient'] = 'bg-gradient-primary';
            //     $response['icon'] = 'check';
            // break;


            default:
                throw new Exception('Unknown resource ID type provided');
            break;
        }

        $response = (object) $response;
        return $response;
    }

    public function category_data() {
        return $this->hasOne(Category::class, 'id', 'category');
    }

    public function author_data() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function verified_by_data() {
        return $this->hasOne(User::class, 'id', 'verified_by');
    }

}
