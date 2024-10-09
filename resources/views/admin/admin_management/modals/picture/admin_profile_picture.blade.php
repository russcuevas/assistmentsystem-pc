<div class="modal fade" id="profilePictureModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="profilePictureModalLabel{{ $admin->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilePictureModalLabel{{ $admin->id }}">Profile Picture</h5>
                <hr style="background-color: #752738; height: 2px; border: none;">
            </div>
            <div class="modal-body">
                <img id="modalProfilePicture{{ $admin->id }}" src="{{ asset('storage/' . $admin->profile_picture) }}" alt="Profile Picture" style="width: 200px; height: 200px; border-radius: 10px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
