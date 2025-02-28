<script>
//JQuery Ajax for productname
  function selectProduct(value) {
    $(document).ready(function() {
      var product_name = value;
      if (product_name != "") {
        $.ajax({
          url: "./ajax/products/model.php",
          method: "POST",
          data: {
            product_name: product_name
          },
          success: function(data) {
            $("#modelDiv").html(data);
          }
        });
      } else {
        $("#modelDiv").css("display", "none");
      }
    });

  }

  //JQuery Ajax for model
  function selectModel(value1, value2) {
    $(document).ready(function() {
      var model = value1;
      var product_name = value2;
      if (model && product_name != "") {
        $.ajax({
          url: "./ajax/products/brand.php",
          method: "POST",
          data: {
            model: model,
            product_name: product_name
          },
          success: function(data) {
            $("#brandDiv").html(data);
          }
        });
      } else {
        $("#brandDiv").css("display", "none");
      }
    });
  }

  //JQuery Ajax for Manufacturer
  function selectManufacturer(value1, value2, value3) {
    $(document).ready(function() {
      var manufacturer = value1;
      var model = value2;
      var productname = value3;
      if (manufacturer && model && productname != "") {
        $.ajax({
          url: "sales_ajax/load_rprice.php",
          method: "POST",
          data: {
            manufacturer: manufacturer,
            model: model,
            productname: productname
          },
          success: function(data) {
            $("#rPriceQty").html(data);
          }
        });
      } else {
        $("#rPriceQty").css("display", "none");
      }
    });

  }
</script>

