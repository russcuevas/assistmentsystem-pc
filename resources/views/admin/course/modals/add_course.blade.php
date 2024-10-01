<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.add.course') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label for="course_name">Course Name</label>
                    <input type="text" name="course_name" class="form-control" required>
                    <label for="course_description">Course Description</label>
                    <input type="text" name="course_description" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Add Course" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>