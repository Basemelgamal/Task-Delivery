@extends('layouts.app')
@section('content')
<!-- left column -->
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
            @if($method == 'POST')
                {!! Form::open(['url' => $action, 'method' => $method, 'enctype'=>'multipart/form-data', 'files' => true]) !!}
            @elseif ($method == 'PUT')
                {!! Form::model($task, ['url' => [$action], 'method'=>$method , 'enctype'=>'multipart/form-data', 'files' => true]) !!}
            @endif
            <div class="card-body">


                <div class="form-group">
                    <label for="assign_by">Assign By (Admin)</label>
                    {!! Form::select('assign_by_id', $admins, old('assign_by_id'), ["class"=>"form-control", "id" => "assign_by_id", "searchable" => true]) !!}
                    @error('assign_by_id')
                        <small class="aleart text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="assign_to">Assign To</label>
                    {!! Form::select('assign_to_id', [], old('assign_to_id'), ["class"=>"form-control select2", "id" => "assign_to_id", "searchable" => true]) !!}
                    @error('assign_to_id')
                        <small class="aleart text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    {!! Form::text('title', old('title'), ["id" => "title", "class"=>"form-control", "placeholder" => 'title' ]) !!}
                    @error('title')
                        <small class="aleart text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    {!! Form::text('description', old('description'), ["id" => "description", "class"=>"form-control", "placeholder" => 'Description' ]) !!}
                    @error('description')
                        <small class="aleart text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    @if($method == 'POST')
                        Save
                    @elseif ($method == 'PUT')
                        Update
                    @endif
                </button>
            </div>
        </form>
    </div>
    <!-- /.card -->

</div>
@endsection


<!-- Scripts Section -->
@section('js')
<script>
    $(document).ready(function() {
        $('#assign_by_id').select2();
        $('#assign_to_id').select2({
            ajax: {
                url: '{{ route("get.users") }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data.data.map(function(user) {
                            return {
                                id: user.id,
                                text: user.name
                            };
                        }),
                        pagination: {
                            more: data.next_page_url ? true : false
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Select a user',
            minimumInputLength: 1,
            minimumResultsForSearch: -1,
            escapeMarkup: function(markup) {
                return markup;
            },
            templateResult: function(user) {
                return user.text;
            },
            templateSelection: function(user) {
                return user.text;
            },
            dropdownAutoWidth: true
        });


        $('#assign_to_id').trigger('select2:open');
    });
</script>
@endsection
