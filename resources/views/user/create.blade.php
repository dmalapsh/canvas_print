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
                        @if (session()->has('message'))
                            <div class="alert alert-danger">{{ session()->get('message') }}</div>
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
                    <form action="{{route('createPostUser')}}" method="post" class="flex">
                        @csrf
                        <div class="form-group">
                            <label class="form-label"  for="inputName">*ФИО:</label>
                            <input type="text" required class="form-control" name="name" id="inputName" value="{{old('name')}}" placeholder="Введите имя ..">
                        </div>
                        <div class="form-group">
                            <label  class="form-label" for="inputEmail">*Email:</label>
                            <input required type="email" class="form-control" name="email" id="inputEmail" value="{{old('email')}}" placeholder="Введите e-mail ..">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="inputPhone">Номер телефона:</label>
                            <input type="tel" class="form-control" name="phone" id="inputPhone" value="{{old('phone')}}" placeholder="Введите номер телефона...">
                        </div>
{{--                        @php $options = \App\Services\UserOptionsService::getOptions(Auth::user()) @endphp--}}
                        @if($roleList)
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">*Роль:</label>
                                <select required class="custom-select" name="role">
                                    <option required disabled value="noRole" selected>Выбор роли</option>
                                    @foreach( $roleList as $key=>$item)
                                        <option value={{$key}}>{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1" style="display: block">Пароль:</label>
                            <input type="text" class="form-control genPass" name="password" id="exampleInputEmail1" value="{{old('password')}}" >
                            <button class="btn btn-info" id="gen_pass" type="button">Генирировать</button>
                        </div>
                        <button type="submit" class="btn btn-primary-dodger-blue">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {
            $(document).on('click','#gen_pass',function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: '/generate-password',
                    data: {
                        success: true,
                    },
                    success: function (resp) {
                        $('.genPass').val(resp.password);
                    }
                })
            })
        })
    </script>
@endsection
