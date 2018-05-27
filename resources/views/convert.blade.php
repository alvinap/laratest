@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Convert
                    <a href="{{ route('home') }}" class="pull-right">Back to Dashboard</a>
                </div>

                <div class="panel-body">
                    {{ Form::open(['route' => 'convert/post', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                        <fieldset>
                            <div class="form-group">
                                {{ Form::file('file', ['required' => 'required']) }}
                            </div>
                        </fieldset>
                        {{ Form::submit('Process', ['class' => 'btn btn-sm btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
