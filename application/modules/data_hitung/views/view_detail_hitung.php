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
      </div>

      <div class="kt-portlet__body" id="menu_area">
        <h4>Tabel AHP</h4>
        <div class="col-lg-12 row table-responsive"> 
          <table class="table table-bordered table-hover">
            <thead>
              <tr align="center">
                <th rowspan="2" valign="top"></th>
                <?php foreach ($kriteria as $k => $v) { ?>
                  <th colspan="3" valign="middle">
                    <div class="col-12"><?= $v->nama; ?></div>
                    <div class="col-12"><?= $v->kode_kriteria; ?></div>
                  </th>
                  <?php } ?>
                  <th colspan="3" valign="top">Total</th>
              </tr>
              <tr align="center">
              <?php for ($i=0; $i <= count($kriteria); $i++) { ?>
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
              <?php foreach ($kriteria as $kk => $vv) {
                echo '<tr>';
                ## counter untuk colspan
                $counter_kolom = 0; 
                foreach ($data_himpunan_hitung as $key => $val) {
                  if($val->kode_kriteria == $vv->kode_kriteria) {
                    if($idx == 0){
                      echo '<th>'.$val->kode_kriteria.'</th>';
                    }

                    if($val->lower_val == '1.0000' && $val->medium_val == '1.0000' && $val->upper_val == '1.0000'){
                      echo '<td style="color:red;">'.$val->lower_val.'</td>';
                      echo '<td style="color:red;">'.$val->medium_val.'</td>';
                      echo '<td style="color:red;">'.$val->upper_val.'</td>';
                    }else{
                      echo '<td>'.$val->lower_val.'</td>';
                      echo '<td>'.$val->medium_val.'</td>';
                      echo '<td>'.$val->upper_val.'</td>';
                    }
                    
                    ## increment biar ga kenek kondisi
                    $idx++;
                    $counter_kolom++;
                    continue;
                  }
                  ## reset
                  $idx = 0;
                }

                echo '<td>'.$data_tot_himpunan[$kk]->total_lower.'</td>';
                echo '<td>'.$data_tot_himpunan[$kk]->total_medium.'</td>';
                echo '<td>'.$data_tot_himpunan[$kk]->total_upper.'</td>';
                echo '</tr>';
              } ?>
              
              <tr align="center">
                <td colspan="<?=((int)$counter_kolom*3) + 1;?>">Grand Total</td>
                <td><?= (float)$data_hitung->total_lower; ?></td>
                <td><?= (float)$data_hitung->total_medium; ?></td>
                <td><?= (float)$data_hitung->total_upper; ?></td>
              </tr>
            </tbody>
          </table>    
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
              <?php foreach ($kriteria as $kk => $vv) {
                echo '<tr align="center">';
                echo '<td>'.$val->kode_kriteria.'</td>';
                echo '<td>'.round((float)$data_tot_himpunan[$kk]->total_lower / (float)$data_hitung->total_upper, 4).'</td>';
                echo '<td>'.round((float)$data_tot_himpunan[$kk]->total_medium / (float)$data_hitung->total_medium, 4).'</td>';
                echo '<td>'.round((float)$data_tot_himpunan[$kk]->total_upper / (float)$data_hitung->total_lower, 4).'</td>';
                echo '</tr>';
              } ?>
            </tbody>
          </table>    
        </div>
      </div>
      
    </div>  
  </div>
</div>



