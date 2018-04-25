<link rel="stylesheet" href="./assets/application/staffs/app.css">

<div class="row" style="padding: 0 10px;">
  <div class="col">
    <div class="card text-white bg-light">
      <div class="card-body" style="color: #404040;">
        <h3><i class="fa fa-users"></i> STAFFS</h3><hr>
        <table id="tbl_staffs" class="table table-hover">
          <thead>
            <th width="1%"></th>
            <th>Staff name</th>
            <th>Action</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="modal_staffs" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Staff Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_staff">
            <div class="container text-center">
              <img class="image rounded-circle img-thumbnail" src="./assets/application/img/user-default.png" style="border: 1px solid gray; height: 150px; width: 155px;">
              <div class="overlay">
                <div class="text">Browse Image</div>
              </div>
              <input id="img-file" class="d-none" type="file">
            </div>
            <input type="hidden" name="staff_id">
            <label>Staff Name:</label>
            <input type="text" name="staff_name" class="form-control" placeholder="John Doe">
          </form>
        </div>
        <div class="modal-footer">
          <button id="btn-save-staff" type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div id="dialog-confirmation" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Staff</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to remove this staff?</p>
        </div>
        <div class="modal-footer">
          <button id="btn-confirm" type="button" class="btn btn-primary">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./assets/application/staffs/app.js" type="text/javascript"></script>
