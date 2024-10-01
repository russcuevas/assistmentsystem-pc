<div class="modal fade" id="addDefaultIdModal" tabindex="-1" role="dialog" aria-labelledby="addDefaultIdModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDefaultIdModalLabel">Add Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.add.examiners') }}" method="POST" onsubmit="showLoading">
                @csrf
                <div class="modal-body">
                    <label for="default_id">Last ID</label>
                    <input type="text" name="default_id"  class="form-control" readonly value="{{ $next_id }}" required>
                    <label for="count">Number of ID to Add</label>
                    <input type="number" name="count" min="1" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Add Default ID">
                </div>
            </form>
        </div>
    </div>
</div>