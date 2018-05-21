// IIFE - Immediately Invoked Function Expression
(function(app) {
  // The global jQuery object is passed as a parameter
  app(window.jQuery, window, document);

}(function($, window, document) {

  // The $ is now locally scoped
  // Listen for the jQuery ready event on the document.
  var _tblUsers = $('#tbl_users');
  var _modalUsers = $('#modal_users');
  var _dTableUsers;
  var _selectedTr;
  var _userID;
  var _value;
  var _tblUsersBody = $('#tbl_users tbody');
  var _dialog = $('#dialog-confirmation');

  $(function() {
    _dTableUsers = _tblUsers.DataTable({
      "dom": '<"toolbar">frtip',
      "bLengthChange":false,
      "ajax": 'User_accounts/get',
      "columns": [
        {
          targets:[0],
          render:function(data, type, row, meta) {
            return "";
          }
        },
        {
          targets:[1],
          render: function(data, type, row, meta) {
            return row.first_name + ' ' + row.last_name;
          }
        },
        { targets:[2],data:"phone" },
        { targets:[3],data:"email" },
        {
          class: 'text-center',
          targets:[4],data:"active",
          render: function(data, type, row, meta) {
            return "<i class=' fa fa-"+(data == 1 ? "check-circle text-success" : "times-circle text-danger")+"'></i>";
          }
        },
        {
          targets:[5],
          class: 'text-center',
          render: function(data, type, row, meta){
            return '<button style="min-width: 110px;" class="btn btn-deactivate-user btn-'+(row.active == 1 ? 'danger" data-value="0">DEACTIVATE' : 'success" data-value="1">ACTIVATE')+'</button>';
          }
        }
      ]
    });

    $("div.toolbar").html('<button id="btn-new-user" class="btn btn-primary toolbtn"><i class="fa fa-plus"></i> New User</button>');

    $('#btn-new-user').click(function(){
      _mode = "add";
      $(this).removeAttr('disabled');
      clearForm();
      _modalUsers.modal('show');
      $("form input:text").first().focus();
    });

    $('#btn-save-user').click(function(){
      var _data = $('#frm_user').serializeArray();

      register(_data).done(function(response){
        if (response.status == "success") {
          _dTableUsers.row.add(response.user).draw();
          _modalUsers.modal('hide');
          toastr.success(response.data);
          clearForm();
          $(this).attr('disabled','disabled');
        } else {
          toastr.error(response.data);
        }
      });
    });

    _tblUsersBody.on('click', '.btn-deactivate-user', function() {
      _selectedTr = $(this).parents('tr');
      _userID = _dTableUsers.row(_selectedTr).data().user_id;
      _value = $(this).data('value');

      _dialog.modal('show');
    });

    _dialog.on('click','#btn-confirm', function(){
      var _data = [];

      _data.push({name: 'id', value: _userID });
      _data.push({name: 'status', value: _value });

      activate_deactivate(_data).done(function(response){
        if (response.status == "success") {
          toastr.success(response.data);
          _dTableUsers.row(_selectedTr).data(response.user).draw();
        } else {
          toastr.error(response.data);
        }
        _dialog.modal('hide');
      });
    });

    function register(userDetails) {
      return $.ajax({
        "url" : "auth/create_user",
        "dataType" : "json",
        "type" : "POST",
        "data" : userDetails
      });
    };

    function activate_deactivate(data) {
      return $.ajax({
        "url": "user_accounts/change_status",
        "dataType": "json",
        "type": "POST",
        "data": data
      });
    };

    function clearForm() {
      $('form').find("input[type=text], textarea").val("");
      $("form input[type='hidden']").val("0");
      $("form input").first().focus();
    };
  });

}));
