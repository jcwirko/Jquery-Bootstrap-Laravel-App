@extends('layouts.admin')

@section('titulo-seccion')
    <span>
        Roles
    </span>
    <a href="" class="btn btn-primary btn-circle btn-modal-create" data-toggle="modal" data-target="#createMdl">
        <i class="fas fa-plus"></i>
    </a>
@endsection

@section('contenido')

    @include('roles.modals.create')

    <div class="card well">
        <div class="card-body">
            <form action="{{route('roles.grid.store')}}" method="POST">
                @csrf
                <table class="table table-bordered form-group tabla-permisos">
                    <tbody>
                    <tr>
                        <th width="50px"
                            style="background: linear-gradient(to top right, white 49.5%, #aaa 49.5%, #aaa 50.5%, white 50.5%);
                    ">
                            <div style="margin-left:2em;text-align:right;"><span style="color:#1c84c6">Roles</span>
                            </div>
                            <div style="margin-right:2em;text-align:left;"><span style="color:#1c84c6">Permisos</span>
                            </div>
                        </th>
                        @if($roles->count())
                            @foreach ($roles as $role)
                                <th class="text-center" width="120px">
                                    {{$role->name}}
                                </th>
                            @endforeach
                        @endif
                    </tr>
                    @foreach($abilities as $ability)
                        <tr class="text-center">
                            <th width="50px">
                                {{$ability->title}}
                            </th>
                            @foreach($roles as $role)
                                <td>
                                    <input type="checkbox"
                                           name="roles[{{$role->name}}][{{$ability->name}}]"
                                           {{$role->abilities->pluck('name')->contains($ability->name) ? 'checked' : '' }} value="{{$ability->name}}"/>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-2 mb-2 mr-2">
                    <div class="buttons-form-submit d-flex justify-content-end">
                        <a type="submit" href="#" class="btn btn-primary">
                            Actualizar
                            <i class="fas fa-spinner fa-spin d-none"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
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
