@extends('layout/app')

@section('content')
    <div class="formBlock">
        <div class="container">
            <div class="row">
                <h3 class="w-100">Создание промежуточного результата для проекта с id{{$id}}</h3>
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
                    <form action="{{route('projectNewsStorage',$id)}}" method="post" class="flex" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <textarea placeholder="Опишите промежуточный результат" name="text" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group file">
                            <button class="add_field_button btn-success btn-sm" type="button">Добавить вложение</button>
                        </div>
                        <button type="submit" class="btn btn-primary-dodger-blue">Опубликовать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('custom-js')
    <script>
        var max_fields = 10;
        var wrapper = $(".file");
        var add_button = $(".add_field_button");
        var y = 1;
        $(add_button).click(function(e){
            e.preventDefault();
            if(y < max_fields){
                y++;
                $(wrapper).append('<div class="custom-file"> <input type="file"  class="custom-file-input input-appendices" name="file[]"> <label for="file" class="custom-file-label label-appendices" >Выберете файл для вложения</label></div>'); //add input box
            }
        });
    </script>
@endsection
@endsection
