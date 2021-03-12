<!-- Modal -->
<div class="modal animated zoomIn" id="editMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-inspinia text-success" id="exampleModalLabel">Editar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" role="form" method="POST" id="editFrm">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <div>
                                <label for="first_name" class="form-fields">Nombre</label> <label
                                    class="mandatory-field">*</label>
                                <input type="text"
                                       class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                       name="name" id="name"
                                       value="{{old('name')}}" placeholder="-">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <div>
                                <label for="first_name" class="form-fields">Descripción</label>
                                <textarea name="title" id="title" cols="30" rows="2" class="form-control" placeholder="-"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label for="first_name" class="form-fields">Permisos</label>
                            @foreach ($abilities->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach ($chunk as $ability)
                                        <div class="col-md-4 text-center">
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" name="abilities[]" id="{{$ability->name}}"
                                                       value="{{$ability->name}}" @if(is_array(old('abilities')) && in_array($ability->name, old('abilities'))) checked @endif>
                                                <label for="abilities">
                                                    {{$ability->title}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @include('partials.buttons.btn-create-form')
                </form>
            </div>
        </div>
    </div>
</div>
