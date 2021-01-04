<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    
    <div class="kt-portlet__body kt-portlet__body--fit">
      <!-- begin:: Content Head -->
      <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
        <div class="kt-grid__item kt-wizard-v2__aside">    
          <!--begin: Form Wizard Nav -->
          <div class="kt-wizard-v2__nav">

            <!--doc: Remove "kt-wizard-v2__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
            <div class="kt-wizard-v2__nav-items kt-wizard-v2__nav-items--clickable">
              <h4>Daftar Project</h4>
              <?php 
              // foreach ($kategori as $key => $value) {
              for ($i=(int)$anggaran->tahun_proyek; $i <= (int)$anggaran->tahun_akhir_proyek; $i++) { ?>
                <div class="kt-wizard-v2__nav-item step_kategori" data-ktwizard-type="step" <?php if($_GET['tahun'] == $i) { echo 'data-ktwizard-state="current"'; }?> data-idhitung = "<?= $this->uri->segment(3); ?>">
                  <div class="kt-wizard-v2__nav-body">
                    <div class="kt-wizard-v2__nav-icon">
                      <i class="flaticon-clipboard"></i>
                    </div>
                    <div class="kt-wizard-v2__nav-label">
                      <div class="kt-wizard-v2__nav-label-title">
                        <?= $anggaran->nama_proyek.' - '.$i; ?>
                      </div>
                      <div class="kt-wizard-v2__nav-label-desc">
                        <?= 'Tahun : '.$i; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>              
            </div>
          </div>

          <!--end: Form Wizard Nav -->
        </div>
        
        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">

          <!--begin: Form Wizard Form-->
          <form class="kt-form" id="form_hitung_kategori">
            <input type="hidden" class="form-control" id="id_kategori" name="id_kategori" value="<?= $kat->id; ?>">
            <input type="hidden" class="form-control" id="id_hitung" name="id_hitung" value="<?= $this->enkripsi->enc_dec('decrypt',$this->uri->segment(3)); ?>">
            <!--begin: Form Wizard Step 1-->
            <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
              <?php 
              foreach ($kategori as $key => $value) {
                if($value->id == $this->input->get('kategori')){
                  echo '<div class="kt-heading kt-heading--md">'.$title.'</div>';
                  echo '<div class="kt-heading kt-heading--sm"> Kategori : '.$value->nama.' ('.$value->kode_kategori.')</div>';
                  echo '<div class="kt-heading kt-heading--sm">Penentuan Perbandingan kategori '.$value->nama.' Terhadap kategori-kategori lainnya dibawah ini.</div>';
                  break;
                }
              }
              ?>

              <div class="kt-form__section kt-form__section--first">
                <div class="kt-wizard-v2__form">
                  
                  
                    <div class="row">
                      <div class="col-xl-12">
                        <div class="form-group">
                          <?php foreach ($kategori as $k => $v) { ?>
                            <!-- <label><?= $row['nama'].' ('.$row['kode'].')'; ?>:</label> -->
                            <div class="form-group">
                              <label><?=$v->nama;?></label>
                              <input type="text" class="form-control form-control-sm" aria-describedby="" placeholder="">
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>  
                  
                </div>
              </div>

            </div>
            <!--end: Form Wizard Step 1-->

            <!--begin: Form Actions -->
            <!-- <div class="kt-form__actions">
              <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                Sebelumnya
              </button>
              <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                Selesai
              </button>
              <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                Selanjutnya
              </button>
            </div> -->

            <?php 
              $arr_key = count($step);
              $last_index_kategori = $arr_key;
            ?>

            <div class="kt-form__actions">
              <?php if ($kat->kode_kategori != 'C1') { ?>
              <button type="button" class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" id="btn_prev">
                Sebelumnya
              </button>
              <?php } ?>

              <?php if ($this->enkripsi->enc_dec('decrypt', $this->input->get('kategori')) == $last_index_kategori) { ?>
              <button type="button" class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" id="btn_finish">
                Selesai
              </button>
              <?php }else{ ?>
              <button type="button" class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" id="btn_next">
                Selanjutnya
              </button>
              <?php } ?>
            </div>

            <!--end: Form Actions -->
          </form>

          <!--end: Form Wizard Form-->
        </div>
      </div>
      
    </div>
  </div>
</div>