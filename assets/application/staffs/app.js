// IIFE - Immediately Invoked Function Expression
(function(app) {
  // The global jQuery object is passed as a parameter
  app(window.jQuery, window, document);

}(function($, window, document) {

  // The $ is now locally scoped
  // Listen for the jQuery ready event on the document.
  var _tblStaffs = $('#tbl_staffs');
  var _modalStaffs = $('#modal_staffs');
  var _dTableStaffs;
  var _mode;
  var _selectedTr;
  var _tblClientBody = $('#tbl_staffs tbody');
  var _dialog = $('#dialog-confirmation');
  var _staffID;

  $(function() {
    // The DOM is ready!
    _dTableStaffs = _tblStaffs.DataTable({
      "dom": '<"toolbar">frtip',
      "bLengthChange":false,
      "ajax": 'Staffs/get',
      "columns": [
        {
          targets:[0],data:"photo_path",render:function(data, type, row, meta) {
            return "<img class='rounded-circle' src='"+data+"' style='width: 50px; height: 50px; border: 1px solid #e2e2e2'/>";
          }
        },
        { targets:[1],data:"staff_name" },
        {
          targets:[2],
          class: 'text-center',
          render: function(){
            return '<button class="btn btn-primary btn-edit-info rounded-circle"><i class="fa fa-edit"></i></button>' + ' ' + '<button class="btn btn-danger btn-remove-staff rounded-circle"><i class="fa fa-trash"></i></button>'
          }
        }
      ]
    });

    $("div.toolbar").html('<button id="btn-new-staff" class="btn btn-primary toolbtn"><i class="fa fa-plus"></i> New Staff</button>');

    _tblClientBody.on('click', '.btn-edit-info',function(){
      _mode = "edit";
      _selectedTr = $(this).parents('tr');

      $(this).removeAttr('disabled');
      var _staffData = _dTableStaffs.row(_selectedTr).data();

      $('input[name="staff_id"]').val(_staffData.staff_id);
      $('input[name="staff_name"]').val(_staffData.staff_name);
      $('.image').attr('src',_staffData.photo_path);

      _modalStaffs.modal('show');
    });

    _tblClientBody.on('click', '.btn-remove-staff', function() {
      _selectedTr = $(this).parents('tr');
      _staffID = _dTableStaffs.row($(this).parents('tr')).data().staff_id;
      _dialog.modal('show');
    });

    _dialog.on('click','#btn-confirm', function(){
      removeStaff(_staffID).done(function(response){
        if (response.status == "success") {
          toastr.success(response.data);
          _dTableStaffs.row(_selectedTr).remove().draw();
        } else {
          toastr.error(response.data);
        }
        _dialog.modal('hide');
      });
    });

    $('.overlay').click(function(e){
      e.preventDefault();
      $('#img-file').click();
    });

    $('#img-file').change(function(e){
      var file = e.target.files[0];
      var imageType = /image.*/;

      if (!file.type.match(imageType)) return;

      var form_data = new FormData();
      form_data.append('image_file', file);

      $.ajax({
        url:'upload/ajax_upload',
        method:'POST',
        dataType:'json',
        data:form_data,
        contentType: false,
        cache: false,
        processData: false,
        success:function(response) {
          if (response.status == "success")
            $('.image').attr('src', response.img_src);
          else
            toastr.error(response.message);
        }
      });
    });

    $('#btn-new-staff').click(function(){
      _mode = "add";
      $(this).removeAttr('disabled');
      clearForm();
      _modalStaffs.modal('show');
      $("form input:text").first().focus();
    });

    $('#btn-save-staff').click(function(){

      var _data = $('#frm_staff').serializeArray();
      _data.push({name: 'photo_path', value: $('.image').attr('src')});
      if (_mode == "add") {
        saveStaff(_data).done(function(response){
          if (response.status == "success") {
            _dTableStaffs.row.add(response.staff[0]).draw();
            _modalStaffs.modal('hide');
            toastr.success(response.data);
            clearForm();
            $(this).attr('disabled','disabled');
          } else {
            toastr.error(response.data);
          }
        });
      } else {
        modifyStaff(_data).done(function(response){
          if (response.status == "success") {
            _dTableStaffs.row(_selectedTr).data(response.staff[0]).draw();
            _modalStaffs.modal('hide');
            toastr.success(response.data);
            clearForm();
            $(this).attr('disabled','disabled');
          } else {
            toastr.error(response.data);
          }
        });
      }
    });
  });

  function saveStaff(staffDetails) {
    return $.ajax({
      "url" : "staffs/save",
      "dataType" : "json",
      "type" : "POST",
      "data" : staffDetails
    });
  };

  function modifyStaff(staffDetails) {
    return $.ajax({
      "url" : "staffs/modify",
      "dataType" : "json",
      "type" : "POST",
      "data" : staffDetails
    });
  };

  function removeStaff(staffId) {
    return $.ajax({
      "url" : "staffs/remove",
      "dataType" : "json",
      "type" : "POST",
      "data" : { staff_id : staffId }
    })
  };

  function clearForm() {
    $('form').find("input[type=text], textarea").val("");
    $("form input[type='hidden']").val("0");
    $('.image').attr('src', './assets/application/img/user-default.png');
    $("form input:text").first().focus();
  }

}));
