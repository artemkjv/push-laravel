@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Application</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('app.index') }}">Applications</a></li>
                        <li class="breadcrumb-item active">Application</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form class="row" method="post" action="{{route('app.testPushUsersHandle', ['id' => $app->id])}}">
                @method('PATCH')
                @csrf
                <div class="col-xl-6 col-sm-12">
                    <div class="form-group">
                        <label for="pushUsers">Push Users</label>
{{--                        <select name="custom_pushes[]" class="tokenize2" id="customPushes" multiple aria-label="Custom Pushes">--}}
                            @foreach($pushUsers as $pushUser)
{{--                                <option @if($chosenCustomPushes->contains('id', $customPush->id)) selected @endif value="{{ $customPush->id }}">{{ $customPush->name }}</option>--}}
                            @endforeach
{{--                        </select>--}}
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    <script>
        let entities = $('.tokenize2')
        entities.tokenize2({
            dataSource: 'select',
        })
    </script>
@endsection
