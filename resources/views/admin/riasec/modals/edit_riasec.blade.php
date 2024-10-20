<div class="modal fade" id="updateRiasecModal{{ $riasec_formatting['id'] }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit RIASEC</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                <form id="form_advanced_validation" class="editRiasec"  method="POST" data-route-update-riasec="{{ route('admin.update.riasec', $riasec_formatting['id']) }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="riasec_id" value="{{ $riasec_formatting['id'] }}">

                    <div class="form-group form-float" style="margin-bottom: 25px !important;">
                        <label style="color: #212529; font-weight: 600;" class="form-label">RIASEC Name</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="riasec_name" value="{{ $riasec_name }}" required>
                        </div>
                    </div>

                    <div class="form-group form-float" style="margin-bottom: 25px !important;">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Description</label>
                        <div class="form-line">
                            <textarea name="description" cols="30" rows="5" class="form-control no-resize" required>{{ $riasec_formatting['description'] }}</textarea>
                        </div>
                    </div>
                    
                    <div id="career-update-pathway-fields-{{ $riasec_formatting['id'] }}">
                        @foreach ($formattedRiasec[$riasec_name]['careers'] as $index => $career)
                            <div class="career-update-pathway">
                                <div class="form-group" style="margin-bottom: 25px !important;">
                                    <label style="color: #212529; font-weight: 600;" class="form-label">Career Name</label>
                                    <div class="form-line">
                                        <input type="text" name="career_name[]" class="form-control" value="{{ $career['name'] }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="color: #212529; font-weight: 600;" class="form-label">Select Related Courses</label>
                                    <div class="fields-scroll">
                                        @foreach ($courses as $course)
                                            <div class="col-5">
                                                <label>
                                                    @php
                                                        $isChecked = in_array($course->id, $career['courses']);
                                                    @endphp
                                                    <input type="checkbox" class="filled-in chk-col-red" name="course_id[{{ $index }}][]" id="update-checkbox-{{ $riasec_formatting['id'] }}-{{ $index }}-{{ $course->id }}" value="{{ $course->id }}"
                                                        {{ $isChecked ? 'checked' : '' }}>
                                                    <label for="update-checkbox-{{ $riasec_formatting['id'] }}-{{ $index }}-{{ $course->id }}" style="text-transform: uppercase">{{ $course->course_name }}</label>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" style="margin-bottom: 25px;" class="btn btn-danger waves-effect remove">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" style="margin-top: 10px;" class="btn btn-success waves-effect add-career-update-pathway" id="add-career-update-pathway-{{ $riasec_formatting['id'] }}">+ Add Another Career Pathway</button>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-red waves-effect">Update RIASEC</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
            </form>
        </div>
    </div>
</div>