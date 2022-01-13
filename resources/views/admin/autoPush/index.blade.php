@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Auto Pushes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.index") }}">Users</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.show", ['id' => $user->id]) }}">User</a></li>
                        <li class="breadcrumb-item active">Auto Pushes</li>
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
                    <form action="{{ route('admin.autoPush.index', ['userId' => $user->id]) }}" class="d-flex filters-wrapper mb-2">
                        <a href="{{ route('admin.autoPush.create', ['userId' => $user->id]) }}" class="btn btn-primary">Add Auto Push</a>
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
                    @if (count($autoPushes))
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
                                @foreach($autoPushes as $autoPush)
                                    <tr>
                                        <td>{{ $autoPush->id }}</td>
                                        <td>{{ $autoPush->name }}</td>
                                        <td>{{ $autoPush->status }}</td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('admin.autoPush.edit', ['userId' => $user->id, 'id' => $autoPush->id]) }}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <ion-icon name="create" class="action-icon"></ion-icon>
                                            </a>

                                            <form
                                                action="{{ route('admin.autoPush.destroy', ['userId' => $user->id, 'id' => $autoPush->id]) }}"
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
                        <p>No auto pushes yet...</p>
                    @endif

                    {{ $autoPushes->links("pagination::bootstrap-4") }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
