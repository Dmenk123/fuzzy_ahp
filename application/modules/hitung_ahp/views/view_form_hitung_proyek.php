<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    
    <div class="kt-portlet__body kt-portlet__body--fit">
      <!-- begin:: Content Head -->
      <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">

          <!--begin: Form Wizard Form-->
          <form class="kt-form" id="form_hitung_proyek">
            <!--begin: Form Wizard Step 1-->
            <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
            <div class="kt-heading kt-heading--md"><?= $title; ?></div>
              <div class="kt-form__section kt-form__section--first">
                <div class="kt-wizard-v2__form">
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="form-group">
                          <label>Silahkan Pilih Proyek :</label>
                          <select name="proyek" class="form-control select2">
                            <option value="">Silahkan Pilih Salah Satu</option>
                            <?php foreach ($data_proyek as $k => $v) { ?>
                              <option value="<?=$v->id?>">
                                <?= $v->nama_proyek; ?> [Tahun : <?= $v->tahun_proyek; ?>]
                              </option>;
                            <?php } ?>
                          </select>
                          <span class="help-block"></span>
                        </div>
                    </div>
                  </div>  
                </div>
              </div>

            </div>
            <!--end: Form Wizard Step 1-->

            <div class="kt-form__actions">
              <a href="<?= base_url('hitung_ahp');?>" class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">
                Kembali
              </a>
              
              <button type="button" class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" id="btn_next_proyek">
                Selanjutnya
              </button>
            </div>

            <!--end: Form Actions -->
          </form>

          <!--end: Form Wizard Form-->
        </div>
      </div>
      
    </div>
  </div>
</div>