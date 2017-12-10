@extends('layouts.admin')

@section('title', 'Comments')

@section('content')
    <div class="page-header">

        <h1>Comments</h1>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    @if(Comments::pendingComments() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Comment</th>
                                <th>User</th>
                                <th>Created at</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                @foreach($post->pendingComments as $comment)
                                <tr>
                                    <td>
                                        {{ $comment->content }}
                                    </td>
                                    <td>{{ $comment->user->email }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}</td>
                                    <td>
                                        
                                        <a href="{{ route('admin.comments.update', $comment->id) }}" class="btn btn-default" data-method="put" data-token="{{ csrf_token() }}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            Approve
                                        </a>
                                       
                                        <a href="{{ route('admin.comments.destroy', $comment->id) }}" class="btn btn-danger action_confirm" data-method="delete" data-token="{{ csrf_token() }}">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    {{ 'No Pending Comments!' }}
                    @endif
                </div>
               
            </div>
        </div>

    </div>
    

@stop
