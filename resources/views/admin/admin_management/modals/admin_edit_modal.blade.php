<div class="modal fade" id="editAdminModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel{{ $admin->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editAdminModalLabel{{ $admin->id }}">Edit Admin</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                    <form id="form_advanced_validation" class="editAdminForm" method="POST" enctype="multipart/form-data" 
                        data-route-edit-admin="{{ route('admin.update.admin', $admin->id) }}" 
                        data-admin-id="{{ $admin->id }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group form-float" style="margin-bottom: 15px !important">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Profile Picture</label>
                        <div class="form-line">
                        <input type="file" class="form-control" name="profile_picture" id="edit_profile_picture" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div id="preview-box" style="margin-top: 10px; width: 100%; height: 200px; border: 1px solid #ccc; display: flex; justify-content: center; align-items: center;">
                            <img id="edit_profile_preview" src="{{ asset('storage/' . $admin->profile_picture) }}" alt="Profile Picture Preview" style="max-width: 100%; max-height: 100%; display: block;">
                            <span id="no-image" style="color: #aaa; display: none;">No image selected</span>
                        </div>
                    </div>

                    <div class="form-group form-float" style="margin-bottom: 15px !important">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Fullname</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="fullname" id="edit_fullname" value="{{ old('fullname', $admin->fullname) }}" required>
                        </div>
                    </div>

                    <div class="form-group form-float" style="margin-bottom: 15px !important">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Email</label>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" id="edit_email" value="{{ old('email', $admin->email) }}" required>
                        </div>
                        <div id="error-edit-email{{ $admin->id }}" class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;"></div>
                    </div>

                    <div class="form-group form-float" style="margin-bottom: 15px !important">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Password <i>(leave blank to keep current)</i></label>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" id="edit_password">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn bg-red waves-effect">UPDATE ADMIN</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
