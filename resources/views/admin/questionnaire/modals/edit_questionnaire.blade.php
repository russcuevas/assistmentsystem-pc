<div class="modal fade" id="updateQuestionnaireModal{{ $question->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateQuestionnaireModalLabel">Update Question</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                <form id="form_advanced_validation" class="updateQuestionnaire" method="POST" data-route-update-course="{{ route('admin.update.questionnaire', $question->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_correct" value="1">
                    <input type="hidden" name="option_text" id="option_text_update" required value="{{ $options->first()->option_text }}">

                    <div class="form-group form-float" style="margin-bottom: 25px !important">
                        <label style="color: #212529; font-weight: 600;" for="question_text" class="form-label">Question</label>
                        <div class="form-line">
                            <input type="text" name="question_text" class="form-control" required value="{{ $question->question_text }}">
                        </div>
                    </div>

                    <div class="form-group form-float" style="margin-bottom: 25px !important">
                        <label for="riasec_id" style="color: #212529; font-weight: 600;" class="form-label">Select Riasec</label>
                        <div class="form-line">
                            <select class="form-control show-tick" name="riasec_id" id="riasec_id_update" required>
                                @foreach ($riasecs as $riasec)
                                    <option value="{{ $riasec->id }}" {{ $riasec->id == $question->riasec_id ? 'selected' : '' }}>
                                        {{ $riasec->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-red waves-effect">UPDATE QUESTION</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
            </form>
        </div>
    </div>
</div>
