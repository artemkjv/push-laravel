@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Weekly Push</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.index") }}">Users</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.show", ['id' => $user->id]) }}">User</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.weeklyPush.index', ['userId' => $user->id]) }}">Weekly Pushes</a></li>
                        <li class="breadcrumb-item active">Create Weekly Push</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" enctype="multipart/form-data" method="post" action="{{ route('admin.weeklyPush.store', ['userId' => $user->id]) }}">
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
                            <select multiple class="tokenize2" id="apps" name="apps[]" aria-label="Apps">
                                @foreach($apps as $app)
                                    <option value="{{ $app->id }}">{{ $app->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="segments">Segments</label>
                            <select multiple class="tokenize2" name="segments[]" id="segments" aria-label="Segments">
                                <option selected value="0">All Users</option>
                                @foreach($segments as $segment)
                                    <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-select @error('template_id') is-invalid @enderror" name="template_id" aria-label="Template">
                                <option selected>Choose template</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Choose status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" aria-label="Status">
                                <option selected value="ACTIVE">Active</option>
                                <option value="PAUSE">Pause</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="time_to_live">Live Time (in seconds)</label>
                            <input type="text" class="form-control @error('time_to_live') is-invalid @enderror" value="{{ old('time_to_live') }}" id="time_to_live" name="time_to_live">
                        </div>

                        <div class="form-group">
                            <label for="days">Select days of distribution</label>
                            <select multiple id="days" class="tokenize2" name="days_to_send[]" aria-label="Days">
                                @for($i = 0; $i < 7; $i++)
                                    <option value="{{ strtolower(jddayofweek($i, CAL_DOW_LONG)) }}">{{ jddayofweek($i, CAL_DOW_LONG) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="time_to_send">Time to send</label>
                            <input id="time_to_send" name="time_to_send" class="form-control @error('time_to_send') is-invalid @enderror" value="{{ old('time_to_send') }}" type="time">
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
