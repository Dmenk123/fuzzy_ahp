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
                echo '<td>'.$vv->kode_kriteria.'</td>';
                echo '<td>'.round((float)$data_tot_himpunan[$kk]->total_lower / (float)$data_hitung->total_upper, 4).'</td>';
                echo '<td>'.round((float)$data_tot_himpunan[$kk]->total_medium / (float)$data_hitung->total_medium, 4).'</td>';
                echo '<td>'.round((float)$data_tot_himpunan[$kk]->total_upper / (float)$data_hitung->total_lower, 4).'</td>';
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
                <th colspan="4"></th>
                <th>Bawah</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php $idx = 0; ?>
              <?php foreach ($kriteria as $kk => $vv) {
                echo '<tr align="center">';
                echo '<td>'.$vv->kode_kriteria.'</td>';
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



