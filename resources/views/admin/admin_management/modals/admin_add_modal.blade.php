        <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addAdminModalLabel">Add Admin</h4>
                    <hr style="background-color: #752738; height: 2px; border: none;">
                </div>
                <div class="modal-body">
                    <form id="form_advanced_validation" class="addAdminForm" method="POST" enctype="multipart/form-data" data-route-add-admin="{{ route('admin.add.admin') }}">
                        @csrf
                        <div class="form-group form-float">
                            <label style="color: #212529; font-weight: 600;" class="form-label">Profile picture</label>
                            <div class="form-line">
                                <input type="file" class="form-control" name="profile_picture" id="profile_picture" accept="image/*">
                            </div>
                            <div id="preview-box" style="margin-top: 10px; width: 100%; height: 200px; border: 1px solid #ccc; display: flex; justify-content: center; align-items: center;">
                                <img id="profile-preview" src="" alt="Profile Picture Preview" style="max-width: 100%; max-height: 100%; display: none;">
                                <span id="no-image" style="color: #aaa;">No image selected</span>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <label style="color: #212529; font-weight: 600;" class="form-label">Fullname</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="fullname" id="fullname" required>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <label style="color: #212529; font-weight: 600;" class="form-label">Email</label>
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div id="error-email" class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;"></div>
                        </div>
                        
                        <div class="form-group form-float">
                            <label style="color: #212529; font-weight: 600;" class="form-label">Password</label>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <label style="color: #212529; font-weight: 600;" class="form-label">Confirm Password</label>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
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