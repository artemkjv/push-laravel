@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Templates</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                        <li class="breadcrumb-item active">Templates</li>
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
                    <a href="{{ route('template.create') }}" class="btn btn-primary mb-3">Add Template</a>
                    @if (count($templates))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($templates as $template)
                                    <tr>
                                        <td>{{ $template->id }}</td>
                                        <td>{{ $template->name }}</td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('template.edit', ['id' => $template->id]) }}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <ion-icon name="create" class="action-icon"></ion-icon>
                                            </a>

                                            <form
                                                action="{{ route('template.destroy', ['id' => $template->id]) }}"
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
                        <p>No templates yet...</p>
                    @endif

                    {{ $templates->links("pagination::bootstrap-4") }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
