@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Checkout</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tariffs.index') }}">Tariffs</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
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
                    <div class="alert alert-smoke" role="alert">
                        <h3 class="text-grey">1. Pricing Summary</h3>
                        <p class="lead">
                            ${{ $tariff->price  }} / month
                        </p>
                    </div>
                    <form action="{{ route('tariffs.proceed-checkout', ['id' => $tariff->id]) }}" method="post">
                        @csrf
                        <div class="alert alert-smoke">
                            <h3 class="text-grey">2. Company details</h3>
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" name="company_name"
                                       class="form-control @error('company_name') is-invalid @enderror"
                                       id="company_name"
                                       value="{{ old('company_name') }}"
                                       placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <label for="name">Billing Email Address</label>
                                <input type="email" name="billing_email"
                                       class="form-control @error('billing_email') is-invalid @enderror"
                                       id="billing_email"
                                       value="{{ old('billing_email') }}"
                                       placeholder="Billing Email">
                            </div>
                        </div>
                        <div class="alert alert-smoke">
                            <h3 class="text-grey">2. Billing details</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="first-name">
                                        First Name
                                    </label>
                                    <input type="text" id="first-name" name="first_name" class="form-control"
                                           value="{{ old('first_name') }}"
                                           placeholder="First name">
                                </div>
                                <div class="col-lg-6">
                                    <label for="last-name">
                                        Last Name
                                    </label>
                                    <input type="text" class="form-control" id="last-name" name="last_name"
                                           value="{{ old('last_name') }}"
                                           placeholder="Last name">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="text-sm mb-0">Card Number</p>
                                <div class="row px-3" style="gap: 20px;">
                                    <input type="text" class="input-card" name="card_number"
                                           placeholder="0000 0000 0000 0000" size="18" id="card-number"
                                           value="{{ old('card_number') }}"
                                           minlength="19" maxlength="19">
                                    <input class="input-card" type="text" name="card_expiration"
                                           placeholder="MM/YY" size="6"
                                           value="{{ old('card_expiration') }}"
                                           id="card-expiration" minlength="5"
                                           maxlength="5">
                                    <input class="input-card" type="password" name="card_cvv"
                                           placeholder="000" size="1"
                                           minlength="3" maxlength="3">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="street-address">
                                        Street Address
                                    </label>
                                    <input type="text" id="street-address" name="street_address" class="form-control"
                                           value="{{ old('street_address') }}"
                                           placeholder="Street Address">
                                </div>
                                <div class="col-lg-6">
                                    <label for="city">
                                        City
                                    </label>
                                    <input type="text" class="form-control" id="city" name="city"
                                           value="{{ old('city') }}"
                                           placeholder="City">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="country">
                                        Country
                                    </label>
                                    <input type="text" id="country" name="country" class="form-control"
                                           value="{{ old('country') }}"
                                           placeholder="Country">
                                </div>
                                <div class="col-lg-6">
                                    <label for="postcode">
                                        Postcode
                                    </label>
                                    <input type="text" class="form-control" id="postcode" name="postcode"
                                           value="{{ old('postcode') }}"
                                           placeholder="Postcode">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Confirm Checkout</button>
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            var cardNum = document.getElementById('card-number');
            cardNum.onkeyup = function (e) {
                if (this.value == this.lastValue) return;
                var caretPosition = this.selectionStart;
                var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
                var parts = [];

                for (var i = 0, len = sanitizedValue.length; i < len; i += 4) {
                    parts.push(sanitizedValue.substring(i, i + 4));
                }
                for (var i = caretPosition - 1; i >= 0; i--) {
                    var c = this.value[i];
                    if (c < '0' || c > '9') {
                        caretPosition--;
                    }
                }
                caretPosition += Math.floor(caretPosition / 4);

                this.value = this.lastValue = parts.join(' ');
                this.selectionStart = this.selectionEnd = caretPosition;
            }

            //For Date formatted input
            var expDate = document.getElementById('card-expiration');
            expDate.onkeyup = function (e) {
                if (this.value == this.lastValue) return;
                var caretPosition = this.selectionStart;
                var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
                var parts = [];

                for (var i = 0, len = sanitizedValue.length; i < len; i += 2) {
                    parts.push(sanitizedValue.substring(i, i + 2));
                }
                for (var i = caretPosition - 1; i >= 0; i--) {
                    var c = this.value[i];
                    if (c < '0' || c > '9') {
                        caretPosition--;
                    }
                }
                caretPosition += Math.floor(caretPosition / 2);

                this.value = this.lastValue = parts.join('/');
                this.selectionStart = this.selectionEnd = caretPosition;
            }

        });
    </script>
@endsection
