
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_kategori_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-kategori" name="form-kategori">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_kat" name="id_kat">
            <label for="" class="form-control-label">Nama:</label>
            <input type="text" class="form-control" id="nama_kat" name="nama_kat" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Kode Kategori:</label>
            <select name="kode" id="kode" class="form-control"> 
              <?php 
              echo '<option value="">Silahkan Pilih Kode Kategori</option>';
              for ($i=1; $i <= 20; $i++) { 
                echo '<option value="C'.$i.'">C'.$i.'</option>';
              } ?>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Urut:</label>
            <select name="urut" id="urut" class="form-control"> 
              <?php 
              echo '<option value="">Silahkan Pilih Urutan Kategori</option>';
              for ($i=1; $i <= 20; $i++) { 
                echo '<option value="'.$i.'">'.$i.'</option>';
              } ?>
            </select>
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
