<?php
$obj_date = new DateTime();
$data_kat = $this->db->from('m_kategori')->where(['deleted_at' => null])->order_by('urut', 'ASC')->get()->result();


// echo "<pre>";
// print_r ($data_kat);
// echo "</pre>";

// echo "<pre>";
// print_r ($data);
// echo "</pre>";
// exit;
?>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul'); ?>
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
            <?= $title; ?>
          </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Download / Cetak</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/download_excel_anggaran/'.$this->uri->segment(3);?>">
                    <i class="la la-arrow-circle-o-down"></i> Excel Anggaran
                  </a>
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/cetak_data_anggaran/'.$this->uri->segment(3);?>">
                    <i class="la la-print"></i> Cetak Anggaran
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="kt-portlet__body" id="vektor_area">
        <div class="col-lg-12 row">
          <div class="col-3">
            <span>Silahkan Pilih Tahun Proyek : </span>
          </div>
          <div class="col-6">
            <select name="thn_proyek" id="thn_proyek" class="form-control">
              <?php for ($i=(int)$data_anggaran->tahun_proyek; $i <= (int)$data_anggaran->tahun_akhir_proyek; $i++) { ?>
              <option value="<?=$i;?>" <?php if($this->input->get('tahun') == $i) { echo 'selected'; }?>><?=$i;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-2">
            <button onclick="pilihTahunProyek('<?=$this->enkripsi->enc_dec('encrypt', $data_anggaran->id);?>')" type="button" class="btn btn-md btn-success"> Pilih</button>
          </div>
        </div>
        <hr>
        <div class="col-lg-12 row table-responsive">
          <?php foreach ($kategori as $k => $v) { ?>
            <?php 
              $no = 1; 
              $grand_total_kat = 0;
            ?>
            <h5><?= $v->nama; ?></h5>
            <hr>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="text-align:center;">#</th>
                  <th style="text-align:center;">Uraian</th>
                  <th style="text-align:center;">Satuan</th>
                  <th style="text-align:center;">qty</th>
                  <th style="text-align:center;">Harga Satuan</th>
                  <th style="text-align:center;">Harga Total</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($data as $kk => $vv) { ?>
                <?php 
                  $kat_ini = $data[$kk]->id_kategori;
                  
                  if(count($data)-1 == $kk) {
                    $kat_next = $data[$kk]->id_kategori;
                  }else{
                    $kat_next = $data[$kk+1]->id_kategori;
                  }

                  if($kat_ini != $kat_next) {
                    $is_kolom_total = true;
                  }else{
                    if(count($data)-1 == $kk) {
                      $is_kolom_total = true;
                    }else{
                      $is_kolom_total = false;
                    }
                  }
                ?>

                <?php if($v->id == $vv->id_kategori) { ?>
                  <?php $grand_total_kat += $vv->harga_total;?>
                  <tr>
                    <th scope="row"><?=$no++;?></th>
                    <td width="30%"><?=$vv->nama_kriteria;?></td>
                    <td width="13%"><?=$vv->nama_satuan;?></td>
                    <td width="15%" align="right">
                      <?=number_format((float)$vv->qty, 2,',','.');?>
                    </td>
                    <td width="20%">
                      <span class="pull-left">Rp. </span>
                      <span class="pull-right"><?=number_format((float)$vv->harga_satuan, 2,',','.');?></span>
                    </td>
                    <td width="25%">
                      <span class="pull-left">Rp. </span>
                      <span class="pull-right"><?=number_format((float)$vv->harga_total, 2,',','.');?></span>
                    </td>
                  </tr>
                  <?php if($is_kolom_total) { ?>
                    <tr>
                      <th scope="row" colspan="5">Total </th>
                      <td>
                        <span class="pull-left">Rp. </span>
                        <span class="pull-right"><?=number_format((float)$grand_total_kat, 2,',','.');?></span>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } ?>
              <?php } ?> 
              </tbody>
            </table> 
          <?php } ?>   
        </div>
      </div>
  
    </div>  

    <div class="col-12">
      <a href="<?=base_url('data_hitung');?>" class="btn btn-bold btn-label-brand btn-sm"><i class="la la-arrow-left"></i>Kembali Ke Menu Utama</a>
    </div>
  </div>
</div>



