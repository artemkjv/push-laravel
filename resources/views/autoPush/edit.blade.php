@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Auto Push</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("autoPush.index") }}">Auto Pushes</a></li>
                        <li class="breadcrumb-item active">Edit Auto Push</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" enctype="multipart/form-data" method="post" action="{{ route('autoPush.update', ['id' => $autoPush->id]) }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                   value="{{ old('name', $autoPush->name) }}"
                                   placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="apps">Apps</label>
                            <select multiple class="tokenize2" id="apps" name="apps[]" aria-label="Apps">
                                @foreach($apps as $app)
                                    <option @if($autoPush->apps->contains('id', $app->id)) selected @endif value="{{ $app->id }}">{{ $app->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="segments">Segments</label>
                            <select multiple class="tokenize2" name="segments[]" id="segments" aria-label="Segments">
                                <option selected value="0">All Users</option>
                                @foreach($segments as $segment)
                                    <option @if($autoPush->segments->contains('id', $segment->id)) selected @endif value="{{ $segment->id }}">{{ $segment->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-select @error('template_id') is-invalid @enderror" name="template_id" aria-label="Template">
                                <option selected>Choose template</option>
                                @foreach($templates as $template)
                                    <option @if($autoPush->template->id === $template->id) selected @endif value="{{ $template->id }}">{{ $template->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Choose status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" aria-label="Status">
                                <option @if($autoPush->status === 'ACTIVE') selected @endif value="ACTIVE">Active</option>
                                <option @if($autoPush->status === 'PAUSE') selected @endif value="PAUSE">Pause</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12">

                        <div class="form-group">
                            <label for="time_to_live">Live Time (in seconds)</label>
                            <input type="text" class="form-control @error('time_to_live') is-invalid @enderror" value="{{ old('time_to_live', $autoPush->time_to_live) }}" id="time_to_live" name="time_to_live">
                        </div>

                        <div class="form-group">
                            <label for="interval">Interval</label>
                            <input type="text" class="form-control @error('interval_value') is-invalid @enderror" value="{{ old('interval_value', $autoPush->interval_value) }}" id="interval" name="interval_value">
                        </div>

                        <div class="form-group">
                            <label for="interval_type">Interval Type</label>
                            <select class="form-select @error('interval_type') is-invalid @enderror" name="interval_type" id="interval_type">
                                <option @if($autoPush->interval_type === 'hour') selected @endif value="hour">Hour</option>
                                <option @if($autoPush->interval_type === 'day') selected @endif value="day">Day</option>
                                <option @if($autoPush->interval_type === 'week') selected @endif value="week">Week</option>
                            </select>
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
@section('scripts')
    <script>
        let entities = $('.tokenize2')
        entities.tokenize2({
            dataSource: 'select',
        })
    </script>
@endsection
