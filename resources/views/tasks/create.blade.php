@extends("layouts.app")
@section("content")
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                Add New Task
            </div>
        </div>
        @include('tasks.form')
    </div>
@endsection
