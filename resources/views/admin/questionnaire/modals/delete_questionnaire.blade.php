<div class="modal fade" id="deleteQuestionnaireModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteQuestionnaireModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteQuestionnaireModalLabel">Confirm Deletion</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this question? "{{ $question->question_text }}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red waves-effect delete-questionnaire" 
                        data-url="{{ route('admin.delete.questionnaire', $question->id) }}">DELETE</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>