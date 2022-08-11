<?php
$lots="";
$quantities="";
$dailyRisk="";
$lotSize="";
$entryPrice="";
$stopLossPrice="";
$stopLoss="";
$quantity="";
$loss="";
$account="";
$index="";
$bankNifty="";
$nifty="";
$hide="data";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    $account = $_POST['account'];
    $dailyRisk = $_POST['dailyRisk'];
    $lotSize = $_POST['lotSize'];
    $entryPrice = $_POST['entryPrice'];
    $stopLossPrice = $_POST['stopLoss'];

    $stopLoss= $entryPrice - $stopLossPrice;
    $quantity = $stopLoss * $lotSize;

    $lots=floor($dailyRisk/$quantity);

    $quantities=$lots*$lotSize;
    $loss=$quantities*$stopLoss;
    $hide="";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="index.css">

    <title>Position Calculator</title>
  </head>
  <body>
    <div class="container main p-2 mt-2" >
        <!-- <div class="row g-3"></div> -->
    <form method = "post" class="">
        <div class="  d-flex justify-content-center">
            <h1>Position Calculator</h1>
        </div>
      <div class="form-data">
        <div class="form-group">
          <label for="exampleInputEmail1">Account</label>
          <input
            required
            value="100000"
            type="number"
            class="form-control"
            id="account"
            name="account"
          />
        </div>
      <div class="form-data">
        <div class="form-group">
          <label for="exampleInputEmail1">Daily Risk</label>
          <input
            required
            value="3000"
            type="number"
            class="form-control"
            id="dailyRisk"
            name="dailyRisk"
          />
        </div>
        <?php
           if($_SERVER["REQUEST_METHOD"] == "POST") {
                $index = $_POST['lotSize'];
                if ($index==50) {
                    $nifty="selected";
                } else {
                    $bankNifty="selected";
                }
                
           }
        ?>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Select Index</label>
          <select class="form-control" id="exampleFormControlSelect1" name="lotSize">
            <option <?php echo $nifty ?> value="50">Nifty</option>
            <option <?php echo $bankNifty ?> value="25">BankNifty</option>
          </select> 
        </div>
        
          <div class="form-group">
            <label for="exampleInputEmail1">Entry Price</label>
            <input
            
              value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") {echo htmlentities($_POST['entryPrice']);} ?>"
              required
              type="number"
              class="form-control"
              id="entry"
              aria-describedby="entry"
              placeholder="Enter Entry Price"
              name="entryPrice"
              step=".01"
            />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Stop Loss</label>
            <input
              value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") {echo htmlentities($_POST['stopLoss']);} ?>"
              required
              type="number"
              class="form-control"
              id="stopLoss"
              aria-describedby="sl"
              placeholder="Enter Stop Loss"
              name="stopLoss"
              step=".01"
            />
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>


      <div class="d-flex justify-content-center">
      <div class="<?php echo $hide ?> info -flex justify-content-between">
        <div>Lots<label style="margin-left: 143px;"><?php echo $lots;?></label></div>
        <div>Quantities<label style="margin-left: 80px;"><?php echo $quantities;?></label></div>
        <div>Loss<label style="color: #F12D2D;margin-left: 134px;">-<?php echo $loss;?></label></div>
      </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
