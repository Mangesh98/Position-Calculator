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
$msg="";
$hide="data";
$net_profit="";
$total_tax="";
$dr="3000";
$av="100000";

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $account = $_POST['account'];
    $dailyRisk = $_POST['dailyRisk'];
    $dr=$dailyRisk;
    $av=$account;
    $lotSize = $_POST['lotSize'];
    $entryPrice = $_POST['entryPrice'];
    $stopLossPrice = $_POST['stopLoss'];
    $stopLoss= $entryPrice - $stopLossPrice;
    $quantity = $stopLoss * $lotSize;

    $hq=$account/$entryPrice;
    $q=floor($hq/$lotSize);
    $max_quentity=$q*$lotSize;

    
    if ($quantity!=0) {

    $lots=floor($dailyRisk/$quantity);
    $quantities=$lots*$lotSize;

    if($quantities>$max_quentity)
    {
      $lots=$q;
      $quantities=$max_quentity;
      $msg="(Max Lot)";
    }


    $loss=$quantities*$stopLoss;
    $brokerage = 40;

    $turnover = ($entryPrice + $stopLossPrice) * $quantities;
    $stt_total=round($stopLossPrice * $quantities * 0.0005);
    $etc= 0.00053 * $turnover;
    $gst=0.18 * ($brokerage + $etc);
    $sebi_charges =$turnover * 0.000001;
    $sebi_charges =$sebi_charges + $sebi_charges * 0.18;
    $stamp_charges =round($entryPrice * $quantities * 0.00003);
    $total_tax=$brokerage + $stt_total + $etc + $gst + $sebi_charges + $stamp_charges;
      
   $dailyRisk=$dailyRisk-$total_tax;

    $lots=0;
    $loss=0;
    $turnover=0;
    $stt_total=0;
    $etc=0;
    $gst=0;
    $sebi_charges=0;
    $stamp_charges=0;
    $total_tax=0;


    $lots=floor($dailyRisk/$quantity);
    $quantities=$lots*$lotSize;
    if($quantities>$max_quentity)
    {
      $lots=$q;
      $quantities=$max_quentity;
      $msg="( Max Lot )";
    }

    $loss=$quantities*$stopLoss;
    $turnover = ($entryPrice + $stopLossPrice) * $quantities;
    $stt_total=round($stopLossPrice * $quantities * 0.0005);
    $etc= 0.00053 * $turnover;
    $gst=0.18 * ($brokerage + $etc);
    $sebi_charges =$turnover * 0.000001;
    $sebi_charges =$sebi_charges + $sebi_charges * 0.18;
    $stamp_charges =round($entryPrice * $quantities * 0.00003);
    $total_tax=$brokerage + $stt_total + $etc + $gst + $sebi_charges + $stamp_charges;
    $net_profit=round(($stopLossPrice - $entryPrice) * $quantities - $total_tax,2);

    
    $hide="";
    
  }
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
            value="<?php echo $av;?>"
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
            value="<?php echo $dr;?>"
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
        <div>Lots<label style="margin-left: 88px;">:</label><label style="margin-left: 50px;"><?php echo $lots;?><label style="margin-left: 7px;color: red;
        font-style: italic;font-size: 17px;"><?php echo $msg;?></label></label></div>
        <div>Quantities<label style="margin-left: 25px;">:</label><label style="margin-left: 52px;"><?php echo $quantities;?></label></div>
        <div>Total Tax<label style="margin-left: 45px;">:</label><label style="color: #F12D2D;margin-left: 50px;"><?php echo round($total_tax,2);?></label></div>
        <div>Net P&L<label style="margin-left: 47px;">:</label><label style="color: #F12D2D;margin-left: 46px;"><?php echo $net_profit;?></label></div>
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
