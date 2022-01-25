@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Custom Push</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("customPush.index") }}">Custom Pushes</a></li>
                        <li class="breadcrumb-item active">Edit Custom Push</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" enctype="multipart/form-data" method="post" action="{{ route('customPush.update', ['id' => $customPush->id]) }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="template-image" value="0">
                        <input type="hidden" name="template-icon" value="0">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                   value="{{ old('name', $customPush->name) }}"
                                   placeholder="Name">
                        </div>

                        <div class="form-check form-switch custom-switch">
                            <input class="form-check-input" @if($customPush->is_test) checked @endif type="checkbox" name="is_test" id="is-test">
                            <label class="form-check-label" for="is-test">Is Test</label>
                        </div>

                        <div class="form-group">
                            <label for="apps">Apps</label>
                            <select multiple class="tokenize2" id="apps" name="apps[]" aria-label="Apps">
                                @foreach($apps as $app)
                                    <option @if($customPush->apps->contains('id', $app->id)) selected @endif value="{{ $app->id }}">{{ $app->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="segments">Segments</label>
                            <select multiple class="tokenize2" name="segments[]" id="segments" aria-label="Segments">
                                <option @if($customPush->segments->isEmpty()) selected @endif value="0">All Users</option>
                                @foreach($segments as $segment)
                                    <option @if($customPush->segments->contains('id', $segment->id)) selected @endif value="{{ $segment->id }}">{{ $segment->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg, .jpeg, .png" name="image" id="image">
                        </div>

                        @if($customPush->image)
                            <div class="image-wrapper">
                                <div data-id="template-image" class="delete-image-icon">
                                    ✖
                                </div>
                                <img id="template-image" class="img-thumbnail rounded mt-2 template-image" src="{{ asset("/storage/$customPush->image") }}" alt="Custom Push Image">
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="icon">Icon (Max icon size is 100х100)</label>
                            <input class="form-control @error('icon') is-invalid @enderror" type="file" accept=".jpg, .jpeg, .png" name="icon" id="icon">
                        </div>

                        @if($customPush->icon)
                            <div class="image-wrapper">
                                <div data-id="template-icon" class="delete-image-icon">
                                    ✖
                                </div>
                                <img id="template-icon" class="img-thumbnail rounded mt-2 template-image" src="{{ asset("/storage/$customPush->icon") }}" alt="Custom Push Icon">
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="open_url">Open Url</label>
                            <input type="url" class="form-control" @error('open_url') is-invalid @enderror value="{{ old('open_url', $customPush->open_url) }}" id="open_url" name="open_url">
                        </div>

                        <div class="form-group">
                            <label for="deeplink">Deeplink (For IOS or Android)</label>
                            <input type="text" class="form-control @error('deeplink') is-invalid @enderror" value="{{ old('deeplink', $customPush->deeplink) }}" id="deeplink" name="deeplink">
                        </div>

                        <div class="form-group">
                            <label for="time_to_live">Live Time (in seconds)</label>
                            <input type="text" class="form-control @error('time_to_live') is-invalid @enderror" value="{{ old('time_to_live', $customPush->time_to_live) }}" id="time_to_live" name="time_to_live">
                        </div>

                        <div class="form-group">
                            <label for="time_to_send">Time to send</label>
                            <input id="time_to_send" name="time_to_send" class="form-control @error('time_to_send') is-invalid @enderror" value="{{ old('time_to_send', (new DateTime($customPush->time_to_send))->format('Y-m-d\TH:i')) }}" type="datetime-local">
                        </div>

                    </div>
                    <div class="col-xl-6 col-sm-12">
                        @livewire('message-form', ['title' => $customPush->getTitle(), 'message' => $customPush->getBody()])
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
