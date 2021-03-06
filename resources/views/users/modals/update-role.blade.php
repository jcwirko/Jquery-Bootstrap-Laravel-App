<!-- Modal -->
<div class="modal animated zoomIn" id="editRoleUserMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-inspinia text-success" id="exampleModalLabel">Actualizar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" role="form" method="POST" id="editRoleUserFrm">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label for="roles" class="form-fields">Roles</label>
                            @foreach ($roles->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach ($chunk as $role)
                                        <div class="col-md-4 text-center">
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" name="roles[]"
                                                       value="{{$role->name}}"
                                                       id="{{$role->name}}"
                                                       @if(is_array(old('roles')) && in_array($role->name, old('roles'))) checked @endif>
                                            </div>
                                            <label for="roles">
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            @if ($errors->has('roles'))
                                <span class="text-danger">{{ $errors->first('roles') }}</span>
                            @endif
                        </div>
                    </div>

                    @include('partials.buttons.btn-create-form')
                </form>
            </div>
        </div>
    </div>
</div>
