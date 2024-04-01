@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-10 table-container">
            <div class="card-container">
                <div class="row">
                    @foreach ($topUsers as $user)
                        <div class="col-3 mt-2" style="width: 200px; height:200px">
                            <div class="card">
                                <div class="card-header">
                                    {{ $user->name }}
                                </div>
                                <div class="card-body">
                                    <p>Number of Tasks: {{ $user->tasks_count }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
