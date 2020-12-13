
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_kriteria_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-kriteria" name="form-kriteria">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id" name="id">
            <label for="" class="form-control-label">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Kategori:</label>
            <select name="kategori" id="kategori" class="form-control"> 
              <?php 
              $data_kat = $this->db->get_Where('m_kategori', ['deleted_at' => null])->result();
              echo '<option value="">Silahkan Pilih Kategori</option>';
              foreach ($data_kat as $key => $value) {
                echo '<option value="'.$value->id.'">'.$value->nama.'</option>';
              } ?>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="" class="form-control-label">Kode Kriteria:</label>
            <select name="kode" id="kode" class="form-control"> 
              <?php 
              echo '<option value="">Silahkan Pilih Kode Kriteria</option>';
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
              echo '<option value="">Silahkan Pilih Urutan Kriteria</option>';
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
