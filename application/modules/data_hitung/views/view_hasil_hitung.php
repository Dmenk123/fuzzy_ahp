<?php
$obj_date = new DateTime();
$data_kat = $this->db->get_Where('m_kategori', ['deleted_at' => null])->result();
?>
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
          <h3 class="kt-portlet__head-title">
            <?= 'Hasil Perhitungan Kategori '.$kategori->nama; ?>
          </h3>
        </div>
      </div>

      <div class="kt-portlet__body" id="menu_area">
         <!--begin: Datatable -->
         <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_data">
          <thead>
            <tr>
              <th style="width: 5%;">No</th>
              <th>Proyek</th>
              <th>Nama Kategori</th>
              <th>Total lower</th>
              <th>Total Medium</th>
              <th>Total Upper</th>
              <th style="width: 5%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if($data_hitung) { ?>
              <?php foreach ($data_hitung as $k => $v) { ?>
                <tr>
                  <th><?= ++$k; ?></th>
                  <th><?= $v->nama_proyek.' ['.$v->tahun_proyek.']'; ?></th>
                  <th><?= $v->nama_kategori; ?></th>
                  <th><?= number_format((float)$v->total_lower, 4); ?></th>
                  <th><?= number_format((float)$v->total_medium, 4); ?></th>
                  <th><?= number_format((float)$v->total_upper, 4); ?></th>
                  <th>
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
                      <div class="dropdown-menu">
                        <?php if($v->total_lower) { ?>
                          <a class="dropdown-item" target="_blank" href="<?=base_url('data_hitung/detail_perhitungan/'.$v->id.'?kategori='.$this->uri->segment(3).'&kriteria=C1');?>">
                            <i class="la la-bar-chart-o"></i> Lihat Data
                          </a>
                        <?php } ?>
                      </div>
                    </div>
                  </th>
                </tr>  
              <?php } ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
      
    </div>  
  </div>
</div>



