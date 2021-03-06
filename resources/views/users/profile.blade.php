@extends('layouts.admin')

@section('section-title')
    Perfil
@endsection

@section('content')

    <div class="ibox well">
        <div class="ibox-content">
            <h3 class="subtitle-section">Datos personales</h3>
            <form action="{{route('users.profile.get')}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <div>
                            <label for="email" class="form-fields">Nombre</label>
                            <label class="mandatory-field">*</label>
                            <input type="text"
                                   class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}"
                                   name="first_name" id="first_name"
                                   value="{{old('first_name') ? old('first_name') : auth()->user()->first_name}}">
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <div>
                            <label for="email" class="form-fields">Apellido</label>
                            <label class="mandatory-field">*</label>
                            <input type="text"
                                   class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}"
                                   name="last_name"
                                   value="{{old('last_name') ? old('last_name') : auth()->user()->last_name}}">
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <div>
                            <label for="id_card" class="form-fields">DNI</label>
                            <input type="text" class="form-control" name="id_card" id="id_card"
                                   value="{{old('id_card') ? old('id_card') : auth()->user()->id_card}}">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <div>
                            <label for="tax_identification" class="form-fields">CUIT</label>
                            <input type="text" class="form-control" name="tax_identification"
                                   value="{{old('tax_identification') ? old('tax_identification') : auth()->user()->tax_identification}}"
                                   data-inputmask="'mask': '99-99999999-9'"
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <div>
                            <label for="phone" class="form-fields">Teléfono</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                   value="{{old('phone') ? old('phone') : auth()->user()->phone}}">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <div>
                            <label for="address" class="form-fields">Dirección</label>
                            <label class="mandatory-field">*</label>
                            <input type="text" class="form-control" name="last_name"
                                   value="{{old('address') ? old('address') : auth()->user()->address}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <div>
                            <label for="email" class="form-fields">Email</label>
                            <label class="mandatory-field">*</label>
                            <input type="text" class="form-control" name="email" id="email"
                                   value="{{old('email') ? old('email') : auth()->user()->email}}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-lg-6 form-group">
                         <label for="">Rol</label>
                         <div class="profile-rol">
                             @if(auth()->user()->roles()->count())
                                 @foreach(auth()->user()->roles as $role)
                                     <span>{{$role->name}}</span>
                                 @endforeach
                             @else
                                 <span class="text-danger">Sin rol asignado</span>
                             @endif
                         </div>
                     </div>--}}
                </div>
                <div class="buttons-form-submit d-flex justify-content-end">
                    <button type="submit" href="#" class="btn btn-success btn-sm">
                        Actualizar
                        <i class="fas fa-spinner fa-spin d-none"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="ibox well">
        <div class="ibox-content">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <h3 class="subtitle-section">Contraseña</h3>
            <form action="{{route('users.password.set')}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <label for="email" class="form-fields">Contraseña actual</label>
                        <label class="mandatory-field">*</label>
                        <input type="password" class="form-control" name="current-password"/>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="email" class="form-fields">Contraseña nueva</label>
                        <label class="mandatory-field">*</label>
                        <input type="password" class="form-control" name="new-password"/>
                    </div>
                </div>
                <div class="buttons-form-submit d-flex justify-content-end">
                    <button type="submit" href="#" class="btn btn-success btn-sm">
                        Actualizar
                        <i class="fas fa-spinner fa-spin d-none"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


