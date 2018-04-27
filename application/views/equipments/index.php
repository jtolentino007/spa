<link rel="stylesheet" href="./assets/application/equipments/app.css">

<div class="row" style="padding: 0 10px;">
  <div class="col">
    <div class="card text-white bg-light">
      <div class="card-body" style="color: #404040;">
        <h3><i class="fa fa-cube"></i> EQUIPMENTS</h3><hr>
        <table id="tbl_equipments" class="table table-hover">
          <thead>
            <th>Equipment</th>
            <th>Description</th>
            <th>Section</th>
            <th>Action</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="modal_equipments" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Equipment Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_equipment">
            <input type="hidden" name="equipment_id">
            <label>Equipment:</label>
            <input type="text" name="equipment" class="form-control" placeholder="Barbers Chair">
            <label>Description:</label>
            <textarea type="text" name="equipment_desc" class="form-control" placeholder="Write something..."></textarea>
            <label>Section:</label>
            <select class="select-section" style="width: 100%;" name="section_id"></select>
          </form>
        </div>
        <div class="modal-footer">
          <button id="btn-save-equipment" type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div id="dialog-confirmation" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Equipments</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to remove this equipment?</p>
        </div>
        <div class="modal-footer">
          <button id="btn-confirm" type="button" class="btn btn-primary">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./assets/application/equipments/app.js" type="text/javascript"></script>
