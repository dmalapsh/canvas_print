@extends('layout/app')

@section('content')
    <div class="container page__container">

        <div class="row">

            <div class="col-lg-8 pr-lg-0">
                <form id="createProject" action="{{route('editProject',$id)}}" method="post" class="flex"
                      enctype="multipart/form-data">
                    <div class="formBlock">
                        <div class="container">
                            <div class="row">
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

                                    @csrf
                                    @method('PATCH')
                                    <div class="form-check form-check-inline">
                                        <input name="next" class="form-check-input" type="checkbox" id="other"
                                               value="other">
                                        <label class="form-check-label" for="other">Передать на этап
                                            "{{\App\Project::nextStage($project->status)['name']}}"</label>
                                    </div>
                                    <div class="tab-content" style="margin-top: 50px">
                                        <div class="tab-pane active" id="client">
                                            <div id="client_exists">
                                                <div class="form-group">
                                                    <label class="form-label">Id пользователя:</label>
                                                    <input disabled type="number" class="form-control" name="client_id"
                                                           id="images_count" min="0" value="{{$project->client_id}}"
                                                           placeholder="Enter id ..">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab-pane" id="project_info">
                                            <div class="form-group">
                                                <label class="form-label" for="exampleInputEmail1title">Project
                                                    Name:</label>
                                                <input @isFields('title') disabled @endisFields type="title"
                                                class="form-control" name="title"
                                                id="exampleInputEmail1title" value="{{$project->title}}"
                                                placeholder="Enter name ..">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="exampleInputEmail1price">Project
                                                    Price:</label>
                                                <input type="number" @isFields('price') disabled @endisFields
                                                class="form-control" name="price" min="0"
                                                id="exampleInputEmail1price" value="{{$project->price}}"
                                                placeholder="Enter price ..">
                                            </div>

                                            <div class="form-group simple_projects">
                                                <button @isFields(
                                                'simple_projects[]') disabled @endisFields class="add_field_button
                                                btn-success btn-sm"
                                                type="button">+
                                                </button>
                                                <div class="custom-file firstInputSimple">
                                                    <input @isFields('simple_projects[]') disabled @endisFields
                                                    type="file" class="custom-file-input input-simple"
                                                    name="simple_projects[]">
                                                    <label for="file" class="custom-file-label label-simple">Simple
                                                        Projects</label>
                                                </div>
                                                @php($simple_link = json_decode($project->simple_projects))
                                                @if($simple_link)
                                                    @foreach($simple_link as $link)
                                                        <a target="_blank"
                                                           href="{{ '/storage/update/'.$link }}">{{'/storage/update/'.$link }}</a>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div class="form-group project_appendices">
                                                <button @isFields(
                                                'project_appendices[]') disabled @endisFields
                                                class="add_field_button_project btn-success btn-sm"
                                                type="button">+
                                                </button>
                                                <div class="custom-file firstInputSimple">
                                                    <input @isFields('project_appendices[]') disabled @endisFields
                                                    type="file" class="custom-file-input input-appendices"
                                                    name="project_appendices[]">
                                                    <label for="file" class="custom-file-label label-appendices">Project
                                                        Appendices</label>
                                                </div>
                                                {{$project->project_appendices}}
                                            </div>
                                            @php($results = json_decode($project->project_results) )
                                            <div class="form-group">
                                                <label class="form-label" for="exampleInputEmail1price">Images
                                                    Count:</label>
                                                <input @isFields('images_count') disabled @endisFields type="number"
                                                class="form-control" name="images_count"
                                                id="images_count" min="0" value="{{$results->images_count}}"
                                                placeholder="Enter count ..">
                                            </div>

                                            <div
                                                class="{{$results->images_count>0?"form-group":'form-group removePart'}}"
                                                id="image_quality">
                                                <label class="form-label" for="exampleInputEmail1price">Images
                                                    Quality:</label>
                                                <select @isFields('image_quality') disabled @endisFields
                                                name="image_quality" id="" class="form-control">
                                                <option
                                                    value="{{isset($results->image_quality)?$results->image_quality:false}}"
                                                    disabled
                                                    selected>{{isset($results->image_quality)?$results->image_quality:'Select..'}}</option>
                                                <option value="HD">HD</option>
                                                <option value="HDV">HDV</option>
                                                <option value="2K">2K</option>
                                                <option value="4K UHDTV, Ultra HD Blu-ray">4K UHDTV, Ultra HD
                                                    Blu-ray
                                                </option>
                                                <option value="4K Digital Cinema">4K Digital Cinema</option>
                                                <option value="8K UHDTV">8K UHDTV</option>
                                                <option value="16K Digital Cinema">16K Digital Cinema</option>
                                                </select>
                                            </div>

                                            <div class="form-group" id="availability_source_select">
                                                <label class="form-label" for="exampleInputEmail1price">Availability of
                                                    Source:</label>
                                                <select @isFields('availability_source') disabled @endisFields
                                                name="availability_source" class="form-control">
                                                <option value="{{$results->availability_source}}" disabled
                                                        selected>{{$results->availability_source}}</option>
                                                <option value="no">No</option>
                                                <option value="yes">Yes</option>
                                                </select>
                                            </div>

                                            <div
                                                class="{{$results->availability_source=='yes'?'form-group':'form-group removePart'}}"
                                                id="source_format">
                                                {{--                                                                                                    <label class="form-label" for="exampleInputEmail1price">Source format:</label>--}}
                                                {{--                                                                                                    <select name="source_format"  class="form-control">--}}
                                                {{--                                                                                                        <option value="" disabled selected>Select..</option>--}}
                                                {{--                                                                                                        <option value=".3Ds">.3Ds</option>--}}
                                                {{--                                                                                                        <option value=".Max">.Max</option>--}}
                                                {{--                                                                                                        <option value=".Obj">.Obj</option>--}}
                                                {{--                                                                                                        <option value=".Fbx">.Fbx</option>--}}
                                                {{--                                                                                                        <option value="other">other</option>--}}
                                                {{--                                                                                                    </select>--}}
                                                {{--                                                                                                    @if(!isset($results->source_format)) @php($results->source_format = array()) @endif--}}
                                                <div class="form-check form-check-inline">
                                                    <input @isFields('availability_source') disabled @endisFields
                                                    name="source_format[]" class="form-check-input"
                                                    type="checkbox" id=".3Ds" value=".3Ds"
                                                    @if(isset($results->source_format) && in_array('.3Ds',$results->source_format))
                                                        checked @endif>
                                                    <label class="form-check-label" for=".3Ds">.3Ds</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input @isFields('availability_source') disabled @endisFields
                                                    name="source_format[]" class="form-check-input"
                                                    type="checkbox" id=".Max" value=".Max"
                                                    @if(isset($results->source_format) && in_array('.Max',$results->source_format))
                                                        checked @endif>
                                                    <label class="form-check-label" for=".Max">.Max</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input @isFields('availability_source') disabled @endisFields
                                                    name="source_format[]" class="form-check-input"
                                                    type="checkbox" id=".Obj" value=".Obj"
                                                    @if(isset($results->source_format) && in_array('.Obj',$results->source_format))
                                                        checked @endif>
                                                    <label class="form-check-label" for=".Obj">.Obj</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input @isFields('availability_source') disabled @endisFields
                                                    name="source_format[]" class="form-check-input"
                                                    type="checkbox" id=".Fbx" value=".Fbx"
                                                    @if(isset($results->source_format) && in_array('.Fbx',$results->source_format))
                                                        checked @endif>
                                                    <label class="form-check-label" for=".Fbx">.Fbx</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input @isFields('availability_source') disabled @endisFields
                                                    name="source_format[]" class="form-check-input"
                                                    type="checkbox" id="other" value="other"
                                                    @if(isset($results->source_format) && in_array('other',$results->source_format))
                                                        checked @endif>
                                                    <label class="form-check-label" for="other">other</label>
                                                </div>
                                            </div>


                                            <div class="form-group additional_requirements removePart"
                                                 id="additional_requirements">
                                                <button @isFields(
                                                'additional_requirements[]') disabled @endisFields
                                                class="add_field_button_requirements btn-success btn-sm"
                                                type="button">+
                                                </button>
                                                <div class="custom-file firstInputSimple">
                                                    <input @isFields('additional_requirements[]') disabled @endisFields
                                                    type="text" class="form-control input-requirements"
                                                    name="additional_requirements[]"
                                                    placeholder="Enter requirements ..">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="exampleInputEmail1description">Project
                                                    Description:</label>
                                                <textarea @isFields('description') disabled @endisFields
                                                name="description" id="exampleInputEmail1description"
                                                cols="30" rows="6"
                                                class="form-control">{{$project->description}}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="exampleInputEmail1technical_task">Technical
                                                    Task:</label>
                                                <textarea @isFields('technical_task') disabled @endisFields
                                                name="technical_task" id="exampleInputEmail1technical_task"
                                                cols="30" rows="6"
                                                class="form-control
                                                @isFields('!technical_task') cdk_editor @endisFields" >
                                                {{$project->technical_task}} </textarea>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="payment">
                                            <p>Оплата</p>
                                            В данный момент оплата производится через
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 page-nav">
                <div class="page-section pt-lg-112pt">
                    <nav class="nav page-nav__menu">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#client" data-toggle="tab"
                                                  class="nav-link active">Клиент</a></li>
                            <li><a href="#project_info" data-toggle="tab" class="nav-link">Проект</a></li>
                            <li><a href="#payment" data-toggle="tab" class="nav-link">Оплата</a></li>
                        </ul>
                    </nav>
                    <div class="page-nav__content" style="margin-bottom: 40px;">

                        <button type="submit" class="btn btn-accent-dodger-blue">Сохранить</button>

                    </div>
{{--                    @if(\App\Project::STATUS[json_decode($project->status)->name])--}}
{{--                    @dd(\App\Project::STATUS[json_decode($project->status)]['name']['trigger'])--}}
                    @isset(\App\Project::STATUS[json_decode($project->status)->name]['trigger'][1])
                    <div class="page-nav__content">
                        <form action="{{route('prevStatus',$id)}}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                    <textarea placeholder="Введите причину чтобы отклонить этап" name="comment" rows="4"
                                              class="form-control">{{old('description')}}</textarea>
                            </div>
                            {{--                                <button type="submit" class="btn btn-danger">Отклонить</button>--}}
                            <input class="btn btn-danger" value="Отклонить" type="submit">
                        </form>
                    </div>
                    @endisset
                </div>
            </div>
        </div>

    </div>


    <style>
        .note-popover.popover {
            opacity: 0 !important;
        }

        .simple_projects .firstInputSimple, .project_appendices .firstInputSimple, .additional_requirements .firstInputSimple {
            display: inline-block !important;
            width: 90% !important;
            margin-top: 0px !important;
        }

        .simple_projects > button, .add_field_button_project, .add_field_button_requirements {
            display: inline-block !important;
            padding: 4px 16px !important;
            vertical-align: top !important;
            font-size: 20px !important;
        }

        .simple_projects .custom-file, .project_appendices .custom-file, .additional_requirements .custom-file {
            margin-top: 10px;
        }

        .custom-file > div {
            display: inline-block !important;
            width: 92% !important;
        }

        #myTab li {
            display: block;
            width: 100%;
        }

        [dir=ltr] .nav-tabs .nav-link {
            border: none;
        }

        .showPart {
            display: block;
        }

        .removePart {
            display: none;
        }

        [dir=ltr] .page-nav {
            max-height: 100% !important;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {
//          Simple Project
            $(document).on('change', '.input-simple', function () {
                var html = '';
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    html += $(this)[0].files[i].name;
                }
                $(this).siblings('.label-simple').text(html)
            });

            var max_fields = 10;
            var wrapper = $(".simple_projects");
            var add_button = $(".add_field_button");
            var x = 1;
            $(add_button).click(function (e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    // $(wrapper).append('<div class="custom-file"> <input type="file" id="fileImages" class="custom-file-input" name="simple_projects" > <label for="file" class="custom-file-label" id="fileImagesLabel">Choose images</label> <button type="button"  class="btn btn-danger remove_field">X</button></div>'); //add input box
                    $(wrapper).append('<div class="custom-file"> <input type="file"  class="custom-file-input input-simple" name="simple_projects[]" > <label for="file" class="custom-file-label label-simple" >Simple Projects</label></div>'); //add input box
                }
            });
            // $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            //     e.preventDefault(); $(this).parent('div').remove(); x--;
            // })


