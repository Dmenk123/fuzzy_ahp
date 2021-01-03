
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_proyek_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-proyek" name="form-proyek">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id" name="id">
            <label for="" class="form-control-label">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
            <span class="help-block"></span>
          </div>

          <div class="form-group">
            <label for="" class="form-control-label">Keterangan:</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off">
            <span class="help-block"></span>
          </div>
          
          <div class="form-group">
            <label for="" class="form-control-label">Tahun Mulai Proyek:</label>
            <select name="tahun_awal" id="tahun_awal" class="form-control"> 
              <?php 
              echo '<option value="">Silahkan Pilih Tahun</option>';
              for ($i=(int)date('Y')-10; $i <= (int)date('Y')+30; $i++) { 
                echo '<option value="'.$i.'">'.$i.'</option>';
              } ?>
            </select>
            <span class="help-block"></span>
          </div>

          <div class="form-group">
            <label for="" class="form-control-label">Tahun Akhir Proyek:</label>
            <select name="tahun_akhir" id="tahun_akhir" class="form-control"> 
              <?php 
              echo '<option value="">Silahkan Pilih Tahun</option>';
              for ($i=(int)date('Y')-10; $i <= (int)date('Y')+30; $i++) { 
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
