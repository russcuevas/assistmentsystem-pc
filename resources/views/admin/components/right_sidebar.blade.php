<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs tab-nav-right" role="tablist">
        <li role="presentation" class="active"><a href="#skins" data-toggle="tab">ACCOUNT</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" id="skins">
            <ul style="list-style-type: none;">
                <li>
                    <a href="" data-toggle="modal" data-target="#changePasswordModal" style="margin-top: 15px; margin-left: -30px; display: inline-block; font-weight: 900; font-size: 15px; text-decoration: none; cursor: pointer; color: black"><i class="material-icons mr-2" style="font-size: 18px; vertical-align: middle;">lock</i> Change password</a>
                </li>
            </ul>
            <ul style="list-style-type: none;">
                <li>
                    <a href="{{ route('admin.logout.request') }}" style="margin-top: 15px; margin-left: -30px; font-weight: 900; font-size: 15px; text-decoration: none; cursor: pointer; color: black"><i class=" material-icons mr-2" style="font-size: 18px; vertical-align: middle;">exit_to_app</i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</aside>


<!-- CHANGE PASSWORD MODAL -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Change password</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>
                <form id="form_advanced_validation" class="changePasswordForm" method="POST" action="{{ route('admin.change.password') }}">
                    @csrf
                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Old Password</label>
                        <div class="form-line">
                            <input type="password" class="form-control" name="old_password" required>
                        </div>
                        <div id="error-old_password" class="error-message" style="color: red;"></div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">New Password</label>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" maxlength="12" minlength="6" required>
                        </div>
                        <div id="error-password" class="error-message" style="color: red;"></div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Confirm Password</label>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password_confirmation" maxlength="12" minlength="6" required>
                        </div>
                        <div id="error-password_confirmation" class="error-message" style="color: red;"></div>
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
</div>