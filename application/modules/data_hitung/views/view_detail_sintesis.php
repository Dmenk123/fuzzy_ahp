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
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/download_excel_sintesis/'.$this->uri->segment(3);?>">
                    <i class="la la-arrow-circle-o-down"></i> Excel Sintesis
                  </a>
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/download_excel_hitung_vektor/'.$this->uri->segment(3);?>">
                    <i class="la la-arrow-circle-o-down"></i> Excel Hitung Vektor
                  </a>
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/cetak_data_sintesis/'.$this->uri->segment(3);?>">
                    <i class="la la-print"></i> Cetak Sintesis
                  </a>
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/cetak_data_hitung_vektor/'.$this->uri->segment(3);?>">
                    <i class="la la-print"></i> Cetak Hitung Vektor
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="kt-portlet__body" id="sintesis_area">
        <h4>Tabel Sintesis</h4>
        <div class="col-lg-12 row table-responsive"> 
          <table class="table table-bordered table-hover">
            <thead>
              <tr align="center">
                <th valign="top"></th>
                <th>l</th>
                <th>m</th>
                <th>u</th>
              </tr>
            </thead>
            <tbody>
              <?php $idx = 0; ?>
              <?php foreach ($data_sintesis as $kk => $vv) {
                echo '<tr align="center">';
                echo '<td>'.$vv->kode_kategori.'</td>';
                echo '<td>'.number_format($vv->sintesis_lower, 4).'</td>';
                echo '<td>'.number_format($vv->sintesis_medium, 4).'</td>';
                echo '<td>'.number_format($vv->sintesis_upper, 4).'</td>';
                echo '</tr>';
              } ?>
            </tbody>
          </table>    
        </div>
      </div>
      
      <div class="kt-portlet__body" id="sintesis_area">
        <h4>Perhitungan Vektor</h4>
        <div class="col-lg-12 row table-responsive"> 
          <table class="table table-bordered table-hover">
            <thead>
              <tr align="center">
                <th colspan="5"></th>
                <th>Bawah</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $idx = 0; ?>
              <?php 
                // $flag_kode_kat = $data[0]->kode_kategori_proses;
                $flag_kode_kat = 'XX'; 
              ?>
              <?php foreach ($data as $kk => $vv) {
                echo '<tr align="center">';
                
                if($vv->kode_kategori_proses != $flag_kode_kat) {
                  echo '<td>'.$vv->kode_kategori_proses.'</td>';
                  $flag_kode_kat = $vv->kode_kategori_proses;
                }else{
                  echo '<td></td>';
                }
                
                echo '<td>'.$vv->kode_kategori.'</td>';
                echo '<td>'.number_format((float)$vv->nilai_l, 4).'</td>';
                echo '<td>'.number_format((float)$vv->nilai_m, 4).'</td>';
                echo '<td>'.number_format((float)$vv->nilai_u, 4).'</td>';
                echo '<td>'.number_format((float)$vv->bawah, 4).'</td>';
                echo '<td>'.number_format((float)$vv->total, 4).'</td>';
                echo '<td><strong>'.number_format((float)$vv->hasil, 4).'</strong></td>';
                echo '</tr>';
              } ?>
            </tbody>
          </table>    
        </div>
      </div> 

    </div>  

    <div class="col-12">
      <a href="<?=base_url('data_hitung');?>" class="btn btn-bold btn-label-brand btn-sm"><i class="la la-arrow-left"></i>Kembali Ke Menu Utama</a>
    </div>
  </div>
</div>



