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
			url  : base_url + "master_kategori/list_data",
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
  
    
    $(".modal").on("hidden.bs.modal", function(){
        reset_modal_form();
    });
});

function add_menu()
{
    reset_modal_form();
    save_method = 'add';
	$('#modal_kategori_form').modal('show');
	$('#modal_title').text('Tambah Kategori Baru'); 
}

function edit_data(id)
{
    reset_modal_form();
    save_method = 'update';
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + 'master_kategori/edit_data',
        type: "POST",
        dataType: "JSON",
        data : {id:id},
        success: function(data)
        {
            $('[name="id_kat"]').val(data.old_data.id);
            $('[name="nama_kat"]').val(data.old_data.nama);
            $('[name="kode"]').val(data.old_data.kode_kategori);
            $('[name="urut"]').val(data.old_data.urut);
            $('#modal_kategori_form').modal('show');
	        $('#modal_title').text('Edit Kategori'); 
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
        url = base_url + 'master_kategori/add_data_kategori';
        txtAksi = 'Tambah Kategori';
    }else{
        url = base_url + 'master_kategori/update_data_kategori';
        txtAksi = 'Edit Kategori';
    }
    
    var form = $('#form-kategori')[0];
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
                url : base_url + 'master_kategori/delete_data',
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
    $('#form-kategori')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
}