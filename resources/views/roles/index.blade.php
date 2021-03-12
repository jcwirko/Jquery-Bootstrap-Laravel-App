@extends('layouts.admin')

@section('titulo-seccion')
    Roles
    <a href="" class="btn btn-primary btn-circle btn-modal-create" data-toggle="modal" data-target="#createMdl">
        <i class="fas fa-plus"></i>
    </a>
@endsection

@section('contenido')

    @include('roles.modals.create')
    @include('roles.modals.delete')
    @include('roles.modals.edit')

    <div class="cards">
        @if($roles->count())
            @foreach ($roles->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $role)
                        <div class="col-md-4">
                            <div class="contact-box center-version well">
                                <div class="contact-box-content">
                                    <h3 class="m-b-xs">
                                        <strong title="Empresa {{$role->name}}">
                                            {{$role->name}}
                                        </strong>
                                    </h3>
                                    <p class="pt-1 text-center">
                                        {{$role->title}}
                                    </p>
                                    <div class="mt-3">
                                        @if($role->abilities->count())
                                            @foreach ($role->abilities->chunk(3) as $chunk)
                                                <div class="row">
                                                    @foreach ($chunk as $ability)
                                                        <div class="col-md-4 text-center">
                                                            <span class="abilities-color">{{$ability->title}}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        @else
                                            <label class="label label-danger">No tiene permisos asignados</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="contact-box-footer">
                                    <div class="m-t-xs btn-group">
                                        <a href="" class="btn btn-xs btn-white" data-toggle="modal"
                                           data-target="#editMdl"
                                           onclick="editRole({{$role}})">
                                            <i class="fas fa-edit edit-el-form"></i>
                                            Editar
                                        </a>
                                        <a href="" class="btn btn-xs btn-white" data-toggle="modal"
                                           data-target="#deleteMdl"
                                           onclick="deleteRole({{$role}})">
                                            <i class="fas fa-trash delete-el-form"></i>
                                            Eliminar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>

@endsection

@push('scripts')

    <script>
        function editRole(role) {
            $("#editFrm").attr('action', `/roles/${role.name}`);

            $('#editFrm #name').val(role.name);
            $('#editFrm #title').val(role.title);

            role.abilities.forEach(ability => {
                $(`#editFrm #${ability.name}`).prop("checked", true);
            });
        }

        function deleteRole(role) {
            $("#deleteFrm").attr('action', `/roles/${role.name}`);
            $('#deleteFrm #roleName').text(role.name);
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
        @else
            <script>
                $(function () {
                    $('#createRoleFrm').trigger('reset');
                    $('#editMdl').removeClass('zoomIn');
                    $('#editMdl').addClass('shake');
                    $('#editMdl').modal('show');
                });
            </script>
        @endif
    @endif
@endpush
