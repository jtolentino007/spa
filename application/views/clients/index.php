<link rel="stylesheet" href="./assets/application/clients/app.css">

<div class="row" style="padding: 0 10px;">
  <div class="col">
    <div class="card text-white bg-light">
      <div class="card-body" style="color: #404040;">
        <h3><i class="fa fa-users"></i> CLIENTS</h3><hr>
        <table id="tbl_clients" class="table table-hover" width="100%;">
          <thead>
            <th width="3%"></th>
            <th>Client name</th>
            <th>Address</th>
            <th>Email Address</th>
            <th>Mobile number</th>
            <th width="5%">Action</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="modal_clients" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Client Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_client">
            <div class="container text-center">
              <img class="image rounded-circle img-thumbnail" src="./assets/application/img/user-default.png" style="border: 1px solid gray; height: 150px; width: 155px;">
              <div class="overlay">
                <div class="text">Browse Image</div>
              </div>
              <input id="img-file" class="d-none" type="file">
            </div>
            <input type="hidden" name="customer_id">
            <label>First Name:</label>
            <input type="text" name="first_name" class="form-control" placeholder="John">
            <label>Last Name:</label>
            <input type="text" name="last_name" class="form-control" placeholder="Doe">
            <label>Address:</label>
            <input type="text" name="address" class="form-control" placeholder="New York City">
            <label>E-mail address:</label>
            <input type="email" name="email" class="form-control" placeholder="johndoe@email.com">
            <label>Mobile number:</label>
            <input type="text" name="phone" class="form-control" placeholder="xxxx-xxx-xxxx">
          </form>
        </div>
        <div class="modal-footer">
          <button id="btn-save-client" type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div id="dialog-confirmation" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Clients</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to remove this client?</p>
        </div>
        <div class="modal-footer">
          <button id="btn-confirm" type="button" class="btn btn-primary">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./assets/application/clients/app.js" type="text/javascript"></script>
