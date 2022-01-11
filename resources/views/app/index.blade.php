@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Applications</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                        <li class="breadcrumb-item active">Applications</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('app.index') }}" class="d-flex filters-wrapper mb-2">
                        <a href="{{ route('app.create') }}" class="btn btn-primary">Add Application</a>
                        <div class="form-group">
                            <label for="limit">Limit</label>
                            <input type="number" class="form-control" value="{{ request()->get('limit') }}" id="limit" name="limit">
                        </div>
                        <div class="form-group">
                            <label for="search">Search</label>
                            <input type="text" class="form-control" value="{{ request()->get('search') }}" id="search" name="search">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @if (count($apps))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th>Name</th>
                                    <th>Subscribed Users</th>
                                    <th>Platforms</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($apps as $app)
                                    <tr>
                                        <td>{{ $app->id }}</td>
                                        <td>{{ $app->title }}</td>
                                        <td>{{ $app->push_users_count }}</td>
                                        <td>
                                            @foreach($app->platforms as $platform)
                                                {{ $platform->name }}<br>
                                            @endforeach
                                        </td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('app.edit', ['id' => $app->id]) }}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <ion-icon name="create" class="action-icon"></ion-icon>
                                            </a>

                                            <a href="{{ route('app.show', ['id' => $app->id]) }}"
                                               class="btn btn-success btn-sm float-left mr-1">
                                                <ion-icon name="eye" class="action-icon"></ion-icon>
                                            </a>

                                            <form
                                                action="{{ route('app.destroy', ['id' => $app->id]) }}"
                                                method="post" class="float-left">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Submit deleting...')">
                                                    <ion-icon name="trash" class="action-icon"></ion-icon>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No apps yet...</p>
                    @endif

                    {{ $apps->links("pagination::bootstrap-4") }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
