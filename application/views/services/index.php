<link rel="stylesheet" href="./assets/application/services/app.css">

<div class="row" style="padding: 0 10px;">
  <div class="col">
    <div class="card text-white bg-light">
      <div class="card-body" style="color: #404040;">
        <h3><i class="fa fa-cogs"></i> SERVICES</h3><hr>
        <table id="tbl_services" class="table table-hover">
          <thead>
            <th width="1%"></th>
            <th>Service Name</th>
            <th>Category</th>
            <th>Time</th>
            <th>Price</th>
            <th>Action</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="modal_services" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Service Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_services">
            <input type="hidden" name="service_id">
            <label>Service Name:</label>
            <input type="text" name="service_name" class="form-control" placeholder="Service name">
            <label>Category:</label>
            <select id="cbo-category" name="category_id" style="width:100%;"></select>
            <label>Time:</label>
            <input type="time" class="form-control" value="00:00" name="time">
            <label>Price:</label>
            <input class="form-control" type="text" name="price" placeholder="0.00">
          </form>
        </div>
        <div class="modal-footer">
          <button id="btn-save-service" type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div id="dialog-confirmation" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Services</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to remove this service?</p>
        </div>
        <div class="modal-footer">
          <button id="btn-confirm" type="button" class="btn btn-primary">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./assets/application/services/app.js" type="text/javascript"></script>
