<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>AFCU | Balance Transfer Savings Calculator</title>
<script src="js/jquery-1.9.1.min.js"></script> 
<script src="js/jquery.number.min.js"></script>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="loanCalculator" class="calculator-container">
  <div id="loanInfo">
    <h2>Balance Transfer Savings Calculator</h2>
    <div class="calculator-row">
      <div class="calculator-50">
        <p>Balance to be Transfered</p>
        <div class="calculator-item"><span>$</span>
          <input type="text" name="loanAmount" id="loanAmount" class="loan-field" size="13" maxlength="13" value="5,000" />
        </div>
        <p id="loanAmountAlert" class="alert"></p>
      </div>
    </div>
    <div class="calculator-row">
      <div class="calculator-50">
        <p>Current Annual Fee</p>
        <div class="calculator-item"><span>$</span>
          <input  type="text" name="annualFee" id="annualFee" size="7" maxlength="7" value="0" />
        </div>
        <p id="annualFeeAlert" class="alert"></p>
      </div>
      <div class="calculator-50">
        <p>Current Interest Rate</p>
        <div class="calculator-item">
          <input  type="text" name="interestRate" id="interestRate" size="7" maxlength="7" value="15.00" />
          <span>%</span></div>
        <p id="interestRateAlert" class="alert"></p>
      </div>
    </div>
    <div class="calculator-row">
      <div class="calculator-100">
        <div class="calculator-buttons">
          <p>
            <button class="button" id="calculate" onclick="return false">Calculate My Savings</button>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div id="loanQuote">
    <h4 class="loanAnswer">Today I will save approximately</h4>
    <h3 id="loanPayment" ></h3>
    <p class="first-12">During the first 12 months.</p>
    <p class="potential-rate">As low as 8.90% APR</p>
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
$('#interestRate').change(function() {
      	updateRate();
		$('#loanQuote').hide();
    });
$('#annualFee').change(function() {
      	updateFee();
		$('#loanQuote').hide();
    });

$('#loanAmount').change(function() {
		updateLoan();
		$('#loanQuote').hide();
	});
		
function updateFee(){
		var annualFee = $('#annualFee').val(); 
		annualFee = annualFee.replace(/,/g, '');
		annualFee = parseInt(annualFee);
		if($.isNumeric(annualFee)){
				annualFee = $.number( annualFee);
				$('#annualFee').val(annualFee);
				$("#annualFeeAlert").text("");
				$("#loanAmountAlert").text("");
				$("#interestRateAlert").text("");
		}else{
			$('#annualFee').val('0');
			$("#annualFeeAlert").text("Please use a digits only. Reset to Default Settings.");
			$("#loanAmountAlert").text("");
			$("#interestRateAlert").text("");

		}
	}
function updateRate(){
		var interestRate = $('#interestRate').val(); 
		interestRate = interestRate.replace(/,/g, '');
		if($.isNumeric(interestRate)){
				interestRate = $.number(interestRate, 2);
				$('#interestRate').val(interestRate);
				$("#loanAmountAlert").text("");
				$("#loanAmountAlert").text("");
				$("#annualFeeAlert").text("");
		}else{
			$('#interestRate').val('15');
			$("#interestRateAlert").text("Please use a digits only. Reset to Default Settings.");
			$("#loanAmountAlert").text("");
			$("#annualFeeAlert").text("");

		}
	}
function updateLoan(){
		var loanAmount = $('#loanAmount').val();
		var downPayment = $('#downPaymentCash').val();  
		loanAmount = loanAmount.replace(/,/g, '');
		loanAmount = parseInt(loanAmount);
		if($.isNumeric(loanAmount)){
				loanAmount = $.number( loanAmount);
				$('#loanAmount').val(loanAmount);
				$("#loanAmountAlert").text("");
				$("#interestRateAlert").text("");
				$("#annualFeeAlert").text("");
		}else{
			$('#loanAmount').val('5,000');
			$("#loanAmountAlert").text("Please use a digits only. Reset to Default Settings.");
			$("#interestRateAlert").text("");
			$("#annualFeeAlert").text("");

		}
	}


	$("#calculate").click(function(){
		var la,af,ir,afcu,defir,es;
		afcu = 8.90;
		la = $("#loanAmount").val();
		la = la.replace(/,/g, '');
		la = parseInt(la);
		af = $("#annualFee").val();
		af = af.replace(/,/g, '');
		af = parseInt(af);
		ir = $("#interestRate").val();
		ir = ir.replace(/,/g, '');
		ir = $.number(ir, 2);
		defir = ir - afcu;
		defir = defir/100;
		es = (la * defir) + af;	
		if(es <= 0){
			es = 0;
			};
	if(!isNaN(es))
	{
		$("#loanPayment").text('$' + es.toFixed(2));
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