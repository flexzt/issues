@extends('index')

@section('content')
    <div class="main-content">
        <issue>
            <h2 class="page-title">{{ $title }}</h2>
            <div class="form-body">
                @include('Forms.edit', ['action'=>'/issue/edit/'.$issueId.'/'])
            </div>
        </issue>
    </div>

@endsection

@section('right_sidebar')
    <a class="btn btn-primary" href="/issue/list/" role="button">Show list</a>
@endsection
