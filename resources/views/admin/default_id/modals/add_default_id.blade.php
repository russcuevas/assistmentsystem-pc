<div class="modal fade" id="addDefaultIdModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Add Default ID</h4>
                    <hr style="background-color: #752738; height: 2px; border: none;">
                </div>
                <div class="modal-body">
                        <form id="form_advanced_validation" class="addDefaultId" method="POST" data-route-add-default-id="{{ route('admin.add.examiners') }}">
                        @csrf
                        <div class="form-group form-float">
                            <label style="color: #212529; font-weight: 600;" class="form-label">Generated ID</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="default_id" readonly value="{{ $next_id }}" required>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <label style="color: #212529; font-weight: 600;" class="form-label">Number of ID to Add</label>
                            <div class="form-line">
                                <input type="number" class="form-control" name="count" min="1" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-red waves-effect">SAVE CHANGES</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>