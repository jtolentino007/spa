<link rel="stylesheet" href="./assets/application/users/app.css">

<div class="row" style="padding: 0 10px;">
  <div class="col">
    <div class="card text-white bg-light">
      <div class="card-body" style="color: #404040;">
        <h3><i class="fa fa-users"></i> USER ACCOUNTS</h3><hr>
        <table id="tbl_users" class="table table-hover" width="100%">
          <thead>
            <th width="1%"></th>
            <th>User name</th>
            <th>Mobile no.</th>
            <th>E-mail Address</th>
            <th>Status</th>
            <th>Action</th>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="modal_users" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">User Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_user">
            <input type="hidden" name="user_id">
            <label>E-mail address / Username:</label>
            <input type="email" name="email" class="form-control" placeholder="johndoe@email.com">
            <div class="row">
              <div class="col">
                <label>First Name:</label>
                <input type="text" name="first_name" class="form-control" placeholder="John">
              </div>
              <div class="col">
                <label>Last Name:</label>
                <input type="text" name="last_name" class="form-control" placeholder="Doe">
              </div>
            </div>
            <label>Mobile number:</label>
            <input type="text" name="phone" class="form-control" placeholder="xxxx-xxx-xxxx">
            <div class="row">
              <div class="col">
                  <label>Password:</label>
                  <input type="password" name="password" class="form-control" placeholder="xxxxxxxx">
              </div>
              <div class="col">
                <label>Confirm Password:</label>
                <input type="password" name="password_confirm" class="form-control" placeholder="xxxxxxxx">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button id="btn-save-user" type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div id="dialog-confirmation" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Users</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to activate/deactivate this user?</p>
        </div>
        <div class="modal-footer">
          <button id="btn-confirm" type="button" class="btn btn-primary">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./assets/application/users/app.js" type="text/javascript"></script>
