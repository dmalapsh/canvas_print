@extends('layout/app')

@section('content')
    <div class="container page__container">
        <form action="#">
            <div class="row">
                <div class="col-lg-9 pr-lg-0">

                    <div class="page-section">
                        <h4>Payment Information</h4>
                        <div class="list-group list-group-form">
                            <div class="list-group-item d-flex align-items-center">
                                <img src="{{asset('theme/images/visa.svg')}}" alt="visa" width="38" class="mr-16pt">
                                <div class="flex">Your current payment method is <strong>Visa ending with 2819</strong></div>
                            </div>
                            <div class="list-group-item">
                                <fieldset role="group" aria-labelledby="label-type" class="m-0 form-group">
                                    <div class="form-row align-items-center">
                                        <label for="payment_cc" id="label-type" class="col-md-3 col-form-label form-label">Payment type</label>
                                        <div role="group" aria-labelledby="label-type" class="col-md-9">
                                            <div role="group" class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-outline-secondary">
                                                    <input type="radio" id="payment_cc" name="payment_type" value="cc" checked="" aria-checked="true"> Debit or credit card
                                                </label>
                                                <label class="btn btn-outline-secondary active">
                                                    <input type="radio" id="payment_pp" name="payment_type" value="pp" aria-checked="true"> PayPal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label class="col-form-label form-label col-sm-3">Card number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Credit / debit card number">
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label class="col-form-label form-label col-sm-3">Security code (CVV)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="CVV" style="width:80px">
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div role="group" aria-labelledby="label-expire_month" class="m-0 form-group">
                                    <div class="form-row align-items-center">
                                        <label id="label-expire_month" for="expire_month" class="col-md-3 col-form-label form-label">Expiration date</label>
                                        <div class="col-md-9">
                                            <div class="form-row">
                                                <div class="col-auto">
                                                    <select id="expire_month" class="form-control custom-select" style="width: 140px;">
                                                        <option value="1">January</option>
                                                        <option value="2">February</option>
                                                        <option value="3">March</option>
                                                        <option value="4">April</option>
                                                        <option value="5">May</option>
                                                        <option value="6">June</option>
                                                        <option value="7">July</option>
                                                        <option value="8">August</option>
                                                        <option value="9">September</option>
                                                        <option value="10">October</option>
                                                        <option value="11">November</option>
                                                        <option value="12">December</option>
                                                    </select>
                                                </div>
                                                <div class="col-auto">
                                                    <select id="expire_year" class="form-control custom-select" style="width: 100px;">
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <a href="" class="btn btn-accent-dodger-blue">Save changes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 page-nav">
                    <div class="page-section pt-lg-112pt">
                        <nav class="nav page-nav__menu">
                            <a class="nav-link" href="#">Subscription</a>
                            <a class="nav-link" href="#">Upgrade Account</a>
                            <a class="nav-link active" href="#">Payment Information</a>
                        </nav>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection



