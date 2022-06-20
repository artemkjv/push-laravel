@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Api Tokens</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Profile</a></li>
                        <li class="breadcrumb-item active">Api Tokens</li>
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
                    <form action="{{ route('apiToken.index') }}" class="d-flex filters-wrapper mb-2">
                        <div class="form-group">
                            <label for="limit">Limit</label>
                            <input type="number" class="form-control" value="{{ request()->get('limit') }}" id="limit" name="limit">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('apiToken.create') }}" class="btn btn-success">Create Token</a>
                    </form>
                    @if (count($apiTokens))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th>Name</th>
                                    <th>Token</th>
                                    <th>Expires At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($apiTokens as $apiToken)
                                    <tr>
                                        <td>{{ $apiToken->id }}</td>
                                        <td>{{ $apiToken->name }}</td>
                                        <td>{{ $apiToken->token }}</td>
                                        <td>{{ $apiToken->expires_at }}</td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('apiToken.edit', ['id' => $apiToken->id]) }}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <ion-icon name="create" class="action-icon"></ion-icon>
                                            </a>
                                            <form
                                                action="{{ route('apiToken.destroy', ['id' => $apiToken->id]) }}"
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
                        <p>No api tokens yet...</p>
                    @endif

                    {{ $apiTokens->links("pagination::bootstrap-4") }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
