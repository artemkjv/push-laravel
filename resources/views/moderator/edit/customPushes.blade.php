@extends('layouts.layout')
@section('content')
    @include('moderator.components.topbar')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit {{ $moderator->email }}</h1>
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
            <form role="form" method="post" action="{{ route('moderator.update.customPushes', ['id' => $moderator->id]) }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name', $moderator->name) }}" required>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="customPushes">Custom Pushes</label>
                            <select name="customPushes[]" class="tokenize2" id="customPushes" multiple aria-label="Custom Pushes">
                                @foreach($customPushes as $customPush)
                                    <option @if($chosenCustomPushes->contains('id', $customPush->id)) selected @endif value="{{ $customPush->id }}">{{ $customPush->name }}</option>
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
