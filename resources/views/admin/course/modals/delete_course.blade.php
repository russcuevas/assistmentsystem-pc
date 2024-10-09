<div class="modal fade" id="deleteCourseModal{{ $available_course->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCourseModalLabel">Confirm Deletion</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this course "{{ $available_course->course_name }}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red waves-effect delete-course" 
                        data-url="{{ route('admin.delete.course', $available_course->id) }}">DELETE</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
