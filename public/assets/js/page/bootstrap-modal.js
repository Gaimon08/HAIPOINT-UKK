"use strict";

$("#modal-1").fireModal({body: 'Modal body text goes here.'});
// $("#modal-2").fireModal({body: 'Modal body text goes here.', center: true});

"use strict";

$("#modal-2").fireModal({
    body: '<form class="mt-4" action="<?= site_url("barang-save"); ?>" method="POST">' +
            '<div class="form-group">' +
                '<label>Barcode</label>' +
                '<input type="hidden" class="form-control" id="inputId" name="id_barang">' +
                '<input type="text" class="form-control" id="inputBarcode" name="barcode" required placeholder="Masukan Barcode">' +
            '</div>' +
            '<div class="form-row">' +
                '<div class="form-group col-md-6">' +
                    '<label>Nama Barang</label>' +
                    '<input type="text" class="form-control" id="inputNamaBarang" name="nama_barang" required placeholder="Masukan Nama Barang">' +
                '</div>' +
                '<div class="form-group col-md-6">' +
                    '<label>Jenis Barang</label>' +
                    '<select class="form-control" id="inputJenis" name="jenis_barang">' +
                        '<option value="">Pilih Jenis Barang</option>' +
                        '<?php if (isset($listJenis)) { $no = null; foreach ($listJenis as $baris) { $no++; echo "<option value=\"" . $baris["id_jenisBarang"] . "\">" . $baris["nama_jenis"] . "</option>"; } } ?>' +
                    '</select>' +
                '</div>' +
            '</div>' +
            '<div class="form-row">' +
                '<div class="form-group col-md-6">' +
                    '<label>Stok</label>' +
                    '<input type="number" class="form-control" id="inputStok" name="stok" required placeholder="Masukan Jumlah Stok">' +
                '</div>' +
                '<div class="form-group col-md-6">' +
                    '<label>Satuan Barang</label>' +
                    '<select class="form-control" id="inputJenis" name="satuan">' +
                        '<option value="">Pilih Satuan Barang</option>' +
                        '<?php if (isset($listSatuan)) { $no = null; foreach ($listSatuan as $baris) { $no++; echo "<option value=\"" . $baris["id_satuan"] . "\">" . $baris["nama_satuan"] . "</option>"; } } ?>' +
                    '</select>' +
                '</div>' +
            '</div>' +
            '<div class="form-row">' +
                '<div class="form-group col-md-6">' +
                    '<label>Harga Beli</label>' +
                    '<div class="input-group">' +
                        '<div class="input-group-prepend">' +
                            '<div class="input-group-text">' +
                                'Rp.' +
                            '</div>' +
                        '</div>' +
                        '<input type="text" class="form-control currency" id="inputhargaBeli" name="harga_beli" required placeholder="Masukan Harga Beli Barang">' +
                    '</div>' +
                '</div>' +
                '<div class="form-group col-md-6">' +
                    '<label>Harga Jual</label>' +
                    '<div class="input-group">' +
                        '<div class="input-group-prepend">' +
                            '<div class="input-group-text">' +
                                'Rp.' +
                            '</div>' +
                        '</div>' +
                        '<input type="text" class="form-control currency" id="inputhargaJual" name="harga_jual" required placeholder="Masukan Harga Jual Barang">' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="form-group text-center">' +
                '<button class="btn btn-primary">Submit</button>' +
            '</div>' +
        '</form>',
    center: true
});


let modal_3_body = '<p>Object to create a button on the modal.</p><pre class="language-javascript"><code>';
modal_3_body += '[\n';
modal_3_body += ' {\n';
modal_3_body += "   text: 'Login',\n";
modal_3_body += "   submit: true,\n";
modal_3_body += "   class: 'btn btn-primary btn-shadow',\n";
modal_3_body += "   handler: function(modal) {\n";
modal_3_body += "     alert('Hello, you clicked me!');\n"
modal_3_body += "   }\n"
modal_3_body += ' }\n';
modal_3_body += ']';
modal_3_body += '</code></pre>';
$("#modal-3").fireModal({
  title: 'Modal with Buttons',
  body: modal_3_body,
  buttons: [
    {
      text: 'Click, me!',
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
        alert('Hello, you clicked me!');
      }
    }
  ]
});

$("#modal-4").fireModal({
  footerClass: 'bg-whitesmoke',
  body: 'Add the <code>bg-whitesmoke</code> class to the <code>footerClass</code> option.',
  buttons: [
    {
      text: 'No Action!',
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});

$("#modal-5").fireModal({
  title: 'Login',
  body: $("#modal-login-part"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let fake_ajax = setTimeout(function() {
      form.stopProgress();
      modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
  buttons: [
    {
      text: 'Login',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});

$("#modal-6").fireModal({
  body: '<p>Now you can see something on the left side of the footer.</p>',
  created: function(modal) {
    modal.find('.modal-footer').prepend('<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>');
  },
  buttons: [
    {
      text: 'No Action',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});

$('.oh-my-modal').fireModal({
  title: 'My Modal',
  body: 'This is cool plugin!'
});