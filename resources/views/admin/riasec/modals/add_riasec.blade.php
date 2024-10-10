<div class="modal fade" id="addRiasecModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addRiasecModalLabel">Add RIASEC</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                    <form id="form_advanced_validation" class="addRiasec" method="POST" data-route-add-riasec="{{ route('admin.add.riasec') }}">
                    @csrf
                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Initial</label>
                        <div class="form-line">
                            <input type="text" class="form-control" id="riasec_id" name="riasec_id" required maxlength="1" placeholder="R/I/A/S/E/C" required>
                        </div>
                        <div id="error-riasec" class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;"></div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">RIASEC Name</label>
                        <div class="form-line">
                            <input type="text" class="form-control" id="riasec_name" name="riasec_name" required>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Description</label>
                        <div class="form-line">
                            <textarea name="description" cols="30" rows="5" class="form-control no-resize" required></textarea>
                        </div>
                    </div>

                    <div id="career-pathway-fields">
                        <div class="form-group">
                        <label style="color: #212529; font-weight: 600;" class="form-label" for="career_name[]">Career Pathway</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="career_name[]" required>
                            </div>
                            </div>
                        <div class="form-group form-float career-pathway">
                            <label style="color: #212529; font-weight: 600; margin-top: 20px; !important" class="form-label" for="course_id[]">Select Related Courses</label>
                            <div class="fields-scroll" style="margin-top: 5px">
                                <div>
                                    @foreach ($courses as $course)
                                        <div class="col-5">
                                            <label>
                                                <input type="checkbox" name="course_id[0][]" id="checkbox-{{ $course->id }}" value="{{ $course->id }}">
                                                <label for="checkbox-{{ $course->id }}" style="text-transform: uppercase">{{ $course->course_name }}</label>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger waves-effect remove">Remove</button>
                        </div>
                    </div>
                    <button type="button" style="margin-top: 10px;" class="btn btn-success waves-effect" id="add-career-pathway">+ Add Another Career Pathway</button>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-red waves-effect">SAVE CHANGES</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
            </form>
        </div>
    </div>
</div>