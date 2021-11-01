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
                    @isset($users)
                        <div class="tab-content" style="margin-top: 50px">
                            @foreach($tabs as $key=>$tab)
                                <div class="tab-pane {{$key == 0 ? 'active' : null}}" id="{{$tab}}">
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Banned</th>
                                            <th>Parent Id</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
{{--                                        @foreach($users as $key=>$items)--}}
{{--                                            @if($tab == $key)--}}
                                                @foreach($users[$tab] as $key=>$user)
                                                    <tr>
                                                        <td>{{$user->id}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{ucwords(str_replace('_', ' ', $user->role))}}</td>
                                                        <td>{{$user->banned == 0 ? 'No' : 'Yes'}}</td>
                                                        <td>{{$user->parent_id}}</td>
                                                        <td>
                                                            @if($canEdit)
                                                            <a href="{{route('editUser', ['id'=>$user->id])}}"
                                                               data-toggle="tooltip" class="btn btn-info btn-sm"
                                                               role="button">Edit</a>
                                                            @endif
                                                            @if($canDelete)
                                                                <div class="modal fade"
                                                                     id="deleteModalNews_{{$user->id}}" tabindex="-1"
                                                                     role="dialog" aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel"></h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Are you sure you want to
                                                                                delete {{$user->name}}?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary btn-sm"
                                                                                        data-dismiss="modal"
                                                                                        style="display: inline-block">No
                                                                                </button>
                                                                                <form
                                                                                    action="{{route('deleteUser', ['id'=>$user->id])}}"
                                                                                    method="POST"
                                                                                    style="display: inline">
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden"
                                                                                           value="{{$user->id}}"
                                                                                           name="id">
                                                                                    <button type="submit"
                                                                                            class="btn btn-danger btn-sm"
                                                                                            title="Delete"
                                                                                            data-toggle="modal"
                                                                                            data-target="#deleteModalNews_{{$user->id}}">
                                                                                        Delete
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                        title="Delete" data-toggle="modal"
                                                                        data-target="#deleteModalNews_{{$user->id}}">
                                                                    Delete
                                                                </button>
                                                            @endif
                                                            @if($canBaned)
                                                                <div class="modal fade"
                                                                     id="deleteModalBanned_{{$user->id}}" tabindex="-1"
                                                                     role="dialog" aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel"></h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Are you sure you want
                                                                                to {{$user->banned == 0 ? 'banned' : 'unbanned'}} {{$user->name}}
                                                                                ?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary btn-sm"
                                                                                        data-dismiss="modal"
                                                                                        style="display: inline-block">No
                                                                                </button>
                                                                                <form
                                                                                    action="{{route('banedUser', ['id'=>$user->id])}}"
                                                                                    method="POST"
                                                                                    style="display: inline">
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden"
                                                                                           value="{{$user->id}}"
                                                                                           name="id">
                                                                                    <input type="hidden"
                                                                                           value="{{~$user->banned}}"
                                                                                           name="banned">
                                                                                    <button type="submit"
                                                                                            class="btn btn-danger btn-sm"
                                                                                            title="Delete"
                                                                                            data-toggle="modal"
                                                                                            data-target="#deleteModalNews_{{$key}}">
                                                                                        {{$user->banned == 0 ? 'Banned' : 'Unbanned'}}
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                        title="Banned" data-toggle="modal"
                                                                        data-target="#deleteModalBanned_{{$user->id}}">
                                                                    {{$user->banned == 0 ? 'Banned' : 'Unbanned'}}
                                                                </button>
{{--                                                            @endif--}}
                                                        </td>
                                                    </tr>
{{--                                                @endforeach--}}
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
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


