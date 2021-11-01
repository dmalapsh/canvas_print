@extends('layout/app')

@section('content')
    <div class="container page__container">
        <form action="#">
            <div class="row">
                <div class="col-lg-9 pr-lg-0">

                    <div class="page-section">
                        <h4>Profile</h4>
                        <div class="list-group list-group-form">
                            <div class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label class="col-form-label form-label col-sm-3">Your photo</label>
                                    <div class="col-sm-9 media align-items-center">
                                        <a href="" class="media-left mr-16pt">
                                            <img src={{asset('theme/images/guy-3.jpg') }} alt="people" width="56" class="rounded-circle">
                                        </a>
                                        <div class="media-body">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label class="col-form-label form-label col-sm-3">Huma profile name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  placeholder="Your profile name ...">
                                        <small class="form-text text-muted">Your profile name will be used as part of your public profile URL address.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label class="col-form-label form-label col-sm-3">About you</label>
                                    <div class="col-sm-9">
                                        <textarea rows="3" class="form-control" placeholder="About you ..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Display your real name on your profile</label>
                                    <small class="form-text text-muted">If unchecked, your profile name will be displayed instead of your full name.</small>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked="" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Allow everyone to see your profile</label>
                                    <small class="form-text text-muted">If unchecked, your profile will be private and no one except you will be able to view it.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 page-nav">
                    <div class="page-section pt-lg-112pt">
                        <nav class="nav page-nav__menu">
                            <a class="nav-link" href="#">Basic Information</a>
                            <a class="nav-link active" href="#">Profile &amp; Privacy</a>
                            <a class="nav-link" href="#">Email Notifications</a>
                            <a class="nav-link" href="#">Change Password</a>
                        </nav>
                        <div class="page-nav__content">
                            <button type="submit" class="btn btn-accent-dodger-blue">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection



