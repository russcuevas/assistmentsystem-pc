<div class="modal fade" id="addDefaultIdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Add Examiners</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                <form id="form_advanced_validation" class="addDefaultId" method="POST" data-route-add-default-id="{{ route('admin.add.examiners') }}">
                    @csrf
                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Examiners ID</label>
                        <div class="form-line">
                            <input style="background-color: gray; padding: 10px; color: white;" type="text" class="form-control" name="default_id" readonly value="{{ $next_id }}" required>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Full Name</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="fullname" required>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Sex</label>
                        <div class="form-line">
                            <select class="form-control" name="gender" required>
                                <option value="">Select Sex</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Age</label>
                        <div class="form-line">
                            <input type="number" class="form-control" name="age" min="1" required>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Birthday</label>
                        <div class="form-line">
                            <input type="date" class="form-control" name="birthday" required>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Strand</label>
                        <div class="form-line">
                            <select class="form-control" name="strand" required>
                                <option value="">Select Strand</option>
                                <option value="HUMSS">Humanities and Social Science</option>
                                <option value="ABM">Accountancy, Business and Management</option>
                                <option value="STEM">Science, Technology, Engineering, and Mathematics</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Email</label>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" required>
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
