@extends('layouts.layout')
@section('content')
    @include('app.components.topbar')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Application</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('app.index') }}">Applications</a></li>
                        <li class="breadcrumb-item active">Edit Application</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" method="post" action="{{ route('app.update', ['id' => $app->id]) }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title"
                                   class="form-control @error('title') is-invalid @enderror" id="title"
                                   value="{{ old('title', $app->title) }}"
                                   placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="server_key">Server Key</label>
                            <input type="text" name="server_key"
                                   class="form-control @error('server_key') is-invalid @enderror" id="server_key"
                                   value="{{ old('server_key', $app->server_key) }}"
                                   placeholder="Server Key">
                        </div>

                        <div class="form-group">
                            <label for="sender_id">Sender Id</label>
                            <input type="number" name="sender_id"
                                   class="form-control @error('sender_id') is-invalid @enderror" id="sender_id"
                                   value="{{ old('sender_id', $app->sender_id) }}"
                                   placeholder="Sender Id">
                        </div>
                    </div>
                    <!-- /.col -->
                    @if(count($platforms))
                        <div class="col-xl-6 col-sm-12">
                            <div class="form-group mt-3 platform-group text-center">
                                @foreach($platforms as $platform)
                                    <label class="radio-image me-4">
                                        <input type="checkbox" name="platforms[]" @if($app->platforms->contains('id', $platform->id)) checked @endif value="{{ $platform->id }}">
                                        <img src="{{ $platform->image }}" width="150" alt="{{ $platform->name }}">
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.col -->
                    @endif
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
                    </div>

                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->
    </section>
@endsection
