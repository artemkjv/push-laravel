@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Managed User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-sm-12">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ route('admin.app.index', ['userId' => $user->id]) }}">Applications</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('admin.segment.index', ['userId' => $user->id]) }}">Segments</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('admin.template.index', ['userId' => $user->id]) }}">Templates</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('admin.customPush.index', ['userId' => $user->id]) }}">Custom Pushes</a>
                        </li>
                        <li class="list-group-item">
                            <a href={{ route('admin.autoPush.index', ['userId' => $user->id]) }}>Auto Pushes</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('admin.weeklyPush.index', ['userId' => $user->id]) }}">Weekly Pushes</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('admin.pushUser.index', ['userId' => $user->id]) }}">Push Users</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('admin.sentPush.index', ['userId' => $user->id]) }}">Delivery</a>
                        </li>
                    </ul>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
