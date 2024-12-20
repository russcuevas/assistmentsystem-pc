<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addCourseModalLabel">Add Course</h4>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
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

                    <div class="form-group form-float">
                        <label style="color: #212529; font-weight: 600;" class="form-label">Course Pictures</label>
                        <div class="form-line">
                            <input type="file" name="course_pictures[]" class="form-control" multiple required id="coursePicturesInput">
                        </div>
                        <div id="error-pictures" class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;"></div>
                    </div>

                    <div id="imagePreviewContainer" class="mt-3"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-red waves-effect">SAVE CHANGES</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('coursePicturesInput').addEventListener('change', function(event) {
        var files = event.target.files;
        var previewContainer = document.getElementById('imagePreviewContainer');
        previewContainer.innerHTML = '';
        
        var removedIndexes = [];
        
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            
            reader.onload = function(e) {
                var imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.style.width = '100px';
                imgElement.style.marginRight = '10px';
                imgElement.style.marginBottom = '10px';
                imgElement.classList.add('img-thumbnail');
                
                var removeButton = document.createElement('span');
                removeButton.innerHTML = '❌';
                removeButton.style.position = 'absolute';
                removeButton.style.top = '0';
                removeButton.style.right = '0';
                removeButton.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                removeButton.style.color = 'white';
                removeButton.style.padding = '5px';
                removeButton.style.borderRadius = '50%';
                removeButton.style.cursor = 'pointer';
                
                var imgContainer = document.createElement('div');
                imgContainer.style.position = 'relative';
                imgContainer.style.display = 'inline-block';
                imgContainer.style.marginRight = '10px';
                imgContainer.style.marginBottom = '10px';

                imgContainer.appendChild(imgElement);
                imgContainer.appendChild(removeButton);

                previewContainer.appendChild(imgContainer);

                removeButton.addEventListener('click', function() {
                    var index = Array.from(previewContainer.children).indexOf(imgContainer);
                    previewContainer.removeChild(imgContainer);
                    removedIndexes.push(index);
                    updateFileInput();
                });
            };
            
            reader.readAsDataURL(file);
        }

        function updateFileInput() {
            var inputElement = document.getElementById('coursePicturesInput');
            var dataTransfer = new DataTransfer();

            for (var i = 0; i < files.length; i++) {
                if (!removedIndexes.includes(i)) {
                    dataTransfer.items.add(files[i]);
                }
            }
            inputElement.files = dataTransfer.files;
        }
    });
</script>