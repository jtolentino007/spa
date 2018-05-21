// IIFE - Immediately Invoked Function Expression
(function(app) {
  // The global jQuery object is passed as a parameter
  app(window.jQuery, window, document);

}(function($, window, document) {

  // The $ is now locally scoped
  // Listen for the jQuery ready event on the document.
  var _tblServices     = $('#tbl_services');
  var _modalServices   = $('#modal_services');
  var _dTableServices;
  var _mode;
  var _selectedTr;
  var _tblServiceBody  = $('#tbl_services tbody');
  var _dialog          = $('#dialog-confirmation');
  var _serviceID;
  var _selectCategory  = $('#cbo-category').select2({
                            dropdownParent: $('#modal_services'),
                            placeholder: "Select a category",
                            allowClear: true
                          });

  $(function() {
    // The DOM is ready!
    _dTableServices = _tblServices.DataTable({
      "dom": '<"toolbar">frtip',
      "bLengthChange":false,
      "ajax": 'Services/get',
      "columns": [
        {
          targets:[0],
          render:function(data, type, row, meta) {
            return "";
          }
        },
        { targets:[1],data: "service_name" },
        { targets:[2],data: "category_name" },
        { targets:[3],data: "time" },
        {
          class: 'text-right',
          targets:[4],
          data: "price"
        },
        {
          targets:[5],
          class: 'text-center',
          render: function(){
            return '<button class="btn btn-primary btn-edit-info rounded-circle"><i class="fa fa-pencil-alt"></i></button>' + ' ' + '<button class="btn btn-danger btn-remove-service rounded-circle"><i class="fa fa-trash"></i></button>'
          }
        }
      ]
    });

    $("div.toolbar").html('<button id="btn-new-service" class="btn btn-primary toolbtn"><i class="fa fa-plus"></i> New Service</button>');

    fillSelect2();

    _tblServiceBody.on('click', '.btn-edit-info',function(){
      _mode = "edit";
      _selectedTr = $(this).parents('tr');

      $(this).removeAttr('disabled');
      var _serviceData = _dTableServices.row(_selectedTr).data();

      $('input[name="service_id"]').val(_serviceData.service_id);
      $('input[name="service_name"]').val(_serviceData.service_name);
      $('input[name="time"]').val(_serviceData.time);
      $('input[name="price"]').val(_serviceData.price);
      _selectCategory.select2('val',_serviceData.category_id);

      _modalServices.modal('show');
    });

    _tblServiceBody.on('click', '.btn-remove-service', function() {
      _selectedTr = $(this).parents('tr');
      _serviceID = _dTableServices.row($(this).parents('tr')).data().service_id;

      _dialog.modal('show');
    });

    _dialog.on('click','#btn-confirm', function(){
      removeService(_serviceID).done(function(response){
        if (response.status == "success") {
          toastr.success(response.data);
          _dTableServices.row(_selectedTr).remove().draw();
        } else {
          toastr.error(response.data);
        }
        _dialog.modal('hide');
      });
    });

    $('#btn-new-service').click(function(){
      _mode = "add";
      $(this).removeAttr('disabled');
      clearForm();
      $("#cbo-category").val('').trigger('change');
      _modalServices.modal('show');
      $("form input:text").first().focus();
    });

    $('#btn-save-service').click(function(){

      var _data = $('#frm_services').serializeArray();

      if (_mode == "add") {
        saveService(_data).done(function(response){
          if (response.status == "success") {
            _dTableServices.row.add(response.service[0]).draw();
            _modalServices.modal('hide');
            toastr.success(response.data);
            clearForm();
            $(this).attr('disabled','disabled');
          } else {
            toastr.error(response.data);
          }
        });
      } else {
        modifyService(_data).done(function(response){
          if (response.status == "success") {
            _dTableServices.row(_selectedTr).data(response.service[0]).draw();
            _modalServices.modal('hide');
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

  function saveService(serviceDetails) {
    return $.ajax({
      "url" : "services/save",
      "dataType" : "json",
      "type" : "POST",
      "data" : serviceDetails
    });
  };

  function modifyService(serviceDetails) {
    return $.ajax({
      "url" : "services/modify",
      "dataType" : "json",
      "type" : "POST",
      "data" : serviceDetails
    });
  };

  function removeService(serviceId) {
    return $.ajax({
      "url" : "services/remove",
      "dataType" : "json",
      "type" : "POST",
      "data" : { service_id : serviceId }
    })
  };

  function clearForm() {
    $('form').find("input[type=text], textarea").val("");
    $("form input[type='hidden']").val("0");
    $("form input[type='time']").val("00:00");
    $("form input:text").first().focus();
  };

  function fillSelect2() {
    var items = "";

    $.ajax({
      "url":"categories/get",
      "dataType":"json",
      "type":"GET"
    }).done(function(response){
      $.each(response.data, function(index, data){
        items += "<option value='"+data.category_id+"'>"+data.category_name+"</option>";
      });
      _selectCategory.append(items);
    });

  };

}));
