<script>
    // JavaScript untuk menampilkan hasil pilihan dari checkbox
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const hasilInput = document.getElementById('hasil');
 
    checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', () => {
        const selectedItems = Array.from(checkboxes)
          .filter((checkbox) => checkbox.checked)
          .map((checkbox) => checkbox.value);
 
        hasilInput.value = selectedItems.join(', ');
      });
    });
  </script>
 
 
 
 
  <script>
    $(document).ready(function() {
      // Handler saat checkbox Check All pada tab AllTransaction diklik
      $("#checkAll").change(function() {
        $(".check-item").prop("checked", $(this).prop("checked"));
      });
 
      // Handler saat checkbox Check All pada tab Completed diklik
      $("#check-all2").change(function() {
        $(".check-item2").prop("checked", $(this).prop("checked"));
      });
 
      // Handler saat salah satu checkbox berubah pada tab AllTransaction
      $(".check-item").change(function() {
        updateCheckAllStatus("#checkAll");
      });
 
      // Handler saat salah satu checkbox berubah pada tab Completed
      $(".check-item2").change(function() {
        updateCheckAllStatus("#check-all2");
      });
 
      // Handler saat tombol Submit pada tab AllTransaction diklik
      $("#btn-submit").click(function() {
        submitForm("form-all-transaction");
      });
 
      // Handler saat tombol Submit pada tab Completed diklik
      $("#btn-submit2").click(function() {
        submitForm("form-completed");
      });
    });
 
 
    function updateCheckAllStatus(checkAllId) {
      var allChecked = true;
      $(".check-item").each(function() {
        if (!$(this).prop("checked")) {
          allChecked = false;
        }
      });
      $(checkAllId).prop("checked", allChecked);
    }
 
    function submitForm(formId) {
      $("#" + formId).submit();
    }
  </script>