@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Custom Push</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.index") }}">Users</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.show", ['id' => $user->id]) }}">User</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customPush.index', ['userId' => $user->id]) }}">Custom Pushes</a></li>
                        <li class="breadcrumb-item active">Create Custom Push</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" enctype="multipart/form-data" method="post" action="{{ route('admin.customPush.store', ['userId' => $user->id]) }}">
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
                            <label for="apps">Apps</label>
                            <select multiple id="apps" class="tokenize2" name="apps[]" aria-label="Apps">
                                @foreach($apps as $app)
                                    <option value="{{ $app->id }}">{{ $app->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="segments">Segments</label>
                            <select multiple name="segments[]" class="tokenize2" id="segments" aria-label="Segments">
                                <option selected value="0">All Users</option>
                                @foreach($segments as $segment)
                                    <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg, .jpeg, .png" name="image" id="image">
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon (Max icon size is 100??100)</label>
                            <input class="form-control @error('icon') is-invalid @enderror" type="file" accept=".jpg, .jpeg, .png" name="icon" id="icon">
                        </div>

                        <div class="form-group">
                            <label for="open_url">Open Url</label>
                            <input type="text" class="form-control" @error('open_url') is-invalid @enderror value="{{ old('open_url') }}" id="open_url" name="open_url">
                        </div>

                        <div class="form-group">
                            <label for="deeplink">Deeplink (For IOS or Android)</label>
                            <input type="text" class="form-control @error('deeplink') is-invalid @enderror" value="{{ old('deeplink') }}" id="deeplink" name="deeplink">
                        </div>

                        <div class="form-group">
                            <label for="time_to_live">Live Time (in seconds)</label>
                            <input type="text" class="form-control @error('time_to_live') is-invalid @enderror" value="{{ old('time_to_live') }}" id="time_to_live" name="time_to_live">
                        </div>

                        <div class="form-group">
                            <label for="time_to_send">Time to send</label>
                            <input id="time_to_send" name="time_to_send" class="form-control @error('time_to_send') is-invalid @enderror" value="{{ old('time_to_send') }}" type="datetime-local">
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
@section('scripts')
    <script>
        let entities = $('.tokenize2')
        entities.tokenize2({
            dataSource: 'select',
        })
    </script>
@endsection
