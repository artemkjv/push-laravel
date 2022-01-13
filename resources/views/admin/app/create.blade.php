@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Application</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.index") }}">Users</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.show", ['id' => $user->id]) }}">User</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.app.index', ['userId' => $user->id]) }}">Applications</a></li>
                        <li class="breadcrumb-item active">Create Application</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" method="post" action="{{ route('admin.app.store', ['userId' => $user->id]) }}">
            <div class="row">
                <div class="content-header">
                    <div class="description">
                        Add your app or website. Need help? <a href="#">Read our getting started docs</a>.
                    </div>
                </div>
                    <div class="col-xl-6 col-sm-12">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title"
                                   class="form-control @error('title') is-invalid @enderror" id="title"
                                   value="{{ old('title') }}"
                                   placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="server_key">Server Key</label>
                            <input type="text" name="server_key"
                                   class="form-control @error('server_key') is-invalid @enderror" id="server_key"
                                   value="{{ old('server_key') }}"
                                   placeholder="Server Key">
                        </div>

                        <div class="form-group">
                            <label for="sender_id">Sender Id</label>
                            <input type="number" name="sender_id"
                                   class="form-control @error('sender_id') is-invalid @enderror" id="sender_id"
                                   value="{{ old('sender_id') }}"
                                   placeholder="Sender Id">
                        </div>
                    </div>
                <!-- /.col -->
                @if(count($platforms))
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group mt-3 platform-group text-center">
                            @foreach($platforms as $platform)
                                <label class="radio-image me-4">
                                    <input type="radio" name="platform_id" value="{{ $platform->id }}">
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
