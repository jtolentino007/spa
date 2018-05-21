// IIFE - Immediately Invoked Function Expression
(function(app) {
  // The global jQuery object is passed as a parameter
  app(window.jQuery, window, document);

}(function($, window, document) {

  // The $ is now locally scoped
  // Listen for the jQuery ready event on the document.
  var _tblCategories = $('#tbl_categories');
  var _modalCategories = $('#modal_categories');
  var _dTableCategories;
  var _mode;
  var _selectedTr;
  var _tblCategoryBody = $('#tbl_categories tbody');
  var _dialog = $('#dialog-confirmation');
  var _categoryID;

  $(function() {
    // The DOM is ready!
    _dTableCategories = _tblCategories.DataTable({
      "dom": '<"toolbar">frtip',
      "bLengthChange":false,
      "ajax": 'Categories/get',
      "columns": [
        {
          targets:[0],
          render:function(data, type, row, meta) {
            return "";
          }
        },
        { targets:[1],data:"category_name" },
        { targets:[2],data:"category_desc" },
        {
          targets:[3],
          class: 'text-center',
          render: function(){
            return '<button class="btn btn-primary btn-edit-info rounded-circle"><i class="fa fa-pencil-alt"></i></button>' + ' ' + '<button class="btn btn-danger btn-remove-category rounded-circle"><i class="fa fa-trash"></i></button>'
          }
        }
      ]
    });

    $("div.toolbar").html('<button id="btn-new-category" class="btn btn-primary toolbtn"><i class="fa fa-plus"></i> New Category</button>');

    _tblCategoryBody.on('click', '.btn-edit-info',function(){
      _mode = "edit";
      _selectedTr = $(this).parents('tr');

      $(this).removeAttr('disabled');
      var _categoryData = _dTableCategories.row(_selectedTr).data();

      $('input[name="category_id"]').val(_categoryData.category_id);
      $('input[name="category_name"]').val(_categoryData.category_name);
      $('textarea[name="category_desc"]').val(_categoryData.category_desc);

      _modalCategories.modal('show');
    });

    _tblCategoryBody.on('click', '.btn-remove-category', function() {
      _selectedTr = $(this).parents('tr');
      _categoryID = _dTableCategories.row($(this).parents('tr')).data().category_id;
      _dialog.modal('show');
    });

    _dialog.on('click','#btn-confirm', function(){
      removeCategory(_categoryID).done(function(response){
        if (response.status == "success") {
          toastr.success(response.data);
          _dTableCategories.row(_selectedTr).remove().draw();
        } else {
          toastr.error(response.data);
        }
        _dialog.modal('hide');
      });
    });

    $('#btn-new-category').click(function(){
      _mode = "add";
      $(this).removeAttr('disabled');
      clearForm();
      _modalCategories.modal('show');
      $("form input:text").first().focus();
    });

    $('#btn-save-category').click(function(){

      var _data = $('#frm_section').serializeArray();
      if (_mode == "add") {
        saveCategory(_data).done(function(response){
          if (response.status == "success") {
            _dTableCategories.row.add(response.category[0]).draw();
            _modalCategories.modal('hide');
            toastr.success(response.data);
            clearForm();
            $(this).attr('disabled','disabled');
          } else {
            toastr.error(response.data);
          }
        });
      } else {
        modifyCategory(_data).done(function(response){
          if (response.status == "success") {
            _dTableCategories.row(_selectedTr).data(response.category[0]).draw();
            _modalCategories.modal('hide');
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

  function saveCategory(categoryDetails) {
    return $.ajax({
      "url" : "categories/save",
      "dataType" : "json",
      "type" : "POST",
      "data" : categoryDetails
    });
  };

  function modifyCategory(categoryDetails) {
    return $.ajax({
      "url" : "categories/modify",
      "dataType" : "json",
      "type" : "POST",
      "data" : categoryDetails
    });
  };

  function removeCategory(categoryId) {
    return $.ajax({
      "url" : "categories/remove",
      "dataType" : "json",
      "type" : "POST",
      "data" : { category_id : categoryId }
    })
  };

  function clearForm() {
    $('form').find("input[type=text], textarea").val("");
    $("form input[type='hidden']").val("0");
    $("form input:text").first().focus();
  }

}));
