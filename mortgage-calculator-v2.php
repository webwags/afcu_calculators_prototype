<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>AFCU | Mortgage Calculator</title>
<script src="js/jquery-1.9.1.min.js"></script> 
<script src="js/jquery.number.min.js"></script>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="loanCalculator"  class="calculator-container">
  <div id="loanInfo">
    <h2>Mortgage Calculator</h2>
    <div class="calculator-row">
      <div class="calculator-45">
        <p>Purchase Price</p>
        <div class="calculator-item"><span>$</span>
          <input type="text" name="loanAmount" id="loanAmount" class="mortgageField" size="13" maxlength="13" value="300,000" />
        </div>
        <p id="loanAmountAlert" class="alert"></p>
      </div>
      <div class="calculator-55">
        <p>Down Payment</p>
        <div><span>$</span>
          <input  type="text" name="downPaymentCash" id="downPaymentCash" class="mortgageField" size="13" maxlength="13" value="60,000" />
          <span>or</span>
          <input type="text" name="downPaymentRate" id="downPaymentRate" class="mortgageField" size="2" maxlength="2" value="20" />
          <span>%</span></div>
        <p id="downPaymentAlert" class="alert"></p>
      </div>
    </div>
    <div class="calculator-row">
      <div class="calculator-100">
        <div class="calculator-buttons">
          <p>
            <button class="button" id="calculate" onclick="return false">Calculate Payment</button>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div id="loanQuote">
    <table border="0" cellpadding="0" cellspacing="0" class="loan-results" >
      <tr class="theading">
        <th>Program Name</th>
        <th>Rate</th>
        <th>Points</th>
        <th>APR</th>
        <th>Payment</th>
      </tr>
      <tr>
        <td>15-Year Fixed (Conforming)</td>
        <td>2.750%</td>
        <td>0.00%</td>
        <td>2.945%</td>
        <td id="yr15-0pts"></td>
      </tr>
      <tr>
        <td>15-Year Fixed (Conforming)</td>
        <td>2.625%</td>
        <td>1.00%</td>
        <td>2.965%</td>
        <td id="yr15-1pts"></td>
      </tr>
      <tr>
        <td>15-Year Fixed (Conforming)</td>
        <td>2.375%</td>
        <td>3.00%</td>
        <td>3.007%</td>
        <td id="yr15-3pts"></td>
      </tr>
      <tr>
        <td>20 Year Fixed (Conforming)</td>
        <td>3.000%</td>
        <td>0.00%</td>
        <td>3.167%</td>
        <td id="yr20-0pts"></td>
      </tr>
      <tr>
        <td>20 Year Fixed (Conforming)</td>
        <td>2.875%</td>
        <td>1.00%</td>
        <td>3.153%</td>
        <td id="yr20-1pts"></td>
      </tr>
      <tr>
        <td>20 Year Fixed (Conforming)</td>
        <td>2.625%</td>
        <td>3.00%</td>
        <td>3.128%</td>
        <td id="yr20-3pts"></td>
      </tr>
      <tr>
        <td>30 Year Fixed (Conforming)</td>
        <td>3.000%</td>
        <td>0.00%</td>
        <td>3.118%</td>
        <td id="yr30-0pts"></td>
      </tr>
      <tr>
        <td>30 Year Fixed (Conforming)</td>
        <td>2.875%</td>
        <td>1.00%</td>
        <td>3.071%</td>
        <td id="yr30-1pts"></td>
      </tr>
      <tr>
        <td>30 Year Fixed (Conforming)</td>
        <td>2.625%</td>
        <td>3.00%</td>
        <td>2.978%</td>
        <td id="yr30-3pts"></td>
      </tr>
    </table>
    <p class="legalize">APR = Annual Percentage Rate. For estimation purposes only. 
      Eligibility requirements and fees may apply.</p>
    <div class="calculator-row">
      <div class="calculator-100">
        <button class="button" id="applyNow">Apply Now</button>
      </div>
    </div>
  </div>
</div>
<div class="calculator-row">
  <div class="calculator-100"><a href="index.html">< BACK</a></div>
