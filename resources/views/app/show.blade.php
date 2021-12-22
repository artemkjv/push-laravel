@extends('layouts.layout')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="content-wrapper form-wrapper content-border">
                        <div class="content-header">
                            <div class="title">
                                <h2>Application </h2>
                            </div>
                        </div>
                        <div class="content-body">
                            <p class="mb-5">Your App ID: {{ $app->uuid }}</p>
                        </div>
                        <div class="content-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
