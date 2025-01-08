<div class="modal fade" id="addQuestionnaireModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addQuestionnaireModalLabel">Add Question</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                <form id="form_advanced_validation_add_questionnaire" class="addQuestionnaire" method="POST" data-route-add-course="{{ route('admin.add.questionnaire') }}">
                    @csrf
                    <input type="hidden" name="is_correct" value="1">
                    <input type="hidden" name="option_text" id="option_text" readonly>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" for="question_text" class="form-label">Question</label>
                        <div class="form-line">
                            <input type="text" name="question_text" class="form-control" required>
                        </div>
                    </div>

                    @php
                    $riasec_format = ['R', 'I', 'A', 'S', 'E', 'C'];
                    @endphp

                    <div class="form-group form-float">
                        <label for="riasec_id" style="color: #212529; font-weight: 600;" class="form-label">Related to RIASEC</label>
                        <div class="form-line">
                            <select class="form-control show-tick" name="riasec_id" id="riasec_id" required>
                                @foreach ($riasec_format as $format)
                                    @php
                                        $riasec = $riasecs->firstWhere('id', $format);
                                    @endphp
                                    @if ($riasec)
                                        <option value="{{ $riasec->id }}">{{ $riasec->id }}</option>
                                    @endif
                                @endforeach
                            </select>
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
