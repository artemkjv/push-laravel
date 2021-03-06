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
            <form role="form" method="post" enctype="multipart/form-data"
                  action="{{ route('app.update', ['id' => $app->id]) }}">
                @livewire('app.edit', compact('app'))
            </form>
        </div><!-- /.container-fluid -->
    </section>
@endsection
