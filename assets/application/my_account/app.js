// IIFE - Immediately Invoked Function Expression
(function(app) {
  // The global jQuery object is passed as a parameter
  app(window.jQuery, window, document);

}(function($, window, document) {

  // The $ is now locally scoped
  // Listen for the jQuery ready event on the document.

  _btnSave = $('#btn_save');

  $(function() {
    // The DOM is ready!
    _btnSave.click(function(){
      var _data = $('#frm_user').serializeArray();

      update(_data).done(function(response){
        if (response.status == "success") {
          toastr.success(response.data);
          window.location = "auth/logout";
        } else {
          toastr.error(response.data);
        }
      });
    });
  });

  function update(userDetails) {
    return $.ajax({
      "url" : "my_account/update",
      "dataType" : "json",
      "type" : "POST",
      "data" : userDetails
    });
  };

}));
