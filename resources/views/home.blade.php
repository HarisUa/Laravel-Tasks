@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(!$notes->isEmpty())
            @foreach($notes as $note)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
                            <div class="post" data-postid="{{ $note->id }}">
                                {!! $note->title !!} 

                                @if(!$all)
                                    <a class="btn btn-sm btn-danger btn-right pull-right" href="{{ route('note.del', ['id' => $note->id]) }}">Delete</a>
                                    <a class="btn btn-sm btn-info btn-right pull-right" href="{{ route('note.edit', ['id' => $note->id]) }}">Edit</a>
                                @else

                                    <a class="btn btn-sm btn-{{ Auth::user()->likes()->where('post_id', $note->id)->first() ? 'danger' : 'success' }} btn-right pull-right like" href="{{ route('note.like', ['id' => $note->id]) }}">
                                        {{ App\Likes::where('post_id', $note->id)->count() }}
                                        likes |
                                        {{ Auth::user()->likes()->where('post_id', $note->id)->first() ? 'Dislike' : 'Like' }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="panel-body">
                            {!! $note->text !!}
                            <p class="text-right">Author: {{ App\User::find($note->user_id)->name }}</p>
                            <p class="text-right">Engineer: {{ App\User::find($note->for_id)->name }}</p>
                            <p class="text-right">Deadline: {{ $note->deadline }}</p>
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        @if(!$all) 
                            You have no any notes <a href="{{ route('note') }}">Add Notes</a>
                        @else
                            There are no notes! Be FIRST! <a href="{{ route('note') }}">Add Notes</a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
