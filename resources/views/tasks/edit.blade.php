@extends("layouts.app")
@section("content")
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                Edit Task
            </div>
        </div>
        @include('tasks.form', $task)
    </div>
@endsection
