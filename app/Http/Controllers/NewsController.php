<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 29/05/2016
 * Time: 10:23 AM
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\User;
use App\News;

class NewsController extends Controller
{

    public function index()
    {
        $user = Auth::User();
        $news = News::where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('news.index', ['user' => $user, 'news' => $news]);
    }

    public function save()
    {
        $news = new News;
        $news->tittle = Input::get('tittle');
        $news->photo_url = Input::get('photo_url');
        $news->text = Input::get('text');
        $news->user_id = Auth::user()->id;

        $news->save();
    }

    public function addNews()
    {
        return view('news.addNews');
    }
}