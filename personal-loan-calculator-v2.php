<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>AFCU | Personal Loan Calculator</title>
<script src="js/jquery-1.9.1.min.js"></script> 
<script src="js/jquery.number.min.js"></script>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="loanCalculator" class="calculator-container">
  <div id="loanInfo">
    <h2>Personal Loan Calculator</h2>
    <div class="calculator-row">
      <div class="calculator-50">
        <p>Borrowing Amount</p>
        <div class="calculator-item"><span>$</span>
          <input type="text" name="loanAmount" id="loanAmount" class="loan-field" size="13" maxlength="13" value="3,000" />
        </div>
        <p id="loanAmountAlert" class="alert"></p>
      </div>
    </div>
    <div class="calculator-row">
      <div class="calculator-50">
        <p>Loan Period</p>
        <div class="calculator-item">
          <select id="loanPeriod" class="loan-select">
            <option data-rate="7.99" selected="selected" value="24">24 months</option>
            <option data-rate="8.74" value="36">36 months</option>
            <option data-rate="8.74" value="48">48 months</option>
            <option data-rate="8.74" value="60">60 months</option>
          </select>
        </div>
      </div>
      <div class="calculator-50">
        <p>Interest Rate</p>
        <div class="calculator-item"><span>At</span> <span id="Rate" class="loan-text">7.99</span><span>%</span>
          <input  type="hidden" name="interestRate" id="interestRate" size="7" maxlength="7" value="7.99" />
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
	$('select#loanPeriod').change(function() {
      	var interestRate = $('select#loanPeriod').find(':selected').data('rate');
		$("#Rate").text(interestRate);
		$('#interestRate').val(interestRate);
		$("#loanAmountAlert").text("");
		$('#loanQuote').hide();
    });
	$('#loanAmount').change(function() {
		updateLoan();
		$('#loanQuote').hide();
	});


	function updateLoan(){
		var loanAmount = $('#loanAmount').val(); 
		loanAmount = loanAmount.replace(/,/g, '');
		loanAmount = parseInt(loanAmount);
		if($.isNumeric(loanAmount)){
				loanAmount = $.number( loanAmount);
				$('#loanAmount').val(loanAmount);
				$("#loanAmountAlert").text("");
		}else{
			$('#loanAmount').val('3,000');
			$("#loanAmountAlert").text("Please use a digits only. Reset to Default Settings.");

		}
	}


	$("#calculate").click(function(){
		var la,mp,lp,ir,dp;
		la = $("#loanAmount").val();
		la = la.replace(/,/g, '');
		la = parseInt(la);
		lp = parseInt($("#loanPeriod").val());
		ir = parseFloat($("#interestRate").val())/1200;
		dp = 0
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