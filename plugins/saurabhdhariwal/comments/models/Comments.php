<?php 

namespace SaurabhDhariwal\Comments\Models;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Model;

/**
 * Model
 */
class Comments extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     *
     */
    const STATUS = ['1' => 'Approved', '2' => 'Pending', '3' => 'Spam'];
    /**
     *
     */
    const STATUS_APPROVED = 1;

    /*
     * Validation
     */
    /**
     * @var array
     */
    public $rules = [
            //'author' => 'alpha|min:2|max:25',
            //'email' => 'email',
            'content' => 'required|min:2|max:500'
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
//    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'saurabhdhariwal_comments_posts';


    /**
     * @var array
     */
    public $belongsTo = [
       'user' => ['RainLab\User\Models\User']
   ];

    /**
     * @param null $keyValue
     * @return array
     */
    public function getStatusOptions($keyValue = null)
    {
        return self::STATUS;
    }


    /**
     * @return mixed
     */
    public function getStatusAdminAttribute()
    {
        return self::STATUS[$this->status];
    }

    /**
     * @return string
     */
    public function getAvatarAttribute()
    {
        return "<img src='http://www.gravatar.com/avatar/" . md5($this->author.$this->id) . "/?d=wavatar&r=pg'/>";
    }

    /**
     * @return mixed
     */
    public function getNameAttribute()
    {
        if($this->author != ""){
            return $this->author;
        } elseif ($this->user) {
            return $this->user->name;
        }    
    }
    /**
     * @return string
     */
    public function getContentAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}