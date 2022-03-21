@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <?php //dd(Auth::user()); ?>
        <?php //dd($data['tasks']); ?>
        <?php //dd($tasks); ?>
        <h1>タスク一覧</h1>

        @if (isset($data['tasks']) && count($data['tasks']) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ステータス</th>
                        <th>タスク</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['tasks'] as $task)
                    <?php //dd($task); ?>
                    <tr>
                        <td>{!! link_to_route('tasks.show', $task->id, ['task' =>$task->id]) !!}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->content }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        {{-- タスク作成ページへのリンク --}}
        {!! link_to_route('tasks.create', '新規タスクの作成', [], ['class' => 'btn btn-primary']) !!}
    @else
        {{-- 未認証 --}}
        @include('auth.not_authenticated')
        
    @endif
@endsection
