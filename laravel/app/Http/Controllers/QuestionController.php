<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Auth;
use DB;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index','show']);
        $this->questionRepository = $questionRepository;
    }
    public function index()
    {
        $questions = $this->questionRepository->getQuestionFeed();
        return view('question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $topics = DB::table('topics')->pluck('name');
        return view('question.create',compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
        'title'=>'required|min:2|max:16',
            'body'=>'required|min:24',
            'topics'=>'required|max:4'

    ];
        $message=[
            'title.required'=>'标题不能为空',
            'title.min'=>'标题不能少于2个字符',
            'title.max'=>'标题不能多于16个字符',
            'body.required'=>'内容不能为空',
            'body.min'=>'内容不能少于24个字符',
             'topics.required'=>'标签不能为空',
            'topics.max' => '最多添加4个标签'
        ];


        $topics = $this->questionRepository->normalizeTopic($request->get('topics'));
        //dd($topics);
        $this->validate($request,$rules,$message);
        $data=[
            'title'=>$request->get('title'),
            'body'=>$request->get('body'),
            'user_id'=>Auth::id()
        ];
        $question = $this->questionRepository->create($data);
        $question->topics()->attach($topics);
        return redirect()->route('questions.show',[$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$question = Questions::find($id);
        $question = $this->questionRepository->selectByIdWithTopics($id);
        return view('question.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->getQuestionById($id);
        if(Auth::user()->owns($question)){
            return view('question.edit',compact('question'));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'title'=>'required|min:2|max:16',
            'body'=>'required|min:24',
            'topics'=>'required|max:4'

        ];
        $message=[
            'title.required'=>'标题不能为空',
            'title.min'=>'标题不能少于2个字符',
            'title.max'=>'标题不能多于16个字符',
            'body.required'=>'内容不能为空',
            'body.min'=>'内容不能少于24个字符',
            'topics.required'=>'标签不能为空',
            'topics.max' => '最多添加4个标签'
        ];
        $this->validate($request,$rules,$message);
        $topics = $this->questionRepository->normalizeTopic($request->get('topics'));
        $question = $this->questionRepository->getQuestionById($id);
        $question->update([
           'title'=>$request->get('title'),
            'body'=>$request->get('body'),
        ]);
        $question->topics()->sync($topics);
        return redirect()->route('questions.show',[$question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->getQuestionById($id);
        if (Auth::user()->owns($question)) {
            $question->delete();
            return redirect('/questions');
        }
        abort(403, 'Forbidden');
    }

   
}
