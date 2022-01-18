@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sent Pushes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                        <li class="breadcrumb-item active">Sent Pushes</li>
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
                    <div class="form-wrapper form-sm">
                        <form action="{{ route('sentPush.index') }}" method="get">
                            <div class="form-group">
                                <select class="form-select" aria-label="Type" name="pushable_type" id="pushable_type">
                                    <option value="" selected>All Pushes</option>
                                    <option @if(request()->get('pushable_type') === \App\Models\CustomPush::class) selected @endif value="{{ \App\Models\CustomPush::class }}">Custom Pushes</option>
                                    <option @if(request()->get('pushable_type') === \App\Models\AutoPush::class) selected @endif value="{{ \App\Models\AutoPush::class }}">Auto Pushes</option>
                                    <option @if(request()->get('pushable_type') === \App\Models\WeeklyPush::class) selected @endif value="{{ \App\Models\WeeklyPush::class }}">Weekly Pushes</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                    @if (count($sentPushes))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th>Title</th>
                                    <th>Sent At</th>
                                    <th>Sent</th>
                                    <th>Clicked</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sentPushes as $sentPush)
                                    <tr>
                                        <td>{{ $sentPush->id }}</td>
                                        <td>{{ $sentPush->getTitle()['1'] }}</td>
                                        <td>{{ $sentPush->created_at }}</td>
                                        <td>{{ $sentPush->sent }}</td>
                                        <td>{{ $sentPush->clicked }}</td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{  route('sentPush.show', ['id' => $sentPush->id]) }}"
                                                class="btn btn-success btn-sm float-left mr-1">
                                                <ion-icon name="eye" class="action-icon"></ion-icon>
                                            </a>
                                            <form
                                                action="{{ route('sentPush.destroy', ['id' => $sentPush->id]) }}"
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
                        <p>No sent pushes yet...</p>
                    @endif

                    {{ $sentPushes->links("pagination::bootstrap-4") }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
