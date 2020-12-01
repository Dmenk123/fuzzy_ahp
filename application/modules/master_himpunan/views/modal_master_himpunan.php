
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_himpunan_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-himpunan" name="form-himpunan">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_himp" name="id_himp">
            <label for="" class="form-control-label">Nama:</label>
            <input type="text" class="form-control" id="nama_himp" name="nama_himp" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Lower:</label>
            <input type="text" class="form-control" id="lower_txt_himp" name="lower_txt_himp" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Medium:</label>
            <input type="text" class="form-control" id="medium_txt_himp" name="medium_txt_himp" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Upper:</label>
            <input type="text" class="form-control" id="upper_txt_himp" name="upper_txt_himp" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-success" onclick="hitung()">Cek</button>
          </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
          <div class="form-group">
            <label for="" class="form-control-label">Lower (desimal):</label>
            <input type="text" class="form-control" id="lower_val_himp" name="lower_val_himp" autocomplete="off" readonly>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Medium (desimal):</label>
            <input type="text" class="form-control" id="medium_val_himp" name="medium_val_himp" autocomplete="off" readonly>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Upper (desimal):</label>
            <input type="text" class="form-control" id="upper_val_himp" name="upper_val_himp" autocomplete="off" readonly>
            <span class="help-block"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Simpan</button>
      </div>
    </div>
  </div>
</div>
