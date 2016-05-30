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
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Validator;

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

        //File validation
        $file = array('image' => Input::file('fileToUpload'));
        $rules = array('image' => 'required|image',);
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            Flash::error('Invalid image file');
            return back()->withInput();
        }

        if (Input::file('fileToUpload')->isValid()) {
            $mytime = Carbon::now();
            $image_name = rand(11111, 99999) . '_' . $mytime->day . $mytime->month . $mytime->year;
            $destinationPath = 'uploads'; // upload path
            $extension = Input::file('fileToUpload')->getClientOriginalExtension(); // getting image extension
            $fileName = $image_name . '.' . $extension; // renameing image
            Input::file('fileToUpload')->move($destinationPath, $fileName); // uploading file to given path
            // sending back with message

        } else {
            Flash::error('Invalid image file');
            return back()->withInput();
        }

        $news = new News;
        $news->tittle = Input::get('tittle');
        $news->text = Input::get('text');
        $news->user_id = Auth::user()->id;
        $news->photo_url = "/" . $destinationPath . "/" . $fileName;
        $news->save();
        Flash::success('New article was published!');
        return redirect()->route('path_to_news');
    }

    public function delete($articleId)
    {
        if (Auth::User()->hasArticle($articleId)) {
            Flash::success('Article deleted!');
            $article = News::findOrFail($articleId);
            $article->delete();
        } else {
            Flash::error('Can not delete article');
        }
        return redirect()->route('path_to_news');
    }

    public function deleteArticle($articleId)
    {
        return $this->delete($articleId);//TODO Check if this is a good practice
    }

    private function uploadPostImage()
    {
        $destinationPath = '/public/post/'; // upload path
        $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
    }

    public function addNews()
    {
        return view('news.addNews');
    }
}