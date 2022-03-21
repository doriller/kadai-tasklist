<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザの取得
            $user = \Auth::user();
            // ユーザのタスク一覧を取得
            $tasks = $user->tasks()->paginate(10);
            
            $data = [
                'user'  => $user,
                'tasks' => $tasks,
            ];
        }

        // タスク一覧ビューで表示
        return view('tasks.index', [
            'data' => $data,
        ]);
        //return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     // getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task = new Task;

        // タスク一覧ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'status'  => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        // 認証済みユーザの投稿として作成
        $request->user()->tasks()->create([
            'status'  => $request->status,
            'content' => $request->content,
        ]);

        // トップへリダイレクト
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // getでtasks/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        // 認証済みユーザの取得
        $user = \Auth::user();
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);

        // 認証済みユーザがそのタスクの所有者である場合はタスク詳細ビューで表示
        if (\Auth::id() === $task->user_id) {
            $data = [
                'user' => $user,
                'task' => $task,
            ];
            return view('tasks.show', [
                'data' => $data,
            ]);
        } else {
            // トップへリダイレク
            return redirect('/');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // getでtasks/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        // 認証済みユーザがそのタスクの所有者である場合はタスク編集ビューで表示
        if (\Auth::id() === $task->user_id) {
            return view('tasks.edit', [
                'task' => $task,
            ]);
        } else {
            // トップへリダイレクト
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // putまたはpatchでtasks/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'status'  => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);

        // 認証済みユーザがそのタスクの所有者である場合はタスクを更新
        if (\Auth::id() === $task->user_id) {
            $task->status = $request->status;
            $task->content = $request->content;
            $task->save();
        }
        
        // トップへリダイレクト
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // deleteでtasks/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);

        // 認証済みユーザがそのタスクの所有者である場合はタスクを削除
        if (\Auth::id() === $task->user_id) {
            // タスクの削除
            $task->delete();
        }

        // トップへリダイレクト
        return redirect('/');
    }
}
