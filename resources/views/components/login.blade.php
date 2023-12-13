<form action="/auth/login" method="POST" class="mb-0 pt-2 pt-md-0">
    @csrf
    <div class="row align-items-center">
      <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
        <input name="loginusername" class="form-control form-control-sm input-dark" type="text" placeholder="Username" autocomplete="off" />
      </div>
      <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
        <input name="loginpassword" class="form-control form-control-sm input-dark" type="password" placeholder="Password" />
      </div>
      <div class="col-md-auto">
        <button class="btn btn-primary btn-sm">Sign In</button>
      </div>
    </div>
  </form>