<html>

<head>
  <title><?php echo $title; ?></title>
  <style type="text/css">
    #outtable {
      padding: 10px;
      border: 1px solid #e3e3e3;
      width: 600px;
      border-radius: 5px;
    }

    .short {
      width: 50px;
    }

    .normal {
      width: 150px;
    }

    .tbl-outer {
      color: #070707;
    }

    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    .tebal {
      font-weight: bold;
    }

    .outer-left {
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }

    .head-left {
      padding-bottom: 0px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }

    .tbl-footer {
      width: 100%;
      color: #070707;
      border-top: 0px solid white;
      border-color: white;
      padding-top: 15px;
    }

    .head-right {
      padding-bottom: 0px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
    }

    .tbl-header {
      padding-top: 1px;
      width: 100%;
      color: #070707;
      border-color: #070707;
      border-top: 2px solid #070707;
    }

    #tbl_content {
      padding-top: 10px;
      margin-left: -15px;
    }

    .tbl-footer td {
      border-top: 0px;
      padding: 0px;
    }

    .tbl-footer tr {
      background: white;
    }

    .foot-center {
      padding-left: 70px;
    }

    .inner-head-left {
      padding-top: 20px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }

    .tbl-content-footer {
      width: 100%;
      color: #070707;
      padding-top: 0px;
    }

    table {
      border-collapse: collapse;
      font-family: arial;
      color: black;
      font-size: 12px;
    }

    thead th {
      text-align: center;
      font-style: bold;
    }

    .clear {
      clear: both;
    }

  </style>
</head>

<body>
  <div class="container">
    <table class="tbl-outer">
      <tr>
        
        <!-- <td align="left" class="outer-left">
          <img src="<?=base_url('files/img/app_img/').$data_klinik->gambar;?>" height="75" width="75">
        </td> -->

        <!-- <td align="right" class="outer-left" style="padding-top: 30px; padding-left:10px;">
          <p style="text-align: left; font-size: 14px" class="outer-left">
            <strong><?= $data_klinik->nama_klinik; ?></strong>
          </p>
          <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->alamat.' '.$data_klinik->kelurahan.' '.$data_klinik->kecamatan; ?></p>
          <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->kota.', '.$data_klinik->provinsi.' '.$data_klinik->kode_pos; ?></p>
        </td> -->
        
      </tr>
    </table>

    <table class="tbl-header">
      <tr>
        <td align="center" class="head-center">
          <p style="text-align: center; font-size: 16px; padding-top:10px;" class="head-left"><strong> <?= $title; ?> </strong></p>
        </td>
      </tr>
    </table>
    
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr align="center">
          <th valign="top"></th>
          <?php foreach ($data_kat as $k => $v) {
            echo "<th>";
            echo "<div class='col-12'>$v->nama</div>";
            echo "<div class='col-12'>$v->kode_kategori</div>";
            echo "</th>";
          } ?>
        </tr>
      </thead>
      <tbody>
      <?php 
        $idx = 0; 
        $counter_kolom = 0;
        $total_min = 0;
      ?>
      
      <?php foreach ($data_kat as $kk => $vv) {
        echo '<tr style="text-align:center;">';
        ## counter untuk colspan
        $counter_kolom = 0; 
        foreach ($data as $key => $val) {
          if($val->kode_kategori == $vv->kode_kategori) {
            if($idx == 0){
              echo '<th>'.$val->kode_kategori.'</th>';
            }

            if($val->kode_kategori_tujuan == $vv->kode_kategori){
              echo '<td style="color:red;">'.number_format((float)$val->nilai, 4).'</td>';
            }else{
              echo '<td>'.number_format((float)$val->nilai, 4).'</td>';
            }

            if($val->kode_kategori_tujuan == 'C1') {
              $total_min += number_format((float)$val->nilai, 4);
            }
            
            ## increment biar ga kenek kondisi
            $idx++;
            $counter_kolom++;
            continue;
          }
          ## reset
          $idx = 0;
        }

        echo '</tr>';

      } ?>
    </tbody>
    </table>
  </div>
</body>

</html>