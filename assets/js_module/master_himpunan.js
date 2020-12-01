var save_method;
var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

	//datatables
	table = $('#tabel_data').DataTable({
		responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
		ajax: {
			url  : base_url + "master_himpunan/list_data",
			type : "POST" 
		},

		//set column definition initialisation properties
		columnDefs: [
			{
				targets: [-1], //last column
				orderable: false, //set not orderable
			},
		],
    });
  
    //change menu status
    $(document).on('click', '.btn_edit_status', function(){
        var id = $(this).attr('id');
        var status = $(this).val();
        swalConfirm.fire({
            title: 'Ubah Status Data User ?',
            text: "Apakah Anda Yakin ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Ubah Status!',
            cancelButtonText: 'Tidak, Batalkan!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : base_url + 'master_user/edit_status_user/'+ id,
                    type: "POST",
                    dataType: "JSON",
                    data : {status : status},
                    success: function(data)
                    {
                        swalConfirm.fire('Berhasil Ubah Status User!', data.pesan, 'success');
                        table.ajax.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        Swal.fire('Terjadi Kesalahan');
                    }
                });
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalConfirm.fire(
                'Dibatalkan',
                'Aksi Dibatalakan',
                'error'
              )
            }
        });
    });

    $(".modal").on("hidden.bs.modal", function(){
        reset_modal_form();
    });
});

function hitung()
{
    let lower_txt = $('#lower_txt_himp').val();
    let medium_txt = $('#medium_txt_himp').val();
    let upper_txt = $('#upper_txt_himp').val();   
    $.ajax({
        type: "post",
        url: base_url+'master_himpunan/hitung_pecahan',
        data: {lower:lower_txt, medium:medium_txt, upper:upper_txt},
        dataType: "json",
        success: function (response) {
            $('#lower_val_himp').val(response.lower);
            $('#medium_val_himp').val(response.medium);
            $('#upper_val_himp').val(response.upper);   
        }
    });
}

function add_menu()
{
    reset_modal_form();
    save_method = 'add';
	$('#modal_himpunan_form').modal('show');
	$('#modal_title').text('Tambah Himpunan Baru'); 
}

function edit_data(id)
{
    reset_modal_form();
    save_method = 'update';
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + 'master_himpunan/edit_data',
        type: "POST",
        dataType: "JSON",
        data : {id:id},
        success: function(data)
        {
            $('[name="id_himp"]').val(data.old_data.id);
            $('[name="nama_himp"]').val(data.old_data.nama);
            $('[name="lower_txt_himp"]').val(data.old_data.lower_txt);
            $('[name="medium_txt_himp"]').val(data.old_data.medium_txt);
            $('[name="upper_txt_himp"]').val(data.old_data.upper_txt);

            $('[name="lower_val_himp"]').val(data.old_data.lower_val);
            $('[name="medium_val_himp"]').val(data.old_data.medium_val);
            $('[name="upper_val_himp"]').val(data.old_data.upper_val);

            $('#modal_himpunan_form').modal('show');
	        $('#modal_title').text('Edit Himpunan'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    var url;
    var txtAksi;

    if(save_method == 'add') {
        url = base_url + 'master_himpunan/add_data_himpunan';
        txtAksi = 'Tambah Himpunan';
    }else{
        url = base_url + 'master_himpunan/update_data_himpunan';
        txtAksi = 'Edit Himpunan';
    }
    
    var form = $('#form-himpunan')[0];
    var data = new FormData(form);
    
    $("#btnSave").prop("disabled", true);
    $('#btnSave').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: url,
        data: data,
        dataType: "JSON",
        processData: false, // false, it prevent jQuery form transforming the data into a query string
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swal.fire("Sukses!!", "Aksi "+txtAksi+" Berhasil", "success");
                $("#btnSave").prop("disabled", false);
                $('#btnSave').text('Simpan');
                
                reset_modal_form();
                $(".modal").modal('hide');
                
                reload_table();
            }else {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.inputerror[i] != 'pegawai') {
                        $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                    }else{
                        //ikut style global
                        $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback-select');
                    }
                }

                $("#btnSave").prop("disabled", false);
                $('#btnSave').text('Simpan');
            }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSave").prop("disabled", false);
            $('#btnSave').text('Simpan');

            reset_modal_form();
            $(".modal").modal('hide');
        }
    });
}

function delete_data(id){
    swalConfirmDelete.fire({
        title: 'Hapus Data ?',
        text: "Data Akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'master_himpunan/delete_data',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    table.ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire('Terjadi Kesalahan');
                }
            });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalConfirm.fire(
            'Dibatalkan',
            'Aksi Dibatalakan',
            'error'
          )
        }
    });
}

function reset_modal_form()
{
    $('#form-himpunan')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
}