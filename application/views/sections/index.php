<link rel="stylesheet" href="./assets/application/sections/app.css">

<div class="row" style="padding: 0 10px;">
  <div class="col">
    <div class="card text-white bg-light">
      <div class="card-body" style="color: #404040;">
        <h3><i class="fa fa-box"></i> SECTIONS</h3><hr>
        <table id="tbl_sections" class="table table-hover">
          <thead>
            <th width="1%"></th>
            <th>Section Name</th>
            <th>Section Description</th>
            <th>Action</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="modal_sections" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Section Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_section">
            <input type="hidden" name="sections_id">
            <label>Section Name:</label>
            <input type="text" name="section_name" class="form-control" placeholder="Spa">
            <label>Section Description:</label>
            <textarea type="text" name="section_desc" class="form-control"></textarea>
          </form>
        </div>
        <div class="modal-footer">
          <button id="btn-save-section" type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div id="dialog-confirmation" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Section</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to remove this section?</p>
        </div>
        <div class="modal-footer">
          <button id="btn-confirm" type="button" class="btn btn-primary">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./assets/application/sections/app.js" type="text/javascript"></script>
