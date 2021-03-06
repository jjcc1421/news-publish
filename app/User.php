<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function news()
    {
        return $this->hasMany('App\News');
    }

    public function hasArticle($articleID)
    {
        $article = News::where('user_id', $this->id)->first();
        if ($article)
            return true;
        return false;
    }

    public function isVerified()
    {
        return $this->verified == 1;
    }
}
