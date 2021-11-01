@extends('layout/app')

@section('content')
    <div class="container page__container">

            <div class="row">
                <div class="col-lg-9 pr-lg-0">
                    <div class="formBlock">
                        <div class="container">
                            <div class="row">
                                <h2 class="w-100">Create Project</h2>
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
                                    <form id="createProject" action="{{route('postCreateProject')}}" method="post" class="flex" enctype="multipart/form-data">
                                        @csrf
                                        <div class="tab-content" style="margin-top: 50px">
                                            <div class="tab-pane active" id="client">
                                                <p>Клиент уже зарегистрирован в системе?</p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="client_exists" id="inlineRadio1" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">Нет</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="client_exists" id="inlineRadio2" value="0">
                                                    <label class="form-check-label" for="inlineRadio2">Да</label>
                                                </div>
                                                <div class="removePart" id="client_exists">
                                                    <div class="form-group">
                                                        <label class="form-label">Id пользователя:</label>
                                                        <input type="number" class="form-control" name="client_id" id="images_count" min="0" value="" placeholder="Enter id ..">
                                                    </div>
                                                </div>
                                                <div class="removePart" id="create_client">
                                                    <div class="form-group">
                                                        <label class="form-label" for="exampleInputEmail1title">ФИО:</label>
                                                        <input type="text" class="form-control" name="client_name" id="exampleInputEmail1title" value="{{old('client_name')}}" placeholder="Введите ФИО клиента">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="exampleInputEmail1title">Email:</label>
                                                        <input type="email" class="form-control" name="email"  value="{{old('email')}}" placeholder="Введите email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="exampleInputEmail1title">Номер телефона:</label>
                                                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Введите номер телефона">
                                                    </div>
                                                    <hr>
                                                    <h3>Дополнительные поля для организаций</h3>
                                                    <div class="form-group">
                                                        <label class="form-label" for="exampleInputEmail1title">Наименование:</label>
                                                        <input type="text" class="form-control" name="orgName"  value="{{old('orgName')}}" placeholder="Введите наименование">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="exampleInputEmail1title">ОГРН/ОГРНИП:</label>
                                                        <input type="text" class="form-control" name="ogrn"  value="{{old('ogrn')}}" placeholder="Введите ОГРН/ОГРНИП">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="exampleInputEmail1title">ИНН:</label>
                                                        <input type="text" class="form-control" name="inn"  value="{{old('inn')}}" placeholder="Введите ИНН">
                                                    </div>
                                                </div>
                                                </div>



                                            <div class="tab-pane" id="project_info">
                                                <p>Проект</p>
                                                <div class="form-group">
                                                    <label class="form-label" for="exampleInputEmail1title">Project Name:</label>
                                                    <input type="text" class="form-control" name="title" id="exampleInputEmail1title" value="{{old('title')}}" placeholder="Enter name ..">
                                                </div>

                                                {{--                                                <div class="form-group">--}}
                                                {{--                                                    <label class="form-label" for="exampleInputEmail1price">Project Price:</label>--}}
                                                {{--                                                    <input type="number" class="form-control" name="price" id="exampleInputEmail1price" value="{{old('price')}}" placeholder="Enter price ..">--}}
                                                {{--                                                </div>--}}

                                                <div class="form-group simple_projects">
                                                    <button class="add_field_button btn-success btn-sm" type="button">+</button>
                                                    <div class="custom-file firstInputSimple">
                                                        <input type="file"  class="custom-file-input input-simple" name="simple_projects[]" >
                                                        <label for="file" class="custom-file-label label-simple" >Simple Projects</label>
                                                    </div>
                                                </div>

                                                <div class="form-group project_appendices">
                                                    <button class="add_field_button_project btn-success btn-sm" type="button">+</button>
                                                    <div class="custom-file firstInputSimple">
                                                        <input type="file"  class="custom-file-input input-appendices" name="project_appendices[]">
                                                        <label for="file" class="custom-file-label label-appendices" >Project Appendices</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="exampleInputEmail1price">Images Count:</label>
                                                    <input type="number" class="form-control" name="images_count" id="images_count" min="0" value="{{old('images_count')}}" placeholder="Enter count ..">
                                                </div>

                                                <div class="form-group removePart" id="image_quality">
                                                    <label class="form-label" for="exampleInputEmail1price">Images Quality:</label>
                                                    <select name="image_quality" id="" class="form-control">
                                                        <option value="" disabled selected>Select..</option>
                                                        <option value="HD">HD</option>
                                                        <option value="HDV">HDV</option>
                                                        <option value="2K">2K</option>
                                                        <option value="4K UHDTV, Ultra HD Blu-ray">4K UHDTV, Ultra HD Blu-ray</option>
                                                        <option value="4K Digital Cinema">4K Digital Cinema</option>
                                                        <option value="8K UHDTV">8K UHDTV</option>
                                                        <option value="16K Digital Cinema">16K Digital Cinema</option>
                                                    </select>
                                                </div>

                                                <div class="form-group" id="availability_source_select">
                                                    <label class="form-label" for="exampleInputEmail1price">Availability of Source:</label>
                                                    <select name="availability_source"  class="form-control">
                                                        <option value="" disabled selected>Select..</option>
                                                        <option value="no">No</option>
                                                        <option value="yes">Yes</option>
                                                        </select>
                                                </div>

                                                <div class="form-group removePart" id="source_format">
{{--                                                    <label class="form-label" for="exampleInputEmail1price">Source format:</label>--}}
{{--                                                    <select name="source_format"  class="form-control">--}}
{{--                                                        <option value="" disabled selected>Select..</option>--}}
{{--                                                        <option value=".3Ds">.3Ds</option>--}}
{{--                                                        <option value=".Max">.Max</option>--}}
{{--                                                        <option value=".Obj">.Obj</option>--}}
{{--                                                        <option value=".Fbx">.Fbx</option>--}}
{{--                                                        <option value="other">other</option>--}}
{{--                                                    </select>--}}
                                                    <div class="form-check form-check-inline">
                                                        <input name="source_format[]" class="form-check-input" type="checkbox" id=".3Ds" value=".3Ds">
                                                        <label class="form-check-label" for=".3Ds">.3Ds</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input name="source_format[]" class="form-check-input" type="checkbox" id=".Max" value=".Max">
                                                        <label class="form-check-label" for=".Max">.Max</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input name="source_format[]" class="form-check-input" type="checkbox" id=".Obj" value=".Obj">
                                                        <label class="form-check-label" for=".Obj">.Obj</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input name="source_format[]" class="form-check-input" type="checkbox" id=".Fbx" value=".Fbx">
                                                        <label class="form-check-label" for=".Fbx">.Fbx</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input name="source_format[]" class="form-check-input" type="checkbox" id="other" value="other">
                                                        <label class="form-check-label" for="other">other</label>
                                                    </div>
                                                </div>


                                                <div class="form-group additional_requirements removePart" id="additional_requirements">
                                                    <button class="add_field_button_requirements btn-success btn-sm" type="button">+</button>
                                                    <div class="custom-file firstInputSimple">
                                                        <input type="text"  class="form-control input-requirements" name="additional_requirements[]" placeholder="Enter requirements ..">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="exampleInputEmail1description">Project Description:</label>
                                                    <textarea name="description" id="exampleInputEmail1description" cols="30" rows="6" class="form-control">{{old('description')}}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="exampleInputEmail1technical_task">Technical Task:</label>
                                                    <textarea name="technical_task" id="exampleInputEmail1technical_task" cols="30" rows="6" class="cdk_editor form-control">{{old('technical_task')}}</textarea>
                                                </div>
                                            </div>


                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 page-nav">
                    <div class="page-section pt-lg-112pt">
                        <nav class="nav page-nav__menu">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a href="#client" data-toggle="tab" class="nav-link active">Клиент</a></li>
                                <li><a href="#project_info" data-toggle="tab" class="nav-link">Проект</a></li>
                            </ul>
                        </nav>
                        <div class="page-nav__content">
                            <button type="submit" class="btn btn-accent-dodger-blue">Создать проект</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <style>
        .note-popover.popover{
            opacity: 0!important;
        }
        .simple_projects .firstInputSimple,.project_appendices .firstInputSimple, .additional_requirements .firstInputSimple{
            display: inline-block!important;
            width: 92%!important;
            margin-top: 0px!important;
        }
        .simple_projects > button, .add_field_button_project, .add_field_button_requirements{
            display: inline-block!important;
            padding: 4px 16px!important;
            vertical-align: top!important;
            font-size: 20px!important;
        }
        .simple_projects .custom-file, .project_appendices .custom-file, .additional_requirements .custom-file{
            margin-top: 10px;
        }
        .custom-file > div{
            display: inline-block!important;
            width: 92%!important;
        }
        #myTab li{
            display: block;
            width: 100%;
        }
        [dir=ltr] .nav-tabs .nav-link {
             border: none;
        }
        .showPart{
            display: block;
        }
        .removePart{
            display: none;
        }
        [dir=ltr] .page-nav{
            max-height: 100%!important;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {
//          Simple Project
            $(document).on('change','.input-simple',function () {
                var html = '';
                for (var i=0;i < $(this)[0].files.length;i++){
                    html += $(this)[0].files[i].name;
                }
                $(this).siblings('.label-simple').text(html)
            });

            var max_fields = 10;
            var wrapper = $(".simple_projects");
            var add_button = $(".add_field_button");
            var x = 1;
            $(add_button).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    // $(wrapper).append('<div class="custom-file"> <input type="file" id="fileImages" class="custom-file-input" name="simple_projects" > <label for="file" class="custom-file-label" id="fileImagesLabel">Choose images</label> <button type="button"  class="btn btn-danger remove_field">X</button></div>'); //add input box
                    $(wrapper).append('<div class="custom-file"> <input type="file"  class="custom-file-input input-simple" name="simple_projects[]" > <label for="file" class="custom-file-label label-simple" >Simple Projects</label></div>'); //add input box
                }
            });
            // $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            //     e.preventDefault(); $(this).parent('div').remove(); x--;
            // })



