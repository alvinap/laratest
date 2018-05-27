@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Blog
                    <a href="{{ route('home') }}" class="pull-right">Back to Dashboard</a>
                </div>

                <div class="panel-body">
                    This is blog page!
                    <a href="#form" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-m_title="Add">Add New Blog</a>
                    <hr />
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TITLE</th>
                                <th>TEXT</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blog as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->text }}</td>
                                    <td>
                                        <a href="#form" class="btn btn-sm btn-warning" data-toggle="modal" data-m_title="Update" data-id="{{ $value->id }}" data-title="{{ $value->title }}" data-text="{{ $value->text }}">
                                            Update
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#delete" class="btn btn-sm btn-danger" data-toggle="modal" data-id="{{ $value->id }}">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal HTML FORM -->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            {{ Form::open(['route' => 'api/blog/get', 'method' => 'post']) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Form <span id="m_title"></span></h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            {{ Form::text('title', '', ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title', 'required' => 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::textarea('text', '', ['class' => 'form-control', 'id' => 'text', 'placeholder' => 'Text', 'required' => 'required', 'size' => '30x5']) }}
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    {{ Form::hidden('id', null, ['id' => 'id_form']) }}
                    {{ Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) }}
                    {{ Form::button('Cancel', ['class' => 'btn btn-sm btn-default', 'data-dismiss' => 'modal']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            {{ Form::open(['route' => 'blog/delete', 'method' => 'post']) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this data?
                </div>
                <div class="modal-footer">
                    {{ Form::hidden('id', null, ['id' => 'id_delete']) }}
                    {{ Form::submit('Yes', ['class' => 'btn btn-sm btn-danger']) }}
                    {{ Form::button('Cancel', ['class' => 'btn btn-sm btn-default', 'data-dismiss' => 'modal']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Modal HTML ALERT-->
<div class="modal fade" id="success" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 0 !important;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color: green;">Success</h4>
            </div>
            <div class="modal-body">
                <span id="success_message"></span>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="error" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color: red;">Failed</h4>
            </div>
            <div class="modal-body">
                <span id="error_message"></span>
            </div>
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
            var id = div.data('id')
            var title = div.data('title')
            var text = div.data('text')
            var modal = $(this)
            modal.find('#m_title').text(m_title)
            modal.find('#id_form').val(id)
            modal.find('#title').val(title)
            modal.find('#text').val(text)
        })
        $('#delete').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget)
            var id = div.data('id')
            var modal = $(this)
            modal.find('#id_delete').val(id)
        })
    })
</script>
<!-- Modal JS ALERT-->
@if(Session::has('post'))
    @if(Session::get('post') == 'success')
        <script type="text/javascript">
            $(document).ready(function() {
                var flashdata_message = '{{ Session::get("message") }}'
                $('#success_message').text(flashdata_message)
                $('#success').modal('show')
                setTimeout(function(){
                    $('#success').modal('hide')
                }, 2000)
            })
        </script>
    @else
        <script type="text/javascript">
            $(document).ready(function() {
                var flashdata_message = '{{ Session::get("message") }}'
                $('#error_message').text(flashdata_message)
                $('#error').modal('show')
                setTimeout(function(){
                    $('#error').modal('hide')
                }, 2000)
            })
        </script>
    @endif
@endif
@endsection
