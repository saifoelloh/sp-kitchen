  <div class="modal fade" id="modal-check" tabindex="-1" role="dialog" aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        
          <div class="modal-body p-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                Form Pemesanan.
              </div>
              <form role="form" action="{{route('list-order.find')}}" method="POST"> <!-- FORM -->
                @csrf
                <div class="form-group mb-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                    </div>
                    <input class="form-control" placeholder="Nomor HP (WA aktif)" type="text" name="phone">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="text" name="email">
                  </div>
                </div>
                <div class="text-center">

                  <!-- link ubah -->
                  <button type="submit" class="btn btn-block btn-info my-4">
                    Lanjut Order
                  </button>
                  
                </div>
              </form>

            </div>
          </div>

      </div>
    </div>
  </div>
  </div>
