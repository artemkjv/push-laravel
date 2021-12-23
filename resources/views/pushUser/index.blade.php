@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Push Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                        <li class="breadcrumb-item active">Push Users</li>
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
                    @if (count($pushUsers))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th>Internal Id</th>
                                    <th>Country</th>
                                    <th>Language</th>
                                    <th>Timezone</th>
                                    <th>Time In App</th>
                                    <th>Sessions Count</th>
                                    <th>First Session</th>
                                    <th>Last Session</th>
                                    <th>Status</th>
                                    <th>Device Model</th>
                                    <th>Platform</th>
                                    <th>Tags</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pushUsers as $pushUser)
                                    <tr>
                                        <td>{{ $pushUser->id }}</td>
                                        <td>{{ $pushUser->uuid }}</td>
                                        <td>{{ $pushUser->country->name }}</td>
                                        <td>{{ $pushUser->language->name }}</td>
                                        <td>{{ $pushUser->timezone->name }}</td>
                                        <td>{{ $pushUser->time_in_app }}</td>
                                        <td>{{ $pushUser->sessions_count }}</td>
                                        <td>{{ $pushUser->created_at }}</td>
                                        <td>{{ $pushUser->active_at }}</td>
                                        <td>{{ $pushUser->status }}</td>
                                        <td>{{ $pushUser->device_model }}</td>
                                        <td>{{ $pushUser->platform->name }}</td>
                                        <td>{{ $pushUser->tags ? json_encode($pushUser->tags) : '' }}</td>
                                        <td class="d-flex justify-content-around">
                                            <form
                                                action="{{ route('pushUser.destroy', ['id' => $pushUser->id]) }}"
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
                        <p>No push users yet...</p>
                    @endif

                    {{ $pushUsers->links("pagination::bootstrap-4") }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
