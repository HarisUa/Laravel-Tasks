@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(!$tasks->isEmpty())
            @foreach($tasks as $task)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
                            {!! $task->title !!} 
                            <a class="btn btn-sm btn-danger btn-right pull-right" href="{{ route('note.del', ['id' => $note->id]) }}">Delete</a>
                            <a class="btn btn-sm btn-info btn-right pull-right" href="{{ route('note.edit', ['id' => $note->id]) }}">Edit</a>
                        </div>

                        <div class="panel-body">
                            {!! $task->text !!}
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        You have no any tasks <a href="{{ route('note') }}">Add Tasks</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
