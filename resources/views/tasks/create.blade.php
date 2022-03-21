@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <h1>タスク新規作成ページ</h1>
    
        <div class="row">
            <div class="col-6">
                {!! Form::model($task, ['route' => 'tasks.store']) !!}
                    <div class="form-group">
                        {!! Form::label('status', 'ステータス:') !!}
                        {!! Form::text('status', null, ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('content', 'タスク:') !!}
                        {!! Form::text('content', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
                    </div>
    
                    {!! Form::submit('作成', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @else
        {{-- 未認証 --}}
        @include('auth.not_authenticated')
        
    @endif
@endsection
