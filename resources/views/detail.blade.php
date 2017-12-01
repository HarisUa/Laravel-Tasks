@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
  tinymce.init({
    selector : "textarea",
    plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
    toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
  }); 
</script>
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
                    <input type="submit" name='submit' class="btn btn-warning btn-block" value = "Save"/>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
