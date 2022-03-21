@extends('layouts.app')

@section('content')
    <?php //dd($data['task']); ?>
    @if (Auth::check())
        <h1>ID = {{ $data['task']->id }} のタスク詳細ページ</h1>
    
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $data['task']->id }}</td>
            </tr>
            <tr>
                <th>ステータス</th>
                <td>{{ $data['task']->status }}</td>
            </tr>
            <tr>
                <th>タスク</th>
                <td>{{ $data['task']->content }}</td>
            </tr>
        </table>
        
        @if (Auth::id() === $data['task']->user_id)
            {{-- タスク編集ページへのリンク --}}
            {!! link_to_route('tasks.edit', 'このタスクを編集', ['task' => $data['task']->id], ['class' => 'btn btn-light']) !!}
            {{-- タスク削除フォーム --}}
            {!! Form::model($data['task'], ['route' => ['tasks.destroy', $data['task']->id], 'method' => 'delete']) !!}
                {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        @else
            {{-- タスク編集ページへのリンク --}}
            {!! link_to_route('tasks.edit', 'このタスクを編集', ['task' => $data['task']->id], ['class' => 'btn btn-light', 'disabled' => 'disabled']) !!}
            {{-- タスク削除フォーム --}}
            {!! Form::model($data['task'], ['route' => ['tasks.destroy', $data['task']->id], 'method' => 'delete']) !!}
                {!! Form::submit('削除', ['class' => 'btn btn-danger', 'disabled' => 'disabled']) !!}
            {!! Form::close() !!}
        @endif
    @else
        {{-- 未認証 --}}
        @include('auth.not_authenticated')
        
    @endif
@endsection
