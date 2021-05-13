<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>AFCU | Auto Loan Calculator</title>
<script src="js/jquery-1.9.1.min.js"></script> 
<script src="js/jquery.number.min.js"></script>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="loanCalculator" class="calculator-container">
  <div id="loanInfo">
    <h2>Auto Loan Calculator</h2>
    <div class="calculator-row">
      <div class="calculator-50">
        <p>Purchase Price</p>
        <div class="calculator-item"><span>$</span>
          <input type="text" name="loanAmount" id="loanAmount" class="loan-field" size="13" maxlength="13" value="20,000" />
        </div>
        <p id="loanAmountAlert" class="alert"></p>
      </div>
      <div class="calculator-50">
        <p>Down Payment</p>
        <div class="calculator-item"><span>$</span>
          <input  type="text" name="downPaymentCash" id="downPaymentCash" class="loan-field" size="13" maxlength="13" value="0" />
        </div>
        <input type="hidden" name="downPaymentRate" id="downPaymentRate" class="loan-field" size="2" maxlength="2" value="0" />
        <p id="downPaymentAlert" class="alert"></p>
      </div>
    </div>
    <div class="calculator-row">
      <div class="calculator-50">
        <p>Loan Period</p>
        <div class="calculator-item">
          <select id="loanPeriod" class="loan-select">
            <option data-rate="2.99" value="36">36 months</option>
            <option data-rate="2.99" value="48">48 months</option>
            <option data-rate="2.99" selected="selected" value="60">60 months</option>
            <option data-rate="3.49" value="72">72 months</option>
            <option data-rate="3.74" value="84" >84 months</option>
          </select>
        </div>
      </div>
      <div class="calculator-50">
        <p>Interest Rate</p>
        <div class="calculator-item"><span>At</span> <span id="Rate" class="loan-text">2.99</span><span>%</span>
          <input  type="hidden" name="interestRate" id="interestRate" size="7" maxlength="7" value="2.99" />
        </div>
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
    <h4 class="loanAnswer">Today's Estimated Monthly Payment</h4>
    <h3 id="loanPayment" ></h3>
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
<script type="text/javascript">
	$(document).ready(function() {  
		$(function() {
			$('#loanQuote').hide();
		});
	$('select#interestRate').change(function() {
      
		 $("select#loanPeriod option").each(function(){
			 var interestRate = $('select#interestRate').find(':selected').data('id');
			 var id= $(this).attr('data-id');
			if(id == interestRate){ 
			  $(this).prop('selected',true);
			}
		 })
		$("#downPaymentAlert").text("");
		$("#loanAmountAlert").text("");
		$('#loanQuote').hide();
    });
	$('select#loanPeriod').change(function() {
      	var interestRate = $('select#loanPeriod').find(':selected').data('rate');
		$("#Rate").text(interestRate);
		$('#interestRate').val(interestRate);
		$("#downPaymentAlert").text("");
		$("#loanAmountAlert").text("");
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
				loanAmount = $.number( loanAmount);
				$('#loanAmount').val(loanAmount);
				 $("#loanAmountAlert").text("");
				 updateRate();
				 $("#downPaymentAlert").text("");
				 
			 }
		}else{
			$('#loanAmount').val('20,000');
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
			//downPayment = (downPayment * 100);
			var downPaymentCash = $.number( downPayment);
			var downPaymentRate = $.number( rate * 100 );
			if( downPayment >= loanAmount ){	 
				var downPayment = (loanAmount * .2);
				downPayment = parseInt(downPayment);
				var downPaymentCash = $.number( downPayment);
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
				$('#dpRate').text(20);
				$("#downPaymentAlert").text("Please choose a Down Payment less than the Purchase Price.");
				$("#loanAmountAlert").text("");
			 }else{
				var rate = (downPayment/loanAmount);
				rate = (rate * 100);
				if( rate < 1 ){ 
					$('#downPaymentCash').val(0.00);
					$('#downPaymentRate').val(0);
					$('#dpRate').text(0);
					$("#downPaymentAlert").text("Since the Down Paymnet was less than 1% automatically it was adjusted to 0%.");
					$("#loanAmountAlert").text("");
				}else{
					var downPaymentRate = $.number( rate );
					var downPaymentCash = $.number( downPayment);
					$('#downPaymentCash').val(downPaymentCash);
					$('#downPaymentRate').val(downPaymentRate);
					$('#dpRate').text(downPaymentRate);
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
		var la,mp,lp,ir,dp;
		la = $("#loanAmount").val();
		la = la.replace(/,/g, '');
		la = parseInt(la);
		lp = parseInt($("#loanPeriod").val());
		ir = parseFloat($("#interestRate").val())/1200;
		dp = $("#downPaymentRate").val();
		dp = dp.replace(/,/g, '');	
		dp = 1 - parseFloat(dp)/100;
		la = la * dp;
		mp = (la*(ir*Math.pow(1+ir,lp)))/(Math.pow(1+ir,lp)-1);
	if(!isNaN(mp))
	{
		$("#loanPayment").text('$' + mp.toFixed(2));
		$('#loanQuote').show();
	}
	else
	{
		$("#loanPayment").text('There was an error');
	}
		return false;
	});
});
</script>
</body>
</html>