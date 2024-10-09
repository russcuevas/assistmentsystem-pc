<div class="modal fade" id="updateCourseModal{{ $available_course->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateCourseModalLabel">Update Course</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                <form id="form_advanced_validation" class="updateCourse" method="POST" data-route-edit-course="{{ route('admin.update.course', $available_course->id) }}" data-course-id="{{ $available_course->id }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-float" style="margin-bottom: 15px !important">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Course Name</label>
                        <div class="form-line">
                            <input type="text" name="course_name" class="form-control" value="{{ $available_course->course_name }}" required>
                        </div>
                        <div id="error-edit-course{{ $available_course->id }}" class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;"></div>
                    </div>

                    <div class="form-group form-float" style="margin-bottom: 15px !important">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Course Description</label>
                        <div class="form-line">
                            <textarea name="course_description" cols="30" rows="5" class="form-control no-resize" required>{{ $available_course->course_description }}</textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-red waves-effect">UPDATE COURSE</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
                </form>
        </div>
    </div>
</div>
