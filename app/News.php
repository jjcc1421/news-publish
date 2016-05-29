<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 29/05/2016
 * Time: 10:21 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function user_id()
    {
        return $this->hasOne('App\User');
    }
}