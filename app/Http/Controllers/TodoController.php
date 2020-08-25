<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;  // 追記

class TodoController extends Controller
{
     // ここから追記
    private $todo;
    public function __construct(Todo $instanceClass)
    //オブジェクトを使用する前に必要な初期化を行うことができる
    {
        $this->middleware('auth');  // 追記
        $this->todo = $instanceClass;
    }
     // ここまで追記
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->todo->getByUserId(Auth::id());
        // dd($todos);   //インスタンス化したCollectionクラス
        // todos tableから全てのレコードをコレクションラッピングして返す
        // dd(compact('todos'));
        return view('todo.index', ['todolist' => $todos]);
        // viewメソッドの第二引数は必ず配列
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
        // Views ディレクトリーを参照している
        // →Views ディレクトリーの中のtodoディレクトリの中のcreate　ファイルを表示する
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);  // インスタンス化したRequest
        // ブラウザを通してユーザーから送られる情報を全て含むオブジェクト
        $input = $request->all();
        // dd($input);  //連想配列(tokenとtitle)が入っている
        // dd($this->todo->fill($input));
        $input['user_id'] = Auth::id();  // 追記
        $this->todo->fill($input)->save();
        return redirect()->to('todo.index');
        // redirectがGET送信
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = $this->todo->find($id);
        // findは($id)と合致するidカラムを見つけ出しレコードを取得
        // dd($todo);
        // dd(view('todo.edit', compact('todo')));
        return view('todo.edit', compact('todo'));
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
        // dd($id);
        // dd($request);
        // dd( $request->all());  //method,token,title連想配列
        $input = $request->all();
        // dd($this->todo->find($id));
        // dd($this->todo->find($id)->fill($input));
        $this->todo->find($id)->fill($input)->save();
        return redirect()->to('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($this->todo->find($id)->delete());
        $this->todo->find($id)->delete();
        return redirect()->to('todo.index');
    }
}
