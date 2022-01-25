@extends('layouts.layout')
@section('content')
    @include('app.components.topbar')
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
            <form method="post" action="{{route('app.pushUsers.handle', ['id' => $app->id])}}">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="pushUsers">Test Push Users</label>
                            <select name="pushUsers[]" class="tokenize2" id="pushUsers" multiple aria-label="Push Users">
                                @foreach($pushUsers as $pushUser)
                                    <option @if($pushUser->is_test) selected @endif value="{{ $pushUser->id }}">{{ $pushUser->uuid }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
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
