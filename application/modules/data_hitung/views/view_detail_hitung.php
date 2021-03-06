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
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/download_excel_ahp/'.$this->uri->segment(3);?>">
                    <i class="la la-arrow-circle-o-down"></i> Download Excel AHP
                  </a>
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/download_excel_sintesis/'.$this->uri->segment(3);?>">
                    <i class="la la-arrow-circle-o-down"></i> Download Excel Sintesis
                  </a>
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/cetak_data_ahp/'.$this->uri->segment(3);?>">
                    <i class="la la-print"></i> Cetak AHP
                  </a>
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/cetak_data_sintesis/'.$this->uri->segment(3);?>">
                    <i class="la la-print"></i> Cetak Sintesis
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="kt-portlet__body" id="menu_area">
        <h4>Tabel AHP</h4>
        <div class="col-lg-12 row table-responsive"> 
          <table class="table table-bordered table-hover">
            <thead>
              <tr align="center">
                <th rowspan="2" valign="top"></th>
                <?php foreach ($kategori as $k => $v) { ?>
                  <th colspan="3" valign="middle">
                    <div class="col-12"><?= $v->nama; ?></div>
                    <div class="col-12"><?= $v->kode_kategori; ?></div>
                  </th>
                  <?php } ?>
                  <th colspan="3" valign="top">Total</th>
              </tr>
              <tr align="center">
              <?php for ($i=0; $i <= count($kategori); $i++) { ?>
                <th>l</th>
                <th>m</th>
                <th>u</th>
              <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php 
                $idx = 0;
                $counter_kolom = 0;
              ?>
              <?php foreach ($kategori as $kk => $vv) {
                echo '<tr>';
                ## counter untuk colspan
                $counter_kolom = 0; 
                foreach ($data_himpunan_hitung as $key => $val) {
                  if($val->kode_kategori == $vv->kode_kategori) {
                    if($idx == 0){
                      echo '<th>'.$val->kode_kategori.'</th>';
                    }

                    if(number_format((float)$val->lower_val, 4) == '1.0000' && number_format((float)$val->medium_val, 4) == '1.0000' && number_format((float)$val->upper_val, 4) == '1.0000'){
                      echo '<td style="color:red;">'.number_format((float)$val->lower_val, 4).'</td>';
                      echo '<td style="color:red;">'.number_format((float)$val->medium_val, 4).'</td>';
                      echo '<td style="color:red;">'.number_format((float)$val->upper_val, 4).'</td>';
                    }else{
                      echo '<td>'.number_format((float)$val->lower_val, 4).'</td>';
                      echo '<td>'.number_format((float)$val->medium_val, 4).'</td>';
                      echo '<td>'.number_format((float)$val->upper_val, 4).'</td>';
                    }
                    
                    ## increment biar ga kenek kondisi
                    $idx++;
                    $counter_kolom++;
                    continue;
                  }
                  ## reset
                  $idx = 0;
                }

                echo '<td>'.number_format((float)$data_tot_himpunan[$kk]->total_lower, 4).'</td>';
                echo '<td>'.number_format((float)$data_tot_himpunan[$kk]->total_medium, 4).'</td>';
                echo '<td>'.number_format((float)$data_tot_himpunan[$kk]->total_upper, 4).'</td>';
                echo '</tr>';
              } ?>
              
              <tr align="center">
                <td colspan="<?=((int)$counter_kolom*3) + 1;?>">Grand Total</td>
                <td><?= number_format((float)$data_hitung->total_lower, 4); ?></td>
                <td><?= number_format((float)$data_hitung->total_medium, 4); ?></td>
                <td><?= number_format((float)$data_hitung->total_upper, 4); ?></td>
              </tr>
            </tbody>
          </table>    
        </div>
      </div>

      <div class="kt-portlet__body" id="sintesis_area">
        <h4>Tabel Sintesis</h4> <span> <a href="<?=base_url('data_hitung/detail_sintesis/').$this->uri->segment(3); ?>" target="_blank">Lihat Proses Perhitungan Sintesis</a></span>
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
              <?php foreach ($arr_data_sintesis as $kk => $vv) {
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
    </div>  

    <div class="col-12">
      <a href="<?=base_url('data_hitung');?>" class="btn btn-bold btn-label-brand btn-sm"><i class="la la-arrow-left"></i>Kembali Ke Menu Utama</a>
    </div>
  </div>
</div>



