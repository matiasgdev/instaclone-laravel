<button style="border:none; background:none; outline:none" type="button" class="text-danger" data-toggle="modal" data-target="#myModal">Eliminar</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Eliminar</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p class="text-danger"> ¿Estas seguro de que quieres eliminar? Ten en cuenta que no podras recuperarla </p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href="{{route('image.delete', ['id' => $image->id])}}">Borrar</a>
        <button type="button" class="btn text-info" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>