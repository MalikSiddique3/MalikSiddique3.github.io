<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $questions = question::all();
        return view('home',['questions' => $questions]);
    }
    public function add()
    {
        return view('add');
    }
    public function edit($id)
    {
        $question = question::where('id',$id)->first();
        return view('edit',['question' => $question]);
    }
    public function update($id,Request $request)
    {
        $question = question::find($id);
        $question->questions = $request->question;
        $question->update();
        return redirect('/admin');
    }
    public function delete($id)
    {
        question::where('id',$id)->delete();
        return redirect('/admin');
    }
    public function store(Request $request)
    {
        $question = new question();
        $question->questions = $request->question;
        $question->save();
        return redirect('/admin');
    }
}
