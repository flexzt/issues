@extends('index')

@section('content')
    <div class="main-content">
        <issue>
            @if(isset($issueCreated))
                <h2>Stored issue</h2>
            @else
                <h2>Create issue</h2>
            @endif

            <div class="col-md-8 order-md-1">
                <h3 class="mb-3"></h3>
                @include('Forms.create',['action'=>'/issue/create/'])
            </div>
        </issue>
    </div><!-- main-content -->

@endsection

@section('right_sidebar')
    @if(isset($issueCreated))
        <div class="alert alert-success" role="alert">
            <a href="/issue/list/">Issue has been successfully created.</a>
        </div>
    @endif
@endsection

