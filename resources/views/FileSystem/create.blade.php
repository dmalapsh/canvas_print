@extends('layout/app')

@section('content')
    <div class="formBlock">
        <div class="container">
            <div class="row">
                <h2 class="w-100">Create User</h2>
                <div class="w-100">
                    @if (session()->has('isSavedStatus'))
                        <div class="alert alert-info">{{ session()->get('isSavedStatus') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('file.store')}}" method="post" class="flex" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file">
                            <input name="file" type="file" class="custom-file-input" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Why:</label>
                            <input type="text" class="form-control" name="purpose" id="exampleInputEmail1" placeholder="Enter purpose..">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label" for="exampleInputEmail1">Email:</label>--}}
{{--                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email address ..">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label" for="exampleInputEmail1">Role:</label>--}}
{{--                            <select class="custom-select" name="role">--}}
{{--                                <option value="user">Administrator</option>--}}
{{--                                <option value="keeper">Keeper</option>--}}
{{--                                <option value="agent">Agent</option>--}}
{{--                                <option value="client">Client</option>--}}
{{--                                <option value="accountant">Accountant</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label" for="exampleInputPassword1">Password:</label>--}}
{{--                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter password ..">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label" for="exampleInputPassword1">Confirm Password:</label>--}}
{{--                            <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword1" placeholder="Confirm password ..">--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-primary-dodger-blue">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
