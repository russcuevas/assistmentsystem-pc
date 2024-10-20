<div class="modal fade" id="deleteRiasecModal{{ $riasec_formatting['id'] }}" tabindex="-1" role="dialog" aria-labelledby="deleteRiasecModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRiasecModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this "{{ $riasec_formatting['id'] }}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red waves-effect delete-riasec-id" 
                        data-url="{{ route('admin.delete.riasec', $riasec_formatting['id']) }}">DELETE</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
