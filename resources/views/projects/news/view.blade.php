@extends('layout/app')

@section('content')
    <div class="formBlock">
        <div class="container">
            <div class="row">
                <h3 class="w-100">Хронология проекта "{{$project->title}}"</h3>

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
                    @if(\App\User::isAllowed('addNews'))
                        <a href="{{route('projectNewsCreate',$id )}}"
                           data-toggle="tooltip" class="btn btn-info btn-sm"
                           role="button">Добавить новость</a>
                    @endif

                    @php($status = json_decode($project->status)->name)

                    @canEdit($status)
                    @if((\App\Project::STATUS[$status]['fields'][0] == 'only' && count( \App\Project::STATUS[$status]['fields'] ) > 1 ) || \App\Project::STATUS[$status]['fields'][0] != 'only')
                        <a href="{{route('editProject', ['id'=>$project->id])}}"
                           data-toggle="tooltip" class="btn btn-info btn-sm"
                           role="button">Редактировать</a>
                    @endif

                    @endcanEdit

                    @canEdit($status)
                    @if(\App\Project::STATUS[$status]['fields'][0] == 'only' && count( \App\Project::STATUS[$status]['fields'] ) == 1 )
                        @nextStageBtn( $status )
                    @endif
                    @endcanEdit

                    @if($status == 'pays')
                        Оплатите {{$project->price}} руб. по указанным ниже реквизитам и отправьте проект на проверку
                        оплаты
                    @endif

                    @php($simple_link = json_decode($project->simple_projects))
                    @if($simple_link)
                        <div class="alert alert-dark">
                            <h5>Примеры исполнения</h5>
                            @foreach($simple_link as $link)
                                <a target="_blank"
                                   href="{{ '/storage/update/'.$link }}">{{'/storage/update/'.$link }}</a>
                                <br>
                            @endforeach
                        </div>
                    @endif
                    @php($simple_appendices = json_decode($project->project_appendices))
                    @if($simple_appendices)
                        <div class="alert alert-dark">
                            <h5>Приложения к проекту</h5>
                            @foreach($simple_appendices as $link)
                                <a target="_blank"
                                   href="{{ '/storage/update/'.$link }}">{{'/storage/update/'.$link }}</a>
                                <br>
                            @endforeach
                        </div>
                    @endif

                    Создан {{$project->created_at}} <br>
                    Стоимость {{$project->price}} руб. <br>
                    @php($results = json_decode($project->project_results) )
                    Количество рендеров:{{$results->images_count}} <br>
                    @if($results->images_count > 0) Качество рендеров: {{$results->image_quality}} @endif <br>
                    {{$results->availability_source == "yes" ? "Исходник нужен" : "Исходник не нужен"}}
                    @if($results->availability_source == "yes")
                        в формате:
                        @foreach($results->source_format as $format)
                            {{$format}}
                        @endforeach
                    @endif
                    @if($results->availability_source == "yes")
                        в формате:
                        @foreach($results->source_format as $format)
                            {{$format}}
                        @endforeach
                    @endif
                    <h5>Описание</h5>
                    <div class="alert alert-secondary">
                        {{$project->description}}
                    </div>
                    <h5>Техническое задание</h5>
                    <div class="alert alert-secondary">
                        {!! $project->technical_task !!}
                    </div>


                    {{--                        @foreach($history as $item)--}}
                    {{--                            {{$item->date}} пользователь {{$item->activist}}--}}
                    {{--                        @endforeach--}}
                    @foreach($news as $node)
                        <div
                            class="alert @if($node->approved == 1 ) alert-success @else {{$node->approved === 0 ? 'alert-danger': 'alert-secondary'}} @endif"
                            role="alert">
                            {{$node->text}}
                            {{$node->id}}
                            @php($attachment = json_decode($node->attachment))
                            @if($attachment)
                                <div class="alert alert-dark" role="alert">

                                    @foreach($attachment as $link)
                                        <div>
                                            <a target="_blank" href="/storage/update/{{$link}}">Ссылка на
                                                вложение {{$link}}</a>
                                        </div>
                                    @endforeach

                                </div>
                            @endif
                            @if($node->approved === null)
                                <div>
                                    <form action="{{route('projectNewsSuccess',$node->id)}}" method="POST">
                                        <div class="btn-group">

                                            @csrf
                                            @method('patch')

                                            <button type="submit" class="btn btn-success">Одобрить</button>
                                            <button type="button"
                                                    onclick="document.querySelector('#comment{{$node->id}}').style.display = 'block'"
                                                    class="btn btn-danger">Отклонить
                                            </button>


                                        </div>
                                    </form>
                                </div>

                            @endif
                            @php($comments = json_decode($node->comments))
                            @if($comments)

                                @foreach($comments as $comment)
                                    <div class="alert alert-dark">
                                        id{{$comment->user}} написал:
                                        {{$comment->text}}
                                    </div>
                                @endforeach
                            @endif
                            <div id="comment{{$node->id}}" @if($node->approved !== 0) style="display: none" @endif>
                                <form action="{{route('projectNewsComment',$node->id)}}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <textarea name="comment" placeholder="Введите причину отклонения"
                                              style="width: 100%;"
                                              rows="2"></textarea>
                                    <input type="submit" value="Отправить">
                                </form>

                            </div>

                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

