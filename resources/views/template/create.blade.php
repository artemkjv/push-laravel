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
            <form role="form" enctype="multipart/form-data" method="post" action="{{ route('template.store') }}">
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
                            <label for="icon">Icon (Max icon size is 100х100)</label>
                            <input class="form-control" type="file" accept=".jpg, .jpeg, .png" name="icon" id="icon">
                        </div>
                        <div class="form-group">
                            <label for="open_url">Open Url</label>
                            <input type="url" class="form-control" value="{{ old('open_url') }}" id="open_url" name="open_url">
                        </div>
                        <div class="form-group">
                            <label for="deeplink">Deeplink (For IOS or Android)</label>
                            <input type="text" class="form-control" value="{{ old('deeplink') }}" id="deeplink" name="deeplink">
                        </div>

                    </div>
                    <div class="col-xl-6 col-sm-12">
                        @livewire('message-form')
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
