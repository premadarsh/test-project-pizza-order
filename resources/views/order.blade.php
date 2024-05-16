
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Prem">
    <meta name="generator" content="Test">
    <title>Order Your Pizza</title>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
<form name="SavePizzaOrder" id="SavePizzaOrder" method="post" autocomplete="off" action="{{ route('submit.orderform') }}">
    @csrf
    <p style="margin-top: 40px"></p>
    <div class="w-50 p-3 align-middle" style="background-color: #eee;">

  <div class="form-group row">
    <label for="size" class="col-4 col-form-label">Size</label>
    <div class="col-8">
      <select id="size" name="size" required="required" class="custom-select">

        <option value="" data-price="0" id="0" selected>Please Select</option>

        @foreach($size ?? '' as $val)
            <option value="{{$val->id}}" data-price="{{$val->price}}" id="{{$val->id}}">{{ucfirst( $val->nameprice )}}</option>
        @endforeach

      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="toppings" class="col-4 col-form-label">Toppings</label>
    <div class="col-8">
      <select id="toppings" name="toppings" required="required" class="custom-select">

        <option value="" data-price="0" id="0" selected>Please Select</option>

        @foreach($toppings ?? '' as $val)
            <option value="{{$val->id}}" data-price="{{$val->price}}" id="{{$val->id}}">{{ucfirst( $val->nameprice )}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">Extra Cheese</label>
    <div class="col-8">
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="extra_cheese" id="extra_cheese" type="checkbox" class="custom-control-input" value="1">
        <label for="extra_cheese" class="custom-control-label">RM <span id="showExtraCheesePrice">0.00</span></label>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-4">Total</label>
    <div class="col-8">
      <div class="custom-control-inline">
        <label>RM <span style="color: #dc216e" id="totalPrice">0.00</span></label>
      </div>
    </div>
  </div>


  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>

  @foreach($extracheese ?? '' as $val)

  <input type="hidden" id="extracheese_{{$val->size_id}}" value="{{$val->price}}">

  @endforeach
</form>

</div>
  </body>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>


$(document).ready(function() {

  var totalPrice = 0;

  var sizeSelect = $('#size');
  var toppingsSelect = $('#toppings');
  var extraCheeseCheckbox = $('#extra_cheese');

  sizeSelect.on('change', function() {  
      updateTotalPriceDisplay();
      updateExtraCheesePriceDisplay($('#size').val());
  });

  toppingsSelect.on('change', function() {  
      updateTotalPriceDisplay();
  });

  extraCheeseCheckbox.on('change', function() {    
      updateTotalPriceDisplay();
  });

  function updateExtraCheesePriceDisplay(selectedSize) {

      selectedSizeCheesePrice =  $('#extracheese_'+selectedSize).val();
      $("#showExtraCheesePrice").html(selectedSizeCheesePrice);
  }

  function updateTotalPriceDisplay() {

    let totalprice = 0;
    var selectedSizePrice = parseInt($('#size').find('option:selected').data('price'));
    var selectedToppingPrice = parseInt($('#toppings').find('option:selected').data('price'));
    var extraprice = parseInt($('#extracheese_'+$('#size').val()).val());

    totalPrice = selectedSizePrice;
    totalPrice += selectedToppingPrice;

    if (extraCheeseCheckbox.is(':checked')) {
      totalPrice += extraprice;
    } 

    if(isNaN(totalPrice)) {
      var totalPrice = 0;
    }
    
    $('#totalPrice').text(totalPrice.toFixed(2));

  }

  updateTotalPriceDisplay();

});

  </script>
</html>
