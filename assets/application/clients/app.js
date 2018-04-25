// IIFE - Immediately Invoked Function Expression
(function(app) {
  // The global jQuery object is passed as a parameter
  app(window.jQuery, window, document);

}(function($, window, document) {

  // The $ is now locally scoped
  // Listen for the jQuery ready event on the document.
  var _tblClients = $('#tbl_clients');
  var _modalClient = $('#modal_clients');
  var _dTableClients;
  var _mode;
  var _selectedTr;
  var _tblClientBody = $('#tbl_clients tbody');
  var _dialog = $('#dialog-confirmation');
  var _clientID;

  $(function() {
    // The DOM is ready!
    _dTableClients = _tblClients.DataTable({
      "dom": '<"toolbar">frtip',
      "bLengthChange":false,
      "ajax": 'Clients/get',
      "columns": [
        {
          targets:[0],data:"photo_path",render:function(data, type, row, meta) {
            return "<img class='rounded-circle' src='"+data+"' style='width: 50px; height: 50px; border: 1px solid #e2e2e2'/>";
          }
        },
        { targets:[1],data:"customer_name" },
        { targets:[2],data:"address" },
        { targets:[3],data:"email_address" },
        { targets:[4],data:"mobile_no" },
        {
          targets:[5],
          class: 'text-center',
          render: function(){
            return '<button class="btn btn-primary btn-edit-info rounded-circle"><i class="fa fa-edit"></i></button>' + ' ' + '<button class="btn btn-danger btn-remove-client rounded-circle"><i class="fa fa-trash"></i></button>'
          }
        }
      ]
    });

    $("div.toolbar").html('<button id="btn-new-customer" class="btn btn-primary toolbtn"><i class="fa fa-plus"></i> New Client</button>');

    _tblClientBody.on('click', '.btn-edit-info',function(){
      _mode = "edit";
      _selectedTr = $(this).parents('tr');

      $(this).removeAttr('disabled');
      var _clientsData = _dTableClients.row(_selectedTr).data();

      $('input[name="customer_id"]').val(_clientsData.customer_id);
      $('input[name="customer_name"]').val(_clientsData.customer_name);
      $('input[name="address"]').val(_clientsData.address);
      $('input[name="email_address"]').val(_clientsData.email_address);
      $('input[name="mobile_no"]').val(_clientsData.mobile_no);
      $('.image').attr('src',_clientsData.photo_path);

      _modalClient.modal('show');
    });

    _tblClientBody.on('click', '.btn-remove-client', function() {
      _selectedTr = $(this).parents('tr');
      _clientID = _dTableClients.row($(this).parents('tr')).data().customer_id;
      _dialog.modal('show');
    });

    _dialog.on('click','#btn-confirm', function(){
      removeClient(_clientID).done(function(response){
        if (response.status == "success") {
          toastr.success(response.data);
          _dTableClients.row(_selectedTr).remove().draw();
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

    $('#btn-new-customer').click(function(){
      _mode = "add";
      $(this).removeAttr('disabled');
      clearForm();
      _modalClient.modal('show');
      $("form input:text").first().focus();
    });

    $('#btn-save-client').click(function(){

      var _data = $('#frm_client').serializeArray();
      _data.push({name: 'photo_path', value: $('.image').attr('src')});
      if (_mode == "add") {
        saveClient(_data).done(function(response){
          if (response.status == "success") {
            _dTableClients.row.add(response.client[0]).draw();
            _modalClient.modal('hide');
            toastr.success(response.data);
            clearForm();
            $(this).attr('disabled','disabled');
          } else {
            toastr.error(response.data);
          }
        });
      } else {
        modifyClient(_data).done(function(response){
          if (response.status == "success") {
            _dTableClients.row(_selectedTr).data(response.client[0]).draw();
            _modalClient.modal('hide');
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

  function saveClient(clientDetails) {
    return $.ajax({
      "url" : "clients/save",
      "dataType" : "json",
      "type" : "POST",
      "data" : clientDetails
    });
  };

  function modifyClient(clientDetails) {
    return $.ajax({
      "url" : "clients/modify",
      "dataType" : "json",
      "type" : "POST",
      "data" : clientDetails
    });
  };

  function removeClient(clientId) {
    return $.ajax({
      "url" : "clients/remove",
      "dataType" : "json",
      "type" : "POST",
      "data" : { customer_id : clientId }
    })
  };

  function clearForm() {
    $('form').find("input[type=text], textarea").val("");
    $("form input[type='hidden']").val("0");
    $('.image').attr('src', './assets/application/img/user-default.png');
    $("form input:text").first().focus();
  }

}));
