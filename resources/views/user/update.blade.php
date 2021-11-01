@extends('layout/app')

@section('content')
    <div class="formBlock">
        <div class="container">
            <div class="row">
                <h2 class="w-100">Update user</h2>
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
                    <form action="{{route('updateUser',['id'=>$user->id])}}" method="post" class="flex">
                        @csrf
                        <input type="hidden" value="{{$user->id}}" name="id">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}"
                                   id="exampleInputEmail1" placeholder="Enter name ..">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Email:</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}"
                                   id="exampleInputEmail1" placeholder="Enter email address ..">
                        </div>
                        @if($roleList)
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Role:</label>
                                <select class="custom-select" name="role">

                                    @foreach( $roleList as $key=>$item)
                                        <option value={{$key}} {{$key == $user->role ? 'selected' : null}}>{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary-dodger-blue">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
