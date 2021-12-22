@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Template</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Template</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" method="post" action="{{ route('template.store') }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                   value="{{ old('name') }}"
                                   placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input class="form-control" type="file" accept=".jpg, .jpeg, .png" name="image" id="image">
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input class="form-control" type="file" accept=".jpg, .jpeg, .png" name="icon" id="icon">
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-12">

                    </div>
                    <!-- /.col -->
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
                    </div>

                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->
    </section>
@endsection
