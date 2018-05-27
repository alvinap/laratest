@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <hr />
                    CRUD Sample - <a href="{{ route('blog') }}" class="btn btn-info">Blog</a>
                    <hr />
                    REST API Sample - 
                    <a href="{{ route('api/blog') }}" class="btn btn-success" target="_blank">GET All</a>
                    <a href="#form" class="btn btn-primary" data-toggle="modal" data-m_title="Create">CREATE</a>
                    <a href="#get" class="btn btn-default" data-toggle="modal">GET by Param</a>
                    <a href="#form" class="btn btn-warning" data-toggle="modal" data-m_title="Update">UPDATE by Param</a>
                    <a href="#delete" class="btn btn-danger" data-toggle="modal">DELETE by Param</a>
                    <hr />
                    CONVERT FILE Sample - 
                    <a href="{{ route('convert') }}" class="btn btn-primary">File .txt to asc</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal HTML FORM Create / Update-->
<div class="modal fade" id="form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            {{ Form::open(['route' => 'api/blog/post', 'method' => 'post']) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Form <span id="m_title"></span></h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group" id="input_id">
                            {{ Form::number('id', '', ['class' => 'form-control', 'placeholder' => 'ID']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::textarea('text', '', ['class' => 'form-control', 'placeholder' => 'Text', 'required' => 'required', 'size' => '30x5']) }}
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    {{ Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) }}
                    {{ Form::button('Cancel', ['class' => 'btn btn-sm btn-default', 'data-dismiss' => 'modal']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Modal HTML FORM Get -->
<div class="modal fade" id="get" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            {{ Form::open(['route' => 'api/blog/get', 'method' => 'post']) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >Form Get by Param</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            {{ Form::number('id', '', ['class' => 'form-control', 'placeholder' => 'ID Blog', 'required' => 'required']) }}
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    {{ Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) }}
                    {{ Form::button('Cancel', ['class' => 'btn btn-sm btn-default', 'data-dismiss' => 'modal']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Modal HTML FORM Delete -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            {{ Form::open(['route' => 'api/blog/delete', 'method' => 'post']) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >Form Delete</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            {{ Form::number('id', '', ['class' => 'form-control', 'placeholder' => 'ID Blog', 'required' => 'required']) }}
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    {{ Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) }}
                    {{ Form::button('Cancel', ['class' => 'btn btn-sm btn-default', 'data-dismiss' => 'modal']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Modal JS HTML-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#form').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget)
            var m_title = div.data('m_title')
            var modal = $(this)
            modal.find('#m_title').text(m_title)
            if (m_title == 'Create') {
                modal.find('#input_id').css('display', 'none');
            } else {
                modal.find('#input_id').css('display', '');
            }
        })
    })
</script>
@endsection
