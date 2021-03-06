@extends('layouts.admin')

@section('titulo-seccion')
    <span>
        Usuarios
    </span>
    <a href="" class="btn btn-primary btn-circle btn-modal-create" data-toggle="modal" data-target="#createMdl">
        <i class="fas fa-plus"></i>
    </a>
@endsection

@section('contenido')

    @include('users.modals.create')
    @include('users.modals.delete')
    @include('users.modals.update-role')

    <div class="card well">
        <div class="card-body">
            <table id="dt-users" class="table table-striped table-bordered dts" style="width:100%">
                <thead>
                <tr>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Fecha de nacimiento</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="text-center">
                        <td>{{$user->full_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->birthdate}}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <div>
                                    <label class="label label-primary">
                                        {{$role->name}}
                                    </label>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            @can('update-roles')
                                @if(auth()->user()->id != $user->id)
                                    <a href="" class="edit-el-form" data-toggle="modal" data-target="#editRoleUserMdl"
                                       onclick="editRoleUserModal({{$user}})" title="Actualizar Roles">
                                        <i class="fas fa-cogs"></i>
                                    </a>
                                @endif
                            @endcan
                            <a href="" class="delete-el-form" data-toggle="modal" data-target="#deleteMdl"
                               onclick="deleteUser({{$user}})" title="Eliminar Usuario">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('/libs/datatables/dataTables.min.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('/libs/datatables/dataTables.min.js')}}"></script>
    <script src="{{asset('/libs/datatables/dataTables.bs4.min.js')}}"></script>

    <script>
        function deleteUser(user) {
            $("#deleteUserFrm").attr('action', `/users/${user.id}`);
            $('#deleteUserFrm #userName').text(user.full_name);
        }

        function editRoleUserModal(user) {
            $("#editRoleUserFrm").attr('action', `/users/${user.id}/roles`);

            $('input:checkbox').removeAttr('checked');

            user.roles.forEach(role => {
                $(`#editRoleUserFrm #${role.name}`).prop("checked", true);
            });
        }
    </script>

    @if(!$errors->isEmpty())
        @if($errors->has('post'))
            <script>
                $(function () {
                    $('#createMdl').removeClass('zoomIn');
                    $('#createMdl').addClass('shake');
                    $('#createMdl').modal('show');
                });
            </script>
        @endif
    @endif
@endpush
