@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Weekly Pushes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                        <li class="breadcrumb-item active">Weekly Pushes</li>
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
                    <form action="{{ route('weeklyPush.index') }}" class="d-flex filters-wrapper mb-2">
                        <a href="{{ route('weeklyPush.create') }}" class="btn btn-primary">Add Weekly Push</a>
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
                    @if (count($weeklyPushes))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($weeklyPushes as $weeklyPush)
                                    <tr>
                                        <td>{{ $weeklyPush->id }}</td>
                                        <td>{{ $weeklyPush->name }}</td>
                                        <td>{{ $weeklyPush->status }}</td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('weeklyPush.edit', ['id' => $weeklyPush->id]) }}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <ion-icon name="create" class="action-icon"></ion-icon>
                                            </a>

                                            <form
                                                action="{{ route('weeklyPush.copy', ['id' => $weeklyPush->id]) }}"
                                                method="post" class="float-left">
                                                @csrf
                                                <button type="submit" class="btn btn-info btn-sm">
                                                    <ion-icon name="copy" class="action-icon"></ion-icon>
                                                </button>
                                            </form>

                                            <form
                                                action="{{ route('weeklyPush.destroy', ['id' => $weeklyPush->id]) }}"
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
                        <p>No weekly pushes yet...</p>
                    @endif

                    {{ $weeklyPushes->links("pagination::bootstrap-4") }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