</div>
<?php
$test = 'Program Name';
?>
<script type="text/javascript">
	$(document).ready(function() {  
		$(function() {
			$('#loanQuote').hide();
		});
		
		
	$('#loanAmount').change(function() {
		updateLoan();
		$('#loanQuote').hide();
	});
	 $("#downPaymentRate").change( function() {
	 	updateRate();
		 $('#loanQuote').hide();
	});
	$("#downPaymentCash").change( function() {
		updateCash();
		$('#loanQuote').hide();
	});

	function updateLoan(){
		var loanAmount = $('#loanAmount').val();
		var downPayment = $('#downPaymentCash').val();  
		loanAmount = loanAmount.replace(/,/g, '');
		loanAmount = parseInt(loanAmount);
		downPayment = downPayment.replace(/,/g, '');
		downPayment = parseInt(downPayment);
		if($.isNumeric(loanAmount)){
			if( downPayment >= loanAmount ){
				loanAmount = $.number( loanAmount);
				$('#loanAmount').val(loanAmount);
				$("#loanAmountAlert").text("Purchase Price was lower than downpayment. Adjusted Down Payment Amount based on Down Payment Percentage.");
				updateCash();
				$("#downPaymentAlert").text("");
			 }else{
				loanAmount = $.number( loanAmount );
				$('#loanAmount').val(loanAmount);
				 $("#loanAmountAlert").text("");
				 updateRate();
				 $("#downPaymentAlert").text("");
				 
			 }
		}else{
			$('#loanAmount').val('300,000');
			$("#loanAmountAlert").text("Please use a digits only. Reset to Default Settings.");
			$("#downPaymentAlert").text("");
		}
	}
	function updateRate(){
		var rate = $('#downPaymentRate').val(); 
		var loanAmount = $('#loanAmount').val(); 
		rate = parseInt(rate);
		loanAmount = loanAmount.replace(/,/g, '');
		 loanAmount = parseInt(loanAmount);
		 if($.isNumeric(rate)){
			rate = (rate/100);
			var downPayment = (loanAmount * rate);
			var downPaymentCash = $.number( downPayment);
			var downPaymentRate = $.number( rate * 100 );
			if( downPayment >= loanAmount ){	 
				var downPayment = (loanAmount * .2);
				downPayment = parseInt(downPayment);
				var downPaymentCash = $.number( downPayment );
				$('#downPaymentRate').val(20);
				$('#downPaymentCash').val(downPaymentCash);	 
				$("#downPaymentAlert").text("Please choose a Down Payment less than the Purchase Price.");
				$("#loanAmountAlert").text("");
			 }else{
				$('#downPaymentRate').val(downPaymentRate);
				$('#downPaymentCash').val(downPaymentCash);
				$("#downPaymentAlert").text("");
				$("#loanAmountAlert").text("");
			}
		 }else{
			rate = .2;	 
			var downPayment = (loanAmount * rate);
			var downPaymentCash = $.number( downPayment); 
			var downPaymentRate = $.number( rate * 100 );
			$('#downPaymentRate').val(downPaymentRate);
			$('#downPaymentCash').val(downPaymentCash);	 
			$("#downPaymentAlert").text("Please use digits only. Reset to Default Settings");
			$("#loanAmountAlert").text("");
		 }
	}
	function updateCash(){
		var downPayment = $('#downPaymentCash').val();
		var loanAmount = $('#loanAmount').val();
		downPayment = downPayment.replace(/,/g, '');
		downPayment = parseInt(downPayment);
		loanAmount = loanAmount.replace(/,/g, '');
		loanAmount = parseInt(loanAmount);

		if($.isNumeric(downPayment)){
			if( downPayment >= loanAmount ){ 
				var downPayment = (loanAmount * .2);
				downPayment = parseInt(downPayment);
				var downPaymentCash = $.number( downPayment);
				$('#downPaymentRate').val(20);
				$('#downPaymentCash').val(downPaymentCash);	 
				$("#downPaymentAlert").text("Please choose a Down Payment less than the Purchase Price.");
				$("#loanAmountAlert").text("");
			 }else{
				var rate = (downPayment/loanAmount);
				rate = (rate * 100);
				if( rate < 1 ){ 
					$('#downPaymentCash').val(0.00);
					$('#downPaymentRate').val(0);
					$("#downPaymentAlert").text("Since the Down Paymnet was less than 1% automatically it was adjusted to 0%.");
					$("#loanAmountAlert").text("");
				}else{
					var downPaymentRate = $.number( rate );
					var downPaymentCash = $.number( downPayment);
					$('#downPaymentCash').val(downPaymentCash);
					$('#downPaymentRate').val(downPaymentRate);
					$("#downPaymentAlert").text("");
					$("#loanAmountAlert").text("");	
				}
				
			}
		}else{
			rate = .2;	 
			var downPayment = (loanAmount * rate);
			var downPaymentCash = $.number( downPayment); 
			var downPaymentRate = $.number( rate * 100 );
			$('#downPaymentRate').val(downPaymentRate);
			$('#downPaymentCash').val(downPaymentCash);	 
			$("#downPaymentAlert").text("Please use digits only. Reset to Default Settings");
			$("#loanAmountAlert").text("");

		}	
	}

		
	$("#calculate").click(function(){
		var mortgageType = [
            [
				  "yr15-0pts",
				  "15",
				  "2.750"
               ],
       		[
				"yr15-1pts",
				 "15",
				 "2.625"
               ],
			[
				"yr15-3pts",
				 "15",
				 "2.375"
               ],
			[
				  "yr20-0pts",
				  "20",
				  "3.000"
               ],
       		[
				"yr20-1pts",
				 "20",
				 "2.875"
               ],
			[
				"yr20-3pts",
				 "20",
				 "2.625"
               ],
			[
				  "yr30-0pts",
				  "30",
				  "3.000"
               ],
       		[
				"yr30-1pts",
				 "30",
				 "2.875"
               ],
			[
				"yr30-3pts",
				 "30",
				 "2.625"
               ],
             ];
		$.each(mortgageType, function(index, holder){
			var id = holder[0];
			var lp = holder[1];
			var ir = holder[2];
			
			$.each(holder, function(key, value){
				if((id) && (lp) && (ir)){
					if(key === 0){
					var la,mp,dp;
					la = $("#loanAmount").val();
					la = la.replace(/,/g, '');
					la = parseInt(la);
					lp = parseFloat(lp) * 12;
					ir = parseFloat(ir)/1200;
					dp = $("#downPaymentRate").val();
					dp = dp.replace(/,/g, '');	
					dp = 1 - parseFloat(dp)/100;
					la = la * dp;
					mp = (la*(ir*Math.pow(1+ir,lp)))/(Math.pow(1+ir,lp)-1);
					mp = '$' + mp.toFixed(2);
					document.getElementById(id).innerHTML = mp;
					}
				}
			});
		});
		
		$('#loanQuote').show();
		$("#downPaymentAlert").text("");
		$("#loanAmountAlert").text("");
		//return false;
	});
});
</script>
</body>
</html>