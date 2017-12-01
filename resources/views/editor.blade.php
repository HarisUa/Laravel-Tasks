@extends('layouts.edit')

@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    @if(empty($list))
                        Add {{ $type }}
                        {{ $datetime }}
                    @else
                        Edit {{ $type }}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            @if(empty($list))
                <form method="post" action='{{ route($submit) }}'>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <textarea name='text' class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sel1">Select engineer:</label>
                        <select class="form-control" name="for">
                            @foreach($users as $user) {
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group date">
                        <label for="sel1">Select deadline:</label>
                        <input type="text" class="form-control" id="datepicker" name="date" placeholder="MM/DD/YYYY">
                    </div>
                    <input type="submit" name='submit' class="btn btn-success btn-block" value = "Publish"/>
                </form>
            @else
                <form method="post" action='{{ route($submit) }}'>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $list->id }}">
                    <div class="form-group">
                        <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="{{ $list->title }}" />
                    </div>
                    <div class="form-group">
                        <textarea name='text' class="form-control">{{ $list->text }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="sel1">Select engineer:</label>
                        <select class="form-control" id="sel1" name="for">
                            @foreach($users as $user)
                                @if($user->id == $list->for_id)
                                    <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group date">
                        <label for="sel1">Select deadline:</label>
                        <input type="text" class="form-control" id="datepicker" name="date" placeholder="MM/DD/YYYY" value="{{ $deadline }}" />
                    </div>
                    <input type="submit" name='submit' class="btn btn-warning btn-block" value = "Save"/>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
