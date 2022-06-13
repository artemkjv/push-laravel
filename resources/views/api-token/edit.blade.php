@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Api Token</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Profile</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("apiToken.index") }}">Api Tokens</a></li>
                        <li class="breadcrumb-item active">Edit Temporary Token</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" enctype="multipart/form-data" method="post" action="{{ route('apiToken.update', ['id' => $apiToken->id]) }}">
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{ old('name', $apiToken->name) }}" id="name" name="name">
                        </div>

                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="expires-at">Expires At</label>
                            <input type="date" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                   value="{{ old('expires_at', $apiToken->expires_at) }}" id="expires-at" name="expires_at">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="pages">Actions</label>
                            <select multiple class="tokenize2" id="pages" name="actions[]" aria-label="Actions">
                                @foreach($apiPages as $apiPage)
                                    <option @if($apiToken->apiPages->contains('id', $apiPage->id)) selected @endif value="{{ $apiPage->id }}">{{ $apiPage->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
                    </div>

                </div>
                <!-- /.row -->
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