//          Project Appendices
            $(document).on('change', '.input-appendices', function () {
                var html = '';
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    html += $(this)[0].files[i].name;
                }
                $(this).siblings('.label-appendices').text(html)
            });

            var max_fields1 = 10;
            var wrapper1 = $(".project_appendices");
            var add_button1 = $(".add_field_button_project");
            var y = 1;
            $(add_button1).click(function (e) {
                e.preventDefault();
                if (y < max_fields1) {
                    y++;
                    $(wrapper1).append('<div class="custom-file"> <input type="file"  class="custom-file-input input-appendices" name="project_appendices[]"> <label for="file" class="custom-file-label label-appendices" >Project Appendices</label></div>'); //add input box
                }
            });


//          Check Image Count
            $(document).on('input', '#images_count', function () {
                if (+$(this).val() === 0 && $(this).val() != '') {
                    $('#availability_source_select').removeClass('removePart')
                } else {
                    //$('#availability_source_select').addClass('removePart');
                    $('#additional_requirements').addClass('removePart');
                }

                if ($(this).val() != '' && +$(this).val() !== 0) {
                    $('#image_quality').removeClass('removePart')
                } else {
                    $('#image_quality').addClass('removePart')
                }
            });


//          Check Availability Type
            $(document).on('change', '#availability_source_select', function (e) {
                console.log(e.target.value === 'no' && e.target.value != '' && +$('#images_count').val() === 0)
                if (e.target.value === 'no' && e.target.value != '') {
                    $('#additional_requirements').removeClass('removePart');
                } else {
                    $('#additional_requirements').addClass('removePart');
                }

                if (e.target.value != '' && e.target.value === 'yes') {
                    $('#source_format').removeClass('removePart');
                } else {
                    $('#source_format').addClass('removePart');
                }
            });
            let client_exists = document.querySelectorAll("[name='client_exists']");
            for (var i = 0; i < client_exists.length; i++) {
                client_exists[i].onchange = function (e) {
                    console.log(e.target.value)
                    if (e.target.value == 1) {
                        $('#create_client').removeClass('removePart');
                        $('#client_exists').addClass('removePart');

                    } else {
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
            $(add_button2).click(function (e) {
                e.preventDefault();
                if (z < max_fields2) {
                    z++;
                    // $(wrapper).append('<div class="custom-file"> <input type="file" id="fileImages" class="custom-file-input" name="simple_projects" > <label for="file" class="custom-file-label" id="fileImagesLabel">Choose images</label> <button type="button"  class="btn btn-danger remove_field">X</button></div>'); //add input box
                    $(wrapper2).append('<div class="custom-file"> <input type="text"  class="form-control input-requirements" name="additional_requirements[]" placeholder="Enter requirements .."></div>'); //add input box
                }
            });


//          Form Submit
            $(document).on('click', '.btn.btn-accent-dodger-blue', function () {
                $('#createProject').submit()
            })


        })
    </script>
@endsection
