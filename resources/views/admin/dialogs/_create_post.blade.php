<!-- Modal -->
<div class="modal fade" id="create_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong style="font-size: 20px">Nueva Publicacion</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.posts.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <label for="title">Titulo de la Publicacion</label>
                        <input class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" type="text"
                               name="title" placeholder="Ingresa aqui el titulo de la publicacion" required/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>