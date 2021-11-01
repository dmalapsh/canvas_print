@extends('layout/app')

@section('content')
    <div class="formBlock">
        <div class="container">
            <div class="row">
                <h2 class="w-100">Manage users</h2>
                <div class="w-100">
                    @if (session()->has('isSavedStatus'))
                        <div class="alert alert-info">{{ session()->get('isSavedStatus') }}</div>
                    @endif
                    @isset($tabs)
                        <ul class="nav nav-tabs" id="myTab">
                            @if(count($tabs)>1)
                                @foreach($tabs as $key=>$tab)
                                    {{--                                    <li class="nav-item {{$key == 0 ? 'active' : null}}">--}}
                                    <li class="nav-item {{$key == 0 ? 'active' : null}}">
                                        <a href="#{{$tab}}" data-toggle="tab" class="nav-link"
                                           style="text-transform: capitalize">{{str_replace('_', ' ', $tab)}}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @endisset
                <!-- Tab panes -->
                    @isset($projects)
                        <div class="tab-content" style="margin-top: 50px">

{{--                                <div class="tab-pane {{$key == 0 ? 'active' : null}}" id="{{$tab}}">--}}
                                <div class="tab-pane active">
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Название</th>
                                            <th>id клиента</th>
                                            <th>цена</th>
                                            <th>Создано</th>
                                            <th>Статус</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($projects as $project)
{{--                                        @foreach($users as $key=>$items)--}}
{{--                                            @if($tab == $key)--}}
{{--                                                @foreach($users[$tab] as $key=>$user)--}}
                                                    <tr>
                                                        <td>{{$project->id}}</td>
                                                        <td>{{$project->title}}</td>
                                                        <td>{{$project->client_id}}</td>
{{--                                                        <td>{{ucwords(str_replace('_', ' ', $project->role))}}</td>--}}
                                                        <td>{{$project->price}}</td>
                                                        <td>{{$project->created_at}}</td>
                                                        <td>{{\App\Project::statusName($project->status) }}</td>
                                                        <td>

                                                            @php($status = json_decode($project->status)->name)

                                                            @canEdit($status)
                                                                @if((\App\Project::STATUS[$status]['fields'][0] == 'only' && count( \App\Project::STATUS[$status]['fields'] ) > 1 ) || \App\Project::STATUS[$status]['fields'][0] != 'only')
                                                                    <a href="{{route('editProject', ['id'=>$project->id])}}"
                                                                       data-toggle="tooltip" class="btn btn-info btn-sm"
                                                                       role="button">Редактировать</a>
                                                                @endif
                                                            @endcanEdit

                                                            <a href="{{route('projectNews', ['id'=>$project->id])}}"
                                                               data-toggle="tooltip" class="btn btn-info btn-sm"
                                                               role="button">Хроология</a>
{{--                                                            @endif--}}
{{--                                                            @if($canDelete)--}}
{{--                                                                <div class="modal fade"--}}
{{--                                                                     id="deleteModalNews_{{$user->id}}" tabindex="-1"--}}
{{--                                                                     role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--                                                                     aria-hidden="true">--}}
{{--                                                                    <div class="modal-dialog" role="document">--}}
{{--                                                                        <div class="modal-content">--}}
{{--                                                                            <div class="modal-header">--}}
{{--                                                                                <h5 class="modal-title"--}}
{{--                                                                                    id="exampleModalLabel"></h5>--}}
{{--                                                                                <button type="button" class="close"--}}
{{--                                                                                        data-dismiss="modal"--}}
{{--                                                                                        aria-label="Close">--}}
{{--                                                                                    <span--}}
{{--                                                                                        aria-hidden="true">&times;</span>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="modal-body">--}}
{{--                                                                                Are you sure you want to--}}
{{--                                                                                delete {{$user->name}}?--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="modal-footer">--}}
{{--                                                                                <button type="button"--}}
{{--                                                                                        class="btn btn-secondary btn-sm"--}}
{{--                                                                                        data-dismiss="modal"--}}
{{--                                                                                        style="display: inline-block">No--}}
{{--                                                                                </button>--}}
{{--                                                                                <form--}}
{{--                                                                                    action="{{route('deleteUser', ['id'=>$user->id])}}"--}}
{{--                                                                                    method="POST"--}}
{{--                                                                                    style="display: inline">--}}
{{--                                                                                    {{ csrf_field() }}--}}
{{--                                                                                    <input type="hidden"--}}
{{--                                                                                           value="{{$user->id}}"--}}
{{--                                                                                           name="id">--}}
{{--                                                                                    <button type="submit"--}}
{{--                                                                                            class="btn btn-danger btn-sm"--}}
{{--                                                                                            title="Delete"--}}
{{--                                                                                            data-toggle="modal"--}}
{{--                                                                                            data-target="#deleteModalNews_{{$user->id}}">--}}
{{--                                                                                        Delete--}}
{{--                                                                                    </button>--}}
{{--                                                                                </form>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <button type="button" class="btn btn-danger btn-sm"--}}
{{--                                                                        title="Delete" data-toggle="modal"--}}
{{--                                                                        data-target="#deleteModalNews_{{$user->id}}">--}}
{{--                                                                    Delete--}}
{{--                                                                </button>--}}
{{--                                                            @endif--}}
{{--                                                            @if($canBaned)--}}
{{--                                                                <div class="modal fade"--}}
{{--                                                                     id="deleteModalBanned_{{$user->id}}" tabindex="-1"--}}
{{--                                                                     role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--                                                                     aria-hidden="true">--}}
{{--                                                                    <div class="modal-dialog" role="document">--}}
{{--                                                                        <div class="modal-content">--}}
{{--                                                                            <div class="modal-header">--}}
{{--                                                                                <h5 class="modal-title"--}}
{{--                                                                                    id="exampleModalLabel"></h5>--}}
{{--                                                                                <button type="button" class="close"--}}
{{--                                                                                        data-dismiss="modal"--}}
{{--                                                                                        aria-label="Close">--}}
{{--                                                                                    <span--}}
{{--                                                                                        aria-hidden="true">&times;</span>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="modal-body">--}}
{{--                                                                                Are you sure you want--}}
{{--                                                                                to {{$user->banned == 0 ? 'banned' : 'unbanned'}} {{$user->name}}--}}
{{--                                                                                ?--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="modal-footer">--}}
{{--                                                                                <button type="button"--}}
{{--                                                                                        class="btn btn-secondary btn-sm"--}}
{{--                                                                                        data-dismiss="modal"--}}
{{--                                                                                        style="display: inline-block">No--}}
{{--                                                                                </button>--}}
{{--                                                                                <form--}}
{{--                                                                                    action="{{route('banedUser', ['id'=>$user->id])}}"--}}
{{--                                                                                    method="POST"--}}
{{--                                                                                    style="display: inline">--}}
{{--                                                                                    {{ csrf_field() }}--}}
{{--                                                                                    <input type="hidden"--}}
{{--                                                                                           value="{{$user->id}}"--}}
{{--                                                                                           name="id">--}}
{{--                                                                                    <input type="hidden"--}}
{{--                                                                                           value="{{~$user->banned}}"--}}
{{--                                                                                           name="banned">--}}
{{--                                                                                    <button type="submit"--}}
{{--                                                                                            class="btn btn-danger btn-sm"--}}
{{--                                                                                            title="Delete"--}}
{{--                                                                                            data-toggle="modal"--}}
{{--                                                                                            data-target="#deleteModalNews_{{$key}}">--}}
{{--                                                                                        {{$user->banned == 0 ? 'Banned' : 'Unbanned'}}--}}
{{--                                                                                    </button>--}}
{{--                                                                                </form>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <button type="button" class="btn btn-danger btn-sm"--}}
{{--                                                                        title="Banned" data-toggle="modal"--}}
{{--                                                                        data-target="#deleteModalBanned_{{$user->id}}">--}}
{{--                                                                    {{$user->banned == 0 ? 'Banned' : 'Unbanned'}}--}}
{{--                                                                </button>--}}
{{--                                                            @endif--}}
                                                        </td>
                                                    </tr>
                                                @endforeach
{{--                                            @endif--}}
{{--                                        @endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
{{--                            @endforeach--}}
                        </div>
                    @endisset


                </div>
            </div>
        </div>
    </div>
    <style>
        [dir=ltr] .nav-tabs .nav-item.show .nav-link, [dir=ltr] .nav-tabs .nav-link.active {
            color: #272c33;
            background-color: #f5f7fa;
            border-color: transparent transparent #3d74c5;
        }
    </style>

@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#myTab a', function () {
                $('#myTab li').removeClass('active');
                $(this).parent().addClass('active');

            })
        })
    </script>
@endsection


