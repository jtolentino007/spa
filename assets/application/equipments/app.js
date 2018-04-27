// IIFE - Immediately Invoked Function Expression
(function(app) {
  // The global jQuery object is passed as a parameter
  app(window.jQuery, window, document);

}(function($, window, document) {

  // The $ is now locally scoped
  // Listen for the jQuery ready event on the document.
  var _tblEquipments = $('#tbl_equipments');
  var _modalEquipment = $('#modal_equipments');
  var _dTableEquipments;
  var _mode;
  var _selectedTr;
  var _tblEquipmentBody = $('#tbl_equipments tbody');
  var _dialog = $('#dialog-confirmation');
  var _equipmentID;
  var _selectSection = $('.select-section').select2({ dropdownParent: $('#modal_equipments'), placeholder: "Select a section", allowClear: true });

  $(function() {
    // The DOM is ready!
    _dTableEquipments = _tblEquipments.DataTable({
      "dom": '<"toolbar">frtip',
      "bLengthChange":false,
      "ajax": 'Equipments/get',
      "columns": [
        { targets:[0],data:"equipment" },
        { targets:[1],data:"equipment_desc" },
        { targets:[2],data:"section_name" },
        {
          targets:[3],
          class: 'text-center',
          render: function(){
            return '<button class="btn btn-primary btn-edit-info rounded-circle"><i class="fa fa-edit"></i></button>' + ' ' + '<button class="btn btn-danger btn-remove-equipment rounded-circle"><i class="fa fa-trash"></i></button>'
          }
        }
      ]
    });

    $("div.toolbar").html('<button id="btn-new-equipment" class="btn btn-primary toolbtn"><i class="fa fa-plus"></i> New Equipment</button>');

    fillSelect2();

    _tblEquipmentBody.on('click', '.btn-edit-info',function(){
      _mode = "edit";
      _selectedTr = $(this).parents('tr');

      $(this).removeAttr('disabled');
      var _equipmentData = _dTableEquipments.row(_selectedTr).data();

      $('input[name="equipment_id"]').val(_equipmentData.equipment_id);
      $('input[name="equipment"]').val(_equipmentData.equipment);
      $('textarea[name="equipment_desc"]').val(_equipmentData.equipment_desc);
      _selectSection.select2('val',_equipmentData.section_id);

      _modalEquipment.modal('show');
    });

    _tblEquipmentBody.on('click', '.btn-remove-equipment', function() {
      _selectedTr = $(this).parents('tr');
      _equipmentID = _dTableEquipments.row($(this).parents('tr')).data().equipment_id;
      _dialog.modal('show');
    });

    _dialog.on('click','#btn-confirm', function(){
      removeEquipment(_equipmentID).done(function(response){
        if (response.status == "success") {
          toastr.success(response.data);
          _dTableEquipments.row(_selectedTr).remove().draw();
        } else {
          toastr.error(response.data);
        }
        _dialog.modal('hide');
      });
    });

    $('#btn-new-equipment').click(function(){
      _mode = "add";
      $(this).removeAttr('disabled');
      clearForm();
      $(".select-section").val('').trigger('change');
      _modalEquipment.modal('show');

      $("form input:text").first().focus();
    });

    $('#btn-save-equipment').click(function(){
      var _data = $('#frm_equipment').serializeArray();

      _data.push({name: 'section_id', value: _selectSection.select2('val')});
      if (_mode == "add") {
        saveEquipment(_data).done(function(response){
          if (response.status == "success") {
            _dTableEquipments.row.add(response.equipment[0]).draw();
            _modalEquipment.modal('hide');
            toastr.success(response.data);
            clearForm();
            $(this).attr('disabled','disabled');
          } else {
            toastr.error(response.data);
          }
        });
      } else {
        modifyEquipment(_data).done(function(response){
          if (response.status == "success") {
            _dTableEquipments.row(_selectedTr).data(response.equipment[0]).draw();
            _modalEquipment.modal('hide');
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

  function fillSelect2() {
    var items = "";

    $.ajax({
      "url":"sections/get",
      "dataType":"json",
      "type":"GET"
    }).done(function(response){
      $.each(response.data, function(index, data){
        items += "<option value='"+data.sections_id+"'>"+data.section_name+"</option>";
      });
      _selectSection.append(items);
    });

  };

  function saveEquipment(equipmentDetails) {
    return $.ajax({
      "url" : "equipments/save",
      "dataType" : "json",
      "type" : "POST",
      "data" : equipmentDetails
    });
  };

  function modifyEquipment(equipmentDetails) {
    return $.ajax({
      "url" : "equipments/modify",
      "dataType" : "json",
      "type" : "POST",
      "data" : equipmentDetails
    });
  };

  function removeEquipment(equipmentId) {
    return $.ajax({
      "url" : "equipments/remove",
      "dataType" : "json",
      "type" : "POST",
      "data" : { equipment_id : equipmentId }
    })
  };

  function clearForm() {
    $('form').find("input[type=text], textarea").val("");
    $("form input[type='hidden']").val("0");
    $("form input:text").first().focus();
  }

}));
