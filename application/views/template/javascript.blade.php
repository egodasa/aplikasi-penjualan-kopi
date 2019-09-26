    <script src="<?=base_url()?>assets/js/jquery-1.11.0.min.js"></script>
    
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.cookie.js"></script>
    <script src="<?=base_url()?>assets/js/modernizr.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-hover-dropdown.js"></script>
    <script src="<?=base_url()?>assets/js/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>assets/js/front.js"></script>
    <script src="<?=base_url()?>assets/js/axios.min.js"></script>
    <script src="<?=base_url()?>assets/js/autonumeric.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
      var pengaturan_rupiah = {
        currencySymbol: "Rp",
        decimalCharacter: ',',
        digitGroupSeparator: '.',
        allowDecimalPadding: false
      };
      function fillSelect(data, value, caption, default_value, default_caption)
      {
        var result = "<option value='" + default_value + "'>" + default_caption + "</option>";
        var count = data.length;
        for(var x = 0; x < count; x++)
        {
          result += "<option value='" + data[x][value] + "'>" + data[x][caption] + "</option>";
        }
        return result;
      }
      $(document).ready( function () {
			    $('.table').DataTable();
			});
    </script>
