<link rel="stylesheet" href="./assets/application/my_account/app.css">
<div class="container">
  <div class="row" style="padding: 0 10px;">
    <div class="col">
      <div class="card text-white bg-light">

          <div class="card-body" style="color: #404040;">
          <h3><i class="fa fa-user"></i> MY ACCOUNT</h3><hr>
          <form id="frm_user">
            <div class="row">
                  <div class="col-xs-12 col-md-6">
                    <label>E-mail address / Username:</label>
                    <input type="email" name="email" class="form-control" value="<?= $this->ion_auth->user()->row()->email; ?>" placeholder="johndoe@email.com">
                    <label>First Name:</label>
                    <input type="text" name="first_name" class="form-control" value="<?= $this->ion_auth->user()->row()->first_name; ?>" placeholder="John">
                    <label>Mobile number:</label>
                    <input type="text" name="phone" class="form-control" value="<?= $this->ion_auth->user()->row()->phone; ?>" placeholder="xxxx-xxx-xxxx">
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <br><br><br><br>
                    <label>Last Name:</label>
                    <input type="text" name="last_name" class="form-control" value="<?= $this->ion_auth->user()->row()->last_name; ?>" placeholder="Doe">
                  </div>
                </div>
            </div>
            </form>
            <div class="card-footer text-center">
              <button id="btn_save" class="btn btn-primary">Update my Profile</button>
            </div>
        </div>
    </div>
  </div>
</div>
<script src="./assets/application/my_account/app.js" type="text/javascript"></script>
