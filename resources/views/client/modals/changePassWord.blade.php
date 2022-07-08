<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form action="{{ route('worker.change.password',[$worker->id]) }}" method="POST" id="changePasswordWorker">
        @csrf
        <input type="hidden" value="{{$worker->id}}" name="id">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title d-left" id="exampleModalLabel">Change password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                  <div class="container">
                {{-- @if (session('status') == 1)
                    <div class="alert alert-success" role="alert">
                        {{ session('msg') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif --}}
              <div class="table">
                <div class="row">
                    <div class="col-lg-4 col-xs-12 bgr-col">
                      <div class="curen-pass">
                        <label>Current password</label>
                        <span style="color: red;font-weight: bold;">*</span>
                      </div>
                  </div>
                    <div class="col-lg-8 col-xs-12 input-about">
                      <div class="input-password">
                        <input type="text" id="oldpassword" name="oldpassword" value="" class="current_password_input"><br>
                          <span class="text-danger error-text oldpassword_error"></span>
                      </div>
                    </div>

                </div>
                <div class="row">
                  <div class="col-lg-4 col-xs-12 bgr-col">
                    <div class="curen-pass">
                      <label>New password</label>
                      <span style="color: red;font-weight: bold;">*</span>
                    </div>
                </div>
                  <div class="col-lg-8 col-xs-12 input-about">
                    <div class="input-password">
                      <input type="password" id="newpassword" name="newpassword" value="" class="current_password_input"><br>
                      <span class="text-danger error-text newpassword_error"></span>
                      <label>Please enter at least 6 characters for your password</label>
                    </div>
                  </div>

              </div>
              <div class="row">
                <div class="col-lg-4 col-xs-12 bgr-col">
                  <div class="comfirm-password">
                    <label>Confirm new password</label>
                    <span style="color: red;font-weight: bold;">*</span>
                  </div>
              </div>
                <div class="col-lg-8 col-xs-12 input-about-bottom">
                  <div class="input-password">
                    <input type="password" id="cnewpassword" name="cnewpassword" value="" class="current_password_input"><br>
                    <span class="text-danger error-text cnewpassword_error"></span>
                  </div>
                </div>

            </div>  
              </div>
            </div>
          </div>
          <div class="modal-footer submit-changepassword">
            <button type="submit" class="btn btn-primary align-center">UPDATE</button>
          </div>
      </form>
      </div>
    </div>
  </div>