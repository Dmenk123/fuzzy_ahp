<?php
$obj_date = new DateTime();
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
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="form_rekam_medik">
      <!-- form data pasien -->
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Silahkan Pilih Data Perhitungan yang akan di lihat.
            </h3>
          </div>
        </div>

        <div class="kt-portlet__body" id="menu_area">
          <div class="col-lg-12 row">
            
            <div class="col-lg-6 div_menu" style="cursor:pointer" 
            onclick="javascript:window.location.href='<?=base_url('data_hitung/list_detail_data/').$this->enkripsi->enc_dec('encrypt', 'ahp');?>'">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/tag.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Pehitungan AHP
                      </h5>
                      <div class="kt-iconbox__content">
                        Perhitungan AHP
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 div_menu" style="cursor:pointer" 
            onclick="javascript:window.location.href='<?=base_url('data_hitung/list_detail_data/').$this->enkripsi->enc_dec('encrypt', 'sintesis');?>'">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/tag.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Pehitungan Sintesis & Vektor
                      </h5>
                      <div class="kt-iconbox__content">
                        Perhitungan Sintesis & Vektor
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 div_menu" style="cursor:pointer" 
            onclick="javascript:window.location.href='<?=base_url('data_hitung/list_detail_data/').$this->enkripsi->enc_dec('encrypt', 'vektor');?>'">
              <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <img src="<?= base_url('assets/svg_icons/tag.svg');?>" width="40px" height="40px"> 
                    </div>
                    <div class="kt-iconbox__desc">
                      <h5 class="kt-iconbox__title">
                        Pehitungan Vektor & Normalisasi
                      </h5>
                      <div class="kt-iconbox__content">
                        Pehitungan Vektor & Normalisasi
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        
      </div>  
    </form>
    <!--end::Form-->
  </div>
</div>



