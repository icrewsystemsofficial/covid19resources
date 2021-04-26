<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Twitter extends Model
{
    use HasFactory;


    protected $blacklisted_words = array(
        'modi', 'amitshah', 'bjp', 'hell', 'fuck', 'disaster', 'angry', 'Kumbh', 'Pakistan',
    );



    public const PENDING = '0';
    public const VERIFIED = '1';
    public const REFUTED = '2';
    public const SPAM = '3';
    public const INADEQUATE = '4';
    public const RETWEET = '5';
    public const SCREENED = '6';

    public static function getAllTweetStatus() {
        $status = array();

        $status[] = self::PENDING;
        $status[] = self::VERIFIED;
        $status[] = self::REFUTED;
        $status[] = self::SPAM;
        $status[] = self::INADEQUATE;
        $status[] = self::RETWEET;
        $status[] = self::SCREENED;

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
                $response['name'] = 'Retweet';
                $response['color'] = 'primary';
                $response['gradient'] = 'bg-gradient-primary';
                $response['icon'] = 'check';
            break;


            default:
                throw new Exception('Unknown status ID type provided');
            break;
        }

        $response = (object) $response;
        return $response;
    }

    public function blacklistedwords() : array {

        $words = config('app.blacklisted_words');
        $words = explode(',', $words);
        // return $this->blacklisted_words;
        return $words;
    }

    public function filterTweet() : array {

        $response_json = array();

        $haystack = strtolower($this->tweet);
        // $needle = $this->blacklisted_words;
        $needle = $this->blacklistedwords();
        $check = Str::contains($haystack, $needle);
        if($check){
            // echo "Contains blacklisted words";
            $words = Str::of($haystack)->explode(' ');
            $blacklisted_because_of = array();
            foreach($words as $word) {
                if(Str::contains($word, $needle)) {
                    $blacklisted_because_of[] = $word;
                }
            }

            $response = "BLACKLISTED Tweet #" . $this->id. " by @". $this->username ." - Because the tweet contains the following words : ";
            $i = 1;
            foreach($blacklisted_because_of as $bwords) {
                $response .= $i.'). '.$bwords;
                if($i != 1) {
                    // Add spaces to plurals.
                    $response .= '  ';
                }
                $i++;
            }

            $response_json['type'] = 'spam';

        } else {
            $response = $response = "Tweet #" . $this->id. " by @". $this->username ." - Screened";
            $response_json['type'] = 'ok';
            //So in controller, if($response != 'OK') BLACKLIST.
        }

        $response_json['message'] = $response;
        return $response_json;
    }



    public function status_data() {
        return $this->getStatus($this->status);
    }
}
