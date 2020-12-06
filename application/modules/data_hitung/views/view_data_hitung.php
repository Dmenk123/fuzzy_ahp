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
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" id="form_rekam_medik">
      <!-- form data pasien -->
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Data Perhitungan Per Kategori
            </h3>
          </div>
        </div>

        <div class="kt-portlet__body" id="menu_area">
          <div class="col-lg-12 row">
            <?php foreach ($data_kat as $key => $value) { ?>
              <div class="col-lg-6 div_menu" style="cursor:pointer" 
              onclick="javascript:window.location.href='<?=base_url('hitung_kategori/formulir_hitung/'.$value->id.'?kriteria=C1');?>'">
                <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                  <div class="kt-portlet__body">
                    <div class="kt-iconbox__body">
                      <div class="kt-iconbox__icon">
                        <img src="<?= base_url('assets/svg_icons/tag.svg');?>" width="40px" height="40px"> 
                      </div>
                      <div class="kt-iconbox__desc">
                        <h5 class="kt-iconbox__title">
                          <?= $value->nama; ?>
                        </h5>
                        <div class="kt-iconbox__content">
                          <?= $value->nama; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            
          </div>
        </div>
        
      </div>  
    </form>
    <!--end::Form-->
  </div>
</div>



