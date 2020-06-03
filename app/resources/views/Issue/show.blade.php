@extends('index')

@section('content')
    <div class="main-content">
        <article>
            <h2 class="page-title">Stored issue</h2>
            <div class="form-body">
                @include('Forms.create',['action'=>'/issue/create/'])
            </div>
        </article>
    </div>
@endsection

@section('right_sidebar')
    <a class="btn btn-primary" href="/issue/list/" role="button">Show list</a>
@endsection
