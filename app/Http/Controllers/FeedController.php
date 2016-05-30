<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 30/05/2016
 * Time: 12:01 PM
 */

namespace App\Http\Controllers;

use Feed;
use App\News;
use Illuminate\Support\Facades\App;

class FeedController extends Controller
{
    public function feed()
    {
        // create new feed
        $feed = App::make("feed");

        // multiple feeds are supported
        // if you are using caching you should set different cache keys for your feeds

        // cache the feed for 60 minutes (second parameter is optional)
        $feed->setCache(60, 'laravelFeedKey');

        // check if there is cached feed and build new only if is not
        if (!$feed->isCached()) {
            // creating rss feed with our most recent 20 posts
            $news = News::with('user')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            // set your feed's title, description, link, pubdate and language
            $feed->title = 'News portal';
            $feed->description = 'The top portal of news';
            $feed->logo = '';
            $feed->link = url('feed');
            $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
            $feed->pubdate = $news[0]->created_at;
            $feed->lang = 'en';
            $feed->setShortening(true); // true or false
            $feed->setTextLimit(100); // maximum length of description text

            foreach ($news as $article) {
                // set item's title, author, url, pubdate, description, content, enclosure (optional)*
                $feed->add(
                    $article->title,
                    $article->user->name,
                    route('path_to_read_article', [$article->id]),
                    $article->created_at,
                    $article->title,
                    $article->text);
            }

        }

        // first param is the feed format
        // optional: second param is cache duration (value of 0 turns off caching)
        // optional: you can set custom cache key with 3rd param as string
        return $feed->render('atom');
    }
}