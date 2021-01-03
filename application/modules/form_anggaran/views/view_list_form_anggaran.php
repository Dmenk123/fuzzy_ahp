<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul').' - '.$title; ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions row">
              <div>
              <!-- <a href="<?=base_url('hitung_ahp/formulir_hitung?kategori='.$this->uri->segment(3).'&kriteria=C1');?>" class="btn btn-bold btn-label-brand btn-sm"><i class="la la-plus"></i>Tambah Data</a> -->
              <a href="<?=base_url('form_anggaran/formulir_proyek');?>" class="btn btn-bold btn-label-brand btn-sm"><i class="la la-plus"></i>Tambah Data</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_data">
          <thead>
            <tr>
              <th style="width: 5%;">No</th>
              <th>Proyek</th>
              <th style="width: 5%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if($data_anggaran) { ?>
              <?php foreach ($data_anggaran as $k => $v) { ?>
                <tr>
                  <th><?= ++$k; ?></th>
                  <th><?= $v->nama_proyek.' ['.$v->tahun_proyek.' s/d '.$v->tahun_akhir_proyek.']'; ?></th>
                  <th>
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
                      <div class="dropdown-menu">
                        <?php if($v->data_json) { ?>
                          <a class="dropdown-item" target="_blank" href="<?=base_url('data_hitung/detail_perhitungan/').$this->enkripsi->enc_dec('encrypt', $v->id);?>">
                            <i class="la la-bar-chart-o"></i> Lihat Data
                          </a>
                          <a class="dropdown-item" href="<?=base_url('hitung_ahp/formulir_hitung/').$this->enkripsi->enc_dec('encrypt', $v->id).'?kategori='.$this->enkripsi->enc_dec('encrypt', 1);?>">
                            <i class="la la-pencil"></i> Edit
                          </a>
                        <?php } ?>
                       
                        <button class="dropdown-item" onclick="delete_data('<?= $v->id; ?>')">
                          <i class="la la-trash"></i> Hapus
                        </button>
                      </div>
                    </div>
                  </th>
                </tr>  
              <?php } ?>
            <?php } ?>
          </tbody>
        </table>

        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



