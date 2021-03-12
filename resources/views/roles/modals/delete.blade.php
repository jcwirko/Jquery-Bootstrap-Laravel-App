<!-- Modal -->
<div class="modal animated zoomIn" id="deleteMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLabel">Eliminar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" role="form" method="POST" id="deleteFrm">
                    @method('DELETE')
                    @csrf
                    <div class="alert alert-danger text-center" role="alert">
                           ¿Eliminar el role <strong id="roleName"></strong>?
                    </div>
                    @include('partials.buttons.btn-delete-form')
                </form>
            </div>
        </div>
    </div>
</div>
