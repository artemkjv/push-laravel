@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Users</li>
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
                    <form action="{{ route('admin.user.index') }}" class="d-flex filters-wrapper mb-2">
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
                    @if (count($users))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('admin.user.show', ['id' => $user->id]) }}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <ion-icon name="create" class="action-icon"></ion-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No users yet...</p>
                    @endif

                    {{ $users->links("pagination::bootstrap-4") }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
