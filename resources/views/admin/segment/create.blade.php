@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Segment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.index") }}">Users</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.show", ['id' => $user->id]) }}">User</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.segment.index', ['userId' => $user->id]) }}">Segments</a></li>
                        <li class="breadcrumb-item active">Create Segment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" method="post" action="{{ route('admin.segment.store', ['userId' => $user->id]) }}">
                <div class="row">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror" id="name"
                               value="{{ old('name') }}"
                               placeholder="Name">
                    </div>

                    @livewire('segment-form')

                    <div class="col-1">
                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
                    </div>

                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->
    </section>
@endsection
