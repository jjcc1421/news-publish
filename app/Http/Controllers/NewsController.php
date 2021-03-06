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
use PDF;

class NewsController extends Controller
{

    public function index()
    {
        $user = Auth::User();
        $news = News::where('user_id', $user->id)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('news.index', ['user' => $user, 'news' => $news]);
    }

    public function home()
    {
        $news = News::orderBy('created_at', 'DESC')
            ->with('user')
            ->take(10)
            ->get();
        return view('index', ['news' => $news]);
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
            $destinationPath = 'uploads';
            $extension = Input::file('fileToUpload')->getClientOriginalExtension();
            $fileName = $image_name . '.' . $extension;
            Input::file('fileToUpload')->move($destinationPath, $fileName);
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

    public function addArticle()
    {
        return view('news.addNews');
    }

    public function readArticle($articleId)
    {
        $news = News::findOrFail($articleId);
        $user = User::findOrFail($news->user_id);
        return view('news.read_article', ['news' => $news, 'user' => $user]);
    }

    public function newsToPDF($articleId)
    {
        $news = News::findOrFail($articleId);
        $user = User::findOrFail($news->user_id);
        $pdf = PDF::loadView('pdf.pdf', ['news' => $news, 'user' => $user]);
        return $pdf->stream();
    }
}