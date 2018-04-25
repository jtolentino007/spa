// IIFE - Immediately Invoked Function Expression
(function(app) {
  // The global jQuery object is passed as a parameter
  app(window.jQuery, window, document);

}(function($, window, document) {

  // The $ is now locally scoped
  // Listen for the jQuery ready event on the document.
  var _tblSections = $('#tbl_sections');
  var _modalSections = $('#modal_sections');
  var _dTableSections;
  var _mode;
  var _selectedTr;
  var _tblSectionBody = $('#tbl_sections tbody');
  var _dialog = $('#dialog-confirmation');
  var _sectionID;

  $(function() {
    // The DOM is ready!
    _dTableSections = _tblSections.DataTable({
      "dom": '<"toolbar">frtip',
      "bLengthChange":false,
      "ajax": 'Sections/get',
      "columns": [
        {
          targets:[0],
          render:function(data, type, row, meta) {
            return "";
          }
        },
        { targets:[1],data:"section_name" },
        { targets:[2],data:"section_desc" },
        {
          targets:[3],
          class: 'text-center',
          render: function(){
            return '<button class="btn btn-primary btn-edit-info rounded-circle"><i class="fa fa-edit"></i></button>' + ' ' + '<button class="btn btn-danger btn-remove-section rounded-circle"><i class="fa fa-trash"></i></button>'
          }
        }
      ]
    });

    $("div.toolbar").html('<button id="btn-new-section" class="btn btn-primary toolbtn"><i class="fa fa-plus"></i> New Section</button>');

    _tblSectionBody.on('click', '.btn-edit-info',function(){
      _mode = "edit";
      _selectedTr = $(this).parents('tr');

      $(this).removeAttr('disabled');
      var _sectionData = _dTableSections.row(_selectedTr).data();

      $('input[name="sections_id"]').val(_sectionData.sections_id);
      $('input[name="section_name"]').val(_sectionData.section_name);
      $('textarea[name="section_desc"]').val(_sectionData.section_desc);

      _modalSections.modal('show');
    });

    _tblSectionBody.on('click', '.btn-remove-section', function() {
      _selectedTr = $(this).parents('tr');
      _sectionID = _dTableSections.row($(this).parents('tr')).data().sections_id;
      _dialog.modal('show');
    });

    _dialog.on('click','#btn-confirm', function(){
      removeSection(_sectionID).done(function(response){
        if (response.status == "success") {
          toastr.success(response.data);
          _dTableSections.row(_selectedTr).remove().draw();
        } else {
          toastr.error(response.data);
        }
        _dialog.modal('hide');
      });
    });

    $('#btn-new-section').click(function(){
      _mode = "add";
      $(this).removeAttr('disabled');
      clearForm();
      _modalSections.modal('show');
      $("form input:text").first().focus();
    });

    $('#btn-save-section').click(function(){

      var _data = $('#frm_section').serializeArray();
      if (_mode == "add") {
        saveSection(_data).done(function(response){
          if (response.status == "success") {
            _dTableSections.row.add(response.section[0]).draw();
            _modalSections.modal('hide');
            toastr.success(response.data);
            clearForm();
            $(this).attr('disabled','disabled');
          } else {
            toastr.error(response.data);
          }
        });
      } else {
        modifySection(_data).done(function(response){
          if (response.status == "success") {
            _dTableSections.row(_selectedTr).data(response.section[0]).draw();
            _modalSections.modal('hide');
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

  function saveSection(sectionDetails) {
    return $.ajax({
      "url" : "sections/save",
      "dataType" : "json",
      "type" : "POST",
      "data" : sectionDetails
    });
  };

  function modifySection(sectionDetails) {
    return $.ajax({
      "url" : "sections/modify",
      "dataType" : "json",
      "type" : "POST",
      "data" : sectionDetails
    });
  };

  function removeSection(sectionId) {
    return $.ajax({
      "url" : "sections/remove",
      "dataType" : "json",
      "type" : "POST",
      "data" : { sections_id : sectionId }
    })
  };

  function clearForm() {
    $('form').find("input[type=text], textarea").val("");
    $("form input[type='hidden']").val("0");
    $("form input:text").first().focus();
  }

}));
