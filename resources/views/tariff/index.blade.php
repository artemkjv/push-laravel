@extends('layouts.layout')
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
                    <li class="breadcrumb-item"><a href="{{route(`home`)}}">Home</a></li>
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
                <div class="pricing-header px-3 py-3 pt-md-2 pb-md-3 mx-auto text-center">
                    <h1 class="display-4">Pricing</h1>
                </div>
                <div class="card-deck mb-3 text-center">
                    @foreach($tariffs as $tariff)
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">{{ $tariff->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">${{ $tariff->price }} <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>{{ $tariff->max_apps }} apps included</li>
                                <li>{{ $tariff->max_templates }} templates included</li>
                                <li>{{ $tariff->max_segments }} segments included</li>
                                <li>{{ $tariff->max_pushes }} pushes included</li>
                                <li>{{ $tariff->max_push_users }} push users max</li>
                            </ul>
                            <a class="btn btn-lg btn-block btn-primary @if(\request()->user()->tariff_id === $tariff->id) disabled @endif" @if(\request()->user()->tariff_id === $tariff->id) disabled @endif href="{{ route('tariffs.checkout', ['id' => $tariff->id]) }}">
                                Choose Plan
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection