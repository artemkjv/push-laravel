@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Moderator</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Settings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('moderator.index') }}">Moderators</a></li>
                        <li class="breadcrumb-item active">Edit Moderator</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" method="post" action="{{ route('moderator.apps.handle', ['id' => $moderator->id]) }}">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="apps">Applications</label>
                            <select id="apps" name="apps[]" class="tokenize2" multiple aria-label="Apps">
                                @foreach($apps as $app)
                                    <option @if($chosenApps->contains('id', $app->id)) selected @endif value="{{ $app->id }}">{{ $app->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <button type="submit" class="btn btn-primary mt-1 float-end">Submit</button>
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
