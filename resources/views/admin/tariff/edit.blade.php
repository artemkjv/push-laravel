@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Tariff</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.tariff.index') }}">Tariffs</a></li>
                        <li class="breadcrumb-item active">Edit Tariff</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" enctype="multipart/form-data" method="post" action="{{ route('admin.tariff.update', ['id' => $tariff->id]) }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                   value="{{ old('name', $tariff->name) }}"
                                   placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price"
                                   class="form-control @error('price') is-invalid @enderror" id="price"
                                   value="{{ old('price', $tariff->price) }}"
                                   placeholder="Price">
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" @if($tariff->is_default) checked @endif name="is_default" type="checkbox" id="is-default">
                            <label class="form-check-label" for="is-default">Is Default</label>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="max-apps">Max Applications</label>
                            <input type="number" name="max_apps"
                                   class="form-control @error('max_apps') is-invalid @enderror" id="max-apps"
                                   value="{{ old('max_apps', $tariff->max_apps) }}"
                                   placeholder="Max Applications">
                        </div>
                        <div class="form-group">
                            <label for="max-segments">Max Segments</label>
                            <input type="number" name="max_segments"
                                   class="form-control @error('max_segments') is-invalid @enderror" id="max-segments"
                                   value="{{ old('max_segments', $tariff->max_segments) }}"
                                   placeholder="Max Segments">
                        </div>
                        <div class="form-group">
                            <label for="max-templates">Max Templates</label>
                            <input type="number" name="max_templates"
                                   class="form-control @error('max_templates') is-invalid @enderror" id="max-templates"
                                   value="{{ old('max_templates', $tariff->max_templates) }}"
                                   placeholder="Max Templates">
                        </div>
                        <div class="form-group">
                            <label for="max-pushes">Max Pushes</label>
                            <input type="number" name="max_pushes"
                                   class="form-control @error('max_pushes') is-invalid @enderror" id="max-pushes"
                                   value="{{ old('max_pushes', $tariff->max_pushes) }}"
                                   placeholder="Max Pushes">
                        </div>
                        <div class="form-group">
                            <label for="max-push-users">Max Push Users</label>
                            <input type="number" name="max_push_users"
                                   class="form-control @error('max_push_users') is-invalid @enderror" id="max-push-users"
                                   value="{{ old('max_push_users', $tariff->max_push_users) }}"
                                   placeholder="Max Push Users">
                        </div>
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
