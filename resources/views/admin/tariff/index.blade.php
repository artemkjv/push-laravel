@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tariffs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Tariffs</li>
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
                    <a href="{{ route('admin.tariff.create') }}" class="btn btn-primary">Add Tariff</a>
                @if (count($tariffs))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Default</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tariffs as $tariff)
                                    <tr>
                                        <td>{{ $tariff->id }}</td>
                                        <td>{{ $tariff->name }}</td>
                                        <td>{{ $tariff->price }}</td>
                                        <td class="text-center"><span class="action-icon">@if($tariff->is_default) &#9745; @else &#9746; @endif</span></td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('admin.tariff.edit', ['id' => $tariff->id]) }}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <ion-icon name="create" class="action-icon"></ion-icon>
                                            </a>

                                            <form
                                                action="{{ route('admin.tariff.destroy', ['id' => $tariff->id]) }}"
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
                        <p>No tariffs yet...</p>
                    @endif

                    {{ $tariffs->links("pagination::bootstrap-4") }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
