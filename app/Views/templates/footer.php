<footer class="main-footer">
  <div class="footer-left">
    Copyright &copy; 2024 <div class="bullet"></div> Created By <a href="#">Haikal Jibran Al-Ghiffarry</a>
  </div>
  <div class="footer-right">

  </div>
</footer>


<!-- General JS Scripts -->
<script src="<?= base_url(); ?>/node_modules/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>/node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url(); ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
<script src="<?= base_url(); ?>/node_modules/moment/min/moment.min.js"></script>

<script src="<?= base_url(); ?>/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url(); ?>/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url(); ?>/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<!-- Template JS File -->
<script src="<?= base_url(); ?>/assets/js/stisla.js"></script>
<script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
<script src="<?= base_url(); ?>/assets/js/custom.js"></script>
<script src="<?= base_url(); ?>/assets/js/page/bootstrap-modal.js"></script>
<script src="<?= base_url(); ?>/assets/js/page/components-table.js"></script>
<script src="<?= base_url(); ?>/assets/js/page/index.js"></script>

<!-- JS Libraies -->
<script src="<?= base_url(); ?>/node_modules/prismjs/prism.js"></script>
<script src="<?= base_url(); ?>/node_modules/jquery-ui-dist/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>/autonumeric/autonumeric.min.js"></script>
<script src="<?= base_url(); ?>/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url(); ?>/node_modules/chart.js/dist/Chart.min.js"></script>


<!--SweetAlert JS-->
<script src="<?= base_url(); ?>/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- Tambahkan script SweetAlert2 di bagian bawah halaman -->
<script>
  <?php if (session()->getFlashdata('pesan')) : ?>
    Swal.fire({
      title: 'Sukses!',
      text: '<?= session()->getFlashdata('pesan') ?>',
      icon: 'success',
      confirmButtonText: 'OK'
    });
  <?php endif; ?>
</script>

<!-- Data Tables -->
<script src="<?= base_url(); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script>
  $(function() {
    $("#sortable-table").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
    });
  });
</script>

<script>
  /**
   * Number.prototype.format(n, x, s, c)
   *
   * @param integer n: length of decimal
   * @param integer x: length of whole part
   * @param mixed   s: sections delimiter
   * @param mixed   c: decimal delimiter
   */
  Number.prototype.format = function(n, s = '.', c = ',') {
    var x = 3;
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
      num = this.toFixed(Math.max(0, ~~n));

    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
  }

  function autoNumericInit() {
    $('input.currency').autoNumeric('init', {
      aSep: '.',
      aDec: ','
    })

    $('form').on('submit', (e) => {
      $('input.currency').each(function(i) {
        var self = $(this);
        try {
          var v = self.autoNumeric('get');
          self.autoNumeric('destroy');
          self.val(v);
        } catch (err) {
          console.log("Not an autonumeric field: " + self.attr("name"));
        }
      });
      return true;
    });
  }

  autoNumericInit()
</script>

<script>
  const tableForm = $('#form-add-row-table');
  var row = 0;

  function addRow(row) {
    tableForm.find('tbody').append(`<tr>
      <td><input type="text" name="products[${row}]['name']" id="nameInput${row}"
              class="form-control" required></td>
      <td><input type="number" name="products[${row}]['qty']" min="1" value="1" id="qtyInput${row}"
              class="form-control qty-input" required></td>
      <td><input type="text" name="products[${row}]['price']" id="priceInput${row}"
              class="form-control currency text-right price-input" required></td>
      <td class="text-right"><input type="hidden" name="products[${row}]['total']" id="totalInput${row}"
              class="form-control text-right total-input"><span class="total-span">0,00</span></td>
      <td><a href="#" class="btn btn-danger btn-row-delete">Delete</a></td>
  </tr>`)

    autoNumericInit()
  }

  addRow(0)

  function calculateTotal() {
    var total = 0;

    tableForm.find('tbody tr').each(function(i, element) {
      var price = parseFloat($(element).find('.price-input').autoNumeric('get'))

      if (isNaN(price)) price = 0

      var qty = parseInt($(element).find('.qty-input').val())
      var totalPrice = parseFloat((price * qty).toFixed(2))

      $(element).find('.total-span').text(totalPrice.format(2))
      $(element).find('.total-input').val(totalPrice)

      total += totalPrice
    })

    $('#totalPrices').text(total.format(2))
  }

  $('.btn-row-add').click(function(e) {
    e.preventDefault()

    row += 1;

    addRow(row)
  })

  $(document).on('click', '.btn-row-delete', function(e) {
    e.preventDefault()

    $(this).closest('tr').remove()

    calculateTotal()

    if (tableForm.find('tbody tr').length == 0) addRow(0)
  })

  $(document).on('change keyup', '.price-input, .qty-input', function() {
    calculateTotal()
  })
</script>

<script>

</script>