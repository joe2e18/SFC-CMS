<?php

namespace App\Http\Controllers;

use App\Games;
use App\Level;
use App\News;
use App\Roster;
use App\Sport;
use App\Year;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news.show', compact('news'));
    }

    public function show($sport_id)
    {

        $type = Sport::where('id', $sport_id)->first();
        $sports = Sport::lists('name', 'id');
        $levelcreate = Level::lists('name', 'id');
        $games = Games::lists('game_date', 'id');
        $years = Year::lists('name', 'id');
        $rosters = Roster::lists('first_name', 'id');
        $id_sport = $sport_id;
        //$news = News::where('sport_id', '=', $sport_id)->orderBy('news_date', 'DESC')->get();
        //dd($news->first()->sports()->where('id', '=', 1)->first()); show news where sport_id is 1
        $news = Sport::where('id', '=', $sport_id)->first()->news()->orderBy('news_date', 'DESC')->get();

        return view('news.show', compact('news','type', 'sports', 'id_sport', 'rosters', 'levelcreate', 'years', 'games'));
    }

    public function update($sport_id)
    {
        $file = Input::all();


        $rules = array(
            'title' => 'required',
            'content' => 'required',
            'news_date' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());

            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            if ($file['news_invisible_action'] == 'add') {
                if (Input::file('image') != null) {
                    $destinationPath = 'uploads/news'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                    //create news
                    $news = News::create(array('title' => $file['title'], 'image' => $fileName,  'news_date' => $file['news_date'], 'content' => $file['content'], ));

                } else {
                    //create news
                    $news = News::create(array('title' => $file['title'],  'news_date' => $file['news_date'],  'content' => $file['content']));

                }

                //add sports tags
                if (isset($file['sport_id']))
                {
                    $news->sports()->attach(array_values($file['sport_id']));
                }
                //add levels tags
                if (isset($file['level_id']))
                {
                    $news->levels()->attach(array_values($file['level_id']));
                }
                //add rosters tags
                if (isset($file['roster_id']))
                {
                    $news->rosters()->attach(array_values($file['roster_id']));
                }
                //add games tags
                if (isset($file['game_id']))
                {
                    $news->games()->attach(array_values($file['game_id']));
                }
                Session::flash('success', 'Created successfully');
                return Redirect::back();
            }
            else
            {
                if (Input::file('image') != null) {
                    $destinationPath = 'uploads/news'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                    //update
                    News::where('id', '=', $file['news_invisible_id'])->first()->update(['title' => $file['title'], 'image' => $fileName, 'news_date' => $file['news_date'],  'content' => $file['content']]);
                } else {
                    //update
                    News::where('id', '=', $file['news_invisible_id'])->first()->update(['title' => $file['title'],  'news_date' => $file['news_date'], 'content' => $file['content']]);
                }
                $news = News::where('id', '=', $file['news_invisible_id'])->first();

                //add sports tags
                if (isset($file['sport_id']))
                {
                    $news->sports()->sync(array_values($file['sport_id']));
                }
                //add levels tags
                if (isset($file['level_id']))
                {
                    $news->levels()->sync(array_values($file['level_id']));
                }
                //add rosters tags
                if (isset($file['roster_id']))
                {
                    $news->rosters()->sync(array_values($file['roster_id']));
                }
                //add games tags
                if (isset($file['game_id']))
                {
                    $news->games()->sync(array_values($file['game_id']));
                }
                Session::flash('success', 'Updated successfully');
                return Redirect::back();
            }
        }
    }


    public function destroy($id)
    {
        $news = News::findOrFail($id);


        $news->delete();



        Session::flash('flash_message_s', 'News successfully deleted!');


        return redirect()->back();
    }
}
