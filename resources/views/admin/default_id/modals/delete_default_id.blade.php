<div class="modal fade" id="deleteExaminersModal{{ $default_id->default_id }}" tabindex="-1" role="dialog" aria-labelledby="deleteExaminersModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteExaminersModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this default id "{{ $default_id->default_id }}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red waves-effect delete-default-id" 
                        data-url="{{ route('admin.delete.examiners', $default_id->default_id) }}">DELETE</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
