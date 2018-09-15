<script>
function showDeleteModal(post_id) {
  $postid = post_id;
  $('#deleteconfirm').modal('show');
}

function hideDeleteModal() {
  $('#deleteconfirm').modal('hide');
}
</script>

<!-- Post Deletion Modal -->
<div class="modal fade" id="deleteconfirm" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content text-center">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notice</h4>
      </div>
      <div class="modal-body">
        <p> If you continue, this post will be permanently deleted. There is no way to recover lost information.</p>
      </div>
      <a href="#">
        <button type="button" class="btn btn-primary btn-md" onclick="deletepost($postid);">Delete</button> 
      </a>
      <a href="#">
        <button type="button" class="btn btn-default btn-md" onclick="hideDeleteModal();">Cancel</button> 
      </a>
      <br><br>
    </div>

  </div>
</div>