//          Project Appendices
            $(document).on('change','.input-appendices',function () {
                var html = '';
                for (var i=0;i < $(this)[0].files.length;i++){
                    html += $(this)[0].files[i].name;
                }
                $(this).siblings('.label-appendices').text(html)
            });

            var max_fields1 = 10;
            var wrapper1 = $(".project_appendices");
            var add_button1 = $(".add_field_button_project");
            var y = 1;
            $(add_button1).click(function(e){
                e.preventDefault();
                if(y < max_fields1){
                    y++;
                    $(wrapper1).append('<div class="custom-file"> <input type="file"  class="custom-file-input input-appendices" name="project_appendices[]"> <label for="file" class="custom-file-label label-appendices" >Project Appendices</label></div>'); //add input box
                }
            });



//          Check Image Count
            $(document).on('input','#images_count',function () {
                if(+$(this).val() === 0 && $(this).val() != ''){
                    $('#availability_source_select').removeClass('removePart')
                }else{
                    //$('#availability_source_select').addClass('removePart');
                    $('#additional_requirements').addClass('removePart');
                }

                if($(this).val() != '' && +$(this).val() !== 0){
                    $('#image_quality').removeClass('removePart')
                }else{
                    $('#image_quality').addClass('removePart')
                }
            });


//          Check Availability Type
            $(document).on('change','#availability_source_select',function (e) {
               console.log(e.target.value === 'no' && e.target.value != '' && +$('#images_count').val() === 0)
                if(e.target.value === 'no' && e.target.value != ''){
                    $('#additional_requirements').removeClass('removePart');
                }else{
                    $('#additional_requirements').addClass('removePart');
                }

                if(e.target.value != '' && e.target.value === 'yes'){
                    $('#source_format').removeClass('removePart');
                }else{
                    $('#source_format').addClass('removePart');
                }
            });
            let client_exists = document.querySelectorAll("[name='client_exists']");
            for (var i = 0; i < client_exists.length; i++) {
                client_exists[i].onchange = function (e) {
                    console.log(e.target.value)
                    if (e.target.value == 1){
                        $('#create_client').removeClass('removePart');
                        $('#client_exists').addClass('removePart');

                    }else{
                        $('#client_exists').removeClass('removePart');
                        $('#create_client').addClass('removePart');
                    }
                }
            }
            // $(document).on('change','#availability_source_select',function (e) {
            //     console.log(e.target);
            // });



//          Additional Requirements
            var max_fields2 = 10;
            var wrapper2 = $(".additional_requirements");
            var add_button2 = $(".add_field_button_requirements");
            var z = 1;
            $(add_button2).click(function(e){
                e.preventDefault();
                if(z < max_fields2){
                    z++;
                    // $(wrapper).append('<div class="custom-file"> <input type="file" id="fileImages" class="custom-file-input" name="simple_projects" > <label for="file" class="custom-file-label" id="fileImagesLabel">Choose images</label> <button type="button"  class="btn btn-danger remove_field">X</button></div>'); //add input box
                    $(wrapper2).append('<div class="custom-file"> <input type="text"  class="form-control input-requirements" name="additional_requirements[]" placeholder="Enter requirements .."></div>'); //add input box
                }
            });


//          Form Submit
            $(document).on('click','.btn.btn-accent-dodger-blue',function () {
                $('#createProject').submit()
            })


        })
    </script>
@endsection
