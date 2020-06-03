@extends('index')

@section('content')
    <div class="main-content">
        @if ($issues)
            <div class="container">

                <table id="listIssue" class="table table-striped table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="th-sm">Id</th>
                        <th class="th-sm">Username</th>
                        <th class="th-sm">Email</th>
                        <th class="th-sm">Comments</th>
                        <th class="th-sm">Status</th>
                        @if ($isLoggedIn)
                            <th class="th-sm">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($issues as $issue)
                        <tr>
                            <td>
                                <a href="/issue/show/{{$issue->id}}/">{{ $issue->id }}</a>
                            </td>
                            <td>
                                <span>{{$issue->username}}</span>
                            </td>
                            <td>
                                <span>{{$issue->email}}</span>
                            </td>
                            <td>
                                {{{ str_limit($issue->comments, $limit = 250, $end = '...') }}}
                            </td>
                            <td>
                                {{$issue->statusString}}
                            </td>
                            @if ($isLoggedIn)
                                <td>
                                    <a href="/issue/edit/{{$issue->id}}/"
                                       class="btn btn-default btn-sm btn-category">Edit</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <issue>
                <div class="post-content">
                    <p>No items</p>
                </div>
            </issue>
        @endif
    </div>

@endsection

@section('right_sidebar')
    <a class="btn btn-primary" href="/issue/create/">Create the new issue</a>
@endsection
