<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addCourseModalLabel">Add Course</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                <!-- Add enctype to allow file uploads -->
                <form id="form_advanced_validation" class="addCourse" method="POST" data-route-add-course="{{ route('admin.add.course') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Course Name</label>
                        <div class="form-line">
                            <input type="text" name="course_name" class="form-control" required>
                        </div>
                        <div id="error-course" class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;"></div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Course Description</label>
                        <div class="form-line">
                            <textarea name="course_description" cols="30" rows="5" class="form-control no-resize" required></textarea>
                        </div>
                    </div>

                    <!-- Add input for multiple course pictures -->
                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Course Pictures</label>
                        <div class="form-line">
                            <input type="file" name="course_pictures[]" class="form-control" multiple>
                        </div>
                        <div id="error-pictures" class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;"></div>
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
