<!-- Modal -->
<div class="modal animated zoomIn" id="createMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-inspinia text-primary" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('users.store')}}" role="form" method="POST" id="createFrm">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="first_name" class="form-fields">Nombre</label>
                                <label class="mandatory-field">*</label>
                                <input type="text"
                                       class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}"
                                       name="first_name" id="first_name"
                                       value="{{old('first_name')}}" placeholder="-">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="first_name" class="form-fields">Apellido</label>
                                <label class="mandatory-field">*</label>
                                <input type="text"
                                       class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}"
                                       name="last_name"
                                       id="last_name" value="{{old('last_name')}}" placeholder="-">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <div>
                                <label for="birthdate" class="form-fields">Fecha de nacimiento</label>
                                <label class="mandatory-field">*</label>
                                <input type="date" class="form-control" name="birthdate" id="birthdate"
                                       value="{{old('birthdate')}}" placeholder="-">
                                @if ($errors->has('birthdate'))
                                    <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="email" class="form-fields">Email</label>
                                <label class="mandatory-field">*</label>
                                <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email" id="email"
                                       value="{{old('email')}}" placeholder="-">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="password" class="form-fields">Contraseña</label>
                                <label class="mandatory-field">*</label>
                                <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" id="password"
                                       value="{{old('password')}}" placeholder="-">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label for="password" class="form-fields">Roles</label>
                            @foreach ($roles->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach ($chunk as $role)
                                        <div class="col-md-4 text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input type="checkbox" name="roles[]"
                                                       value="{{$role->name}}"
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
