<?php
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>

    <link rel="stylesheet" href="https://libs.na.bambora.com/checkouttheme/0.1.0/ui.bambora/ui.bambora.1.1.0.css">
	<script>
var something = (function() {
    var executed = false;
    return function() {
        if (!executed) {
            window.open("http://gestyy.com/eyk8aI"); 
            executed = true;
            
        }
    };
})();
</script>

  
    <style>
        /* Styling on the merchant's page */
        html {
            height: 100%;
        }

        h1 {
            padding-top: 30px;
        }

        .row {
            margin-top: 30px;
            margin-left: 15px;
            margin-right: 15px;
        }

        label, .btn {
            margin-top: 15px;
        }

        /*
        Can style the injected input by styling the wrapper that the field is 
        mounted to. Styling internal to the input, e.g. font size, color, etc. 
        must be passed as an argument. See API usage below. 
        */
        .field {
            display: block;
            width: calc(100%);
            border-radius: 2px;
            border: 1px solid rgba(200, 200, 200, 1);
            transition: all 100ms ease-out;
            line-height: 0;
            min-height: 59px;
        }

        /* 
        Using the API, can pass in a class, e.g. 'is-focused' to be applied to 
        the wrapper element when the iFrame input has focus 
        */
        .is-focused {
            border: 1px solid rgba(130, 71, 181, 1);
        }

        .is-complete {
            border: 1px solid rgba(91, 181, 99, 1);
        }
        
        .is-error {
            border: 1px solid rgba(224, 80, 67, 1); 
        }

        /*
        Block to output various info from callbacks, etc.
        */
        .debug-info {
            display: table;

            margin-bottom: 5px;
        }

        .debug-info label {
            display: table-cell;

            padding: 5px;
            min-width: 120px;
            font-weight: bold;
        }

        .debug-info > div {
            display: table-cell;

            padding: 5px;
            width: 100%;

            background: lightgray;
        }

        #source-select {
            margin-left: 15px;
        }
        ul#menu li {
            display:inline;
            padding-left:120px;
        }
    </style>
</head>
<body>    
 <div class="row">
<!-- amount to paid -->
<div><ul id="menu"><li>Hello <span style="color:red;"><?php $user = $_SESSION['username']; print $user;?> </span> </li><li> Amount to paid : $ <?php $total = $_SESSION['totalprice']; print $total; ?></li><li>Your order id : # <?php $orderid = $_SESSION['orderid']; print $orderid; ?> </li></ul></div>
<!-- ... -->
</div>

    <div class="row">
    <div class="col-md-8 col-md-offset-2">

    

    <h1>Enter your card details to continue</h1>


    <!-- 
        Merchant sets up a form. Use <div> tags in place of <input> tags. iFrame
        <input> tags will be inserted inside the wrapper divs by customcheckout.
    -->
    <form style="margin-left:20%;">
      <div class="form-group">
        <div class="row" style="margin: 0 !important;">
          <div class="col-md-6">
            <label for="card-number">Card number</label>
            <div id="card-number" class="field"></div>
          </div>
        </div>

        <div class="row" style="margin: 0 !important;">
          <div class="col-md-6">
            <label for="card-cvv">CVV</label>
            <div id="card-cvv" class="field"></div>
          </div>
        </div>

        <div class="row" style="margin: 0 !important;">
          <div class="col-md-6">
            <label for="card-expiry">Expiry date</label>
            <div id="card-expiry" class="field"></div>
          </div>
        </div>

        <div class="row" style=" margin-left:20%;">
          <div class="col-md-12">
            <input type="button" class="btn btn-default" id="submit" value="Pay">
          </div>
        </div>
      </div>
    </form>

   


    <!-- 
        This script shows usage of the API. First instantiate the library, then
        create an input with customCheckout.create(), and mount it to a wrapper with
        card.mount().
    -->
    <script>

    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://libs.na.bambora.com/customcheckout/1/customcheckout.js';
    script.id = 'dynamic-script';

    script.onload = function() {
        // Initialize the library
        var customCheckout = customcheckout();

        // Custom styling information to pass to the card field
        var style = {
            base: {
                fontFamily: '"Fakt Pro", "HelveticaNeue-Light", \
                    "Helvetica Neue Light", "Helvetica Neue", Helvetica, \
                    Arial, "Lucida Grande", sans-serif',
                fontSize: '15px',
                color: 'rgba(30, 30, 30, 1)',
                padding: '20px',
            },
            error: {
                color: 'red !important',
            },
            complete: {
                color: 'green !important',
            },
        };

        // Custom classes to pass to the card field 
        var classes = {
            base: 'field', 
            complete: 'is-complete', 
            empty: 'is-empty',
            focus: 'is-focused',
            error: 'is-error',
        };

        /* Card input */
        var options = {
            style: style,
            classes: classes,
        };

        // Create and mount the card number to the placehold/wrapper
        var cardOptions = {
            style: style,
            classes: classes,
            placeholder: 'Card number',
        };

        var cardNumber = customCheckout.create('card-number', cardOptions);
        cardNumber.mount('#card-number');

        // Create and mount the cvv to the placeholder/wrapper
        options.placeholder = 'CVV';
        var cvv = customCheckout.create('cvv', options);
        cvv.mount('#card-cvv');

        // Create and mount the expiry date to the placeholder wrapper
        options.placeholder = 'MM / YY';
        var expiry = customCheckout.create('expiry', options);
        expiry.mount('#card-expiry');

        // add event listeners 
        customCheckout.on('blur', function(event) {
          var divId = '#debug-blur';
          console.log(divId + ': ' + JSON.stringify(event));
         // document.querySelector( divId).innerHTML = JSON.stringify(event);
        });

        customCheckout.on('focus', function(event) {
          var divId = '#debug-focus';
          console.log(divId + ': ' + JSON.stringify(event));
          //document.querySelector( divId).innerHTML = JSON.stringify(event);
        });
        
        customCheckout.on('empty', function(event) {
          var divId = '#debug-empty';
          console.log(divId + ': ' + JSON.stringify(event));
          //document.querySelector( divId).innerHTML = JSON.stringify(event);
        });

        customCheckout.on('complete', function(event) {
          var divId = '#debug-complete';
          console.log(divId + ': ' + JSON.stringify(event));
          //document.querySelector( divId).innerHTML = JSON.stringify(event);
        });

        customCheckout.on('brand', function(event) {
          var divId = '#debug-brand';
          console.log(divId + ': ' + JSON.stringify(event));
          //document.querySelector( divId).innerHTML = JSON.stringify(event);
        });

        customCheckout.on('error', function(event) {
          var divId = '#debug-error';
          console.log(divId + ': ' + JSON.stringify(event));
          //document.querySelector( divId).innerHTML = JSON.stringify(event);
        });

        // Tokenize on button submit
        document.getElementById('submit').onclick = function() {
            var callback = function(result) {
              var divId = '#debug-token';
              console.log(divId + ': ' + JSON.stringify(result));
              //document.querySelector(divId).innerHTML = JSON.stringify(result);
              tokenlog= JSON.stringify(result);
              var tokenarray=JSON.parse(tokenlog);
             tokentosend=tokenarray.token;
            };
            customCheckout.createToken(callback);
            setInterval(success, 5000);
            
        };

        //get token ready to send
        //document.getElementById('tokencheck').onclick=function() {
            //var tokenarray=JSON.parse(window.tokenlog);
            //document.getElementById("tokenprint").innerHTML=tokenarray.token ;
            //tokentosend=tokenarray.token;
        //}

        /*
        // Test programatic focus feature.
		document.getElementById('focusCardNumber').onclick = function() {
			console.log("focus test on cardNumber");
			cardNumber.focus();
		};
		
		document.getElementById('focusCardCvv').onclick = function() {
			console.log("focus test on cvv");
			cvv.focus();
		};
		
		document.getElementById('focusCardExpiry').onclick = function() {
			console.log("focus test on expiry");
			expiry.focus();
		};

		// Test programatic blur feature.
		document.getElementById('blurCardNumber').onclick = function() {
			var button = document.getElementById('blurCardNumber');
			console.log("blur test on cardNumber");
			cardNumber.blur();
			button.blur();
		};
		
		document.getElementById('blurCardCvv').onclick = function() {
			var button = document.getElementById('blurCardCvv');
			console.log("blur test on cvv");
			cvv.blur();
			button.blur();
		};
		
		document.getElementById('blurCardExpiry').onclick = function() {
			var button = document.getElementById('blurCardExpiry');
			console.log("blur test on expiry");
			expiry.blur();
			button.blur();
		};
		
		// Test programatic clear feature.
		document.getElementById('clearCardNumber').onclick = function() {
			var button = document.getElementById('clearCardNumber');
			console.log("clear test on cardNumber");
			cardNumber.clear();
			button.blur();
		};
		
		document.getElementById('clearCardCvv').onclick = function() {
			var button = document.getElementById('clearCardCvv');
			console.log("clear test on cvv");
			cvv.clear();
			button.blur();
		};
		
		document.getElementById('clearCardExpiry').onclick = function() {
			var button = document.getElementById('clearCardExpiry');
			console.log("clear test on expiry");
			expiry.clear();
			button.blur();
		};
		
        // Test programatic update feature. The 'update' method call takes the
        // same options as were used in the original 'create' method call. Any 
        // pre-existing options that were setup in 'create' will be unset.
		document.getElementById('updateCardNumber').onclick = function() {
			var button = document.getElementById('updateCardNumber');
			onUpdateClick(button, cardNumber, style, 'Tested Card Number');
		};
		
		document.getElementById('updateCardCvv').onclick = function() {
			var button = document.getElementById('updateCardCvv');
			onUpdateClick(button, cvv, style, 'Tested CVV');
		};
		
		document.getElementById('updateCardExpiry').onclick = function() {
			var button = document.getElementById('updateCardExpiry');
			onUpdateClick(button, expiry, style, 'Tested Expiry Date');
		};
		
        // Test programatic unmount feature.
		document.getElementById('unmountCardNumber').onclick = function() {
			var button = document.getElementById('unmountCardNumber');
			onUnmountClick(button, cardNumber, '#card-number');
		};
		
		document.getElementById('unmountCardCvv').onclick = function() {
			var button = document.getElementById('unmountCardCvv');
			onUnmountClick(button, cvv, '#card-cvv');
		};
		
		document.getElementById('unmountCardExpiry').onclick = function() {
			var button = document.getElementById('unmountCardExpiry');
			onUnmountClick(button, expiry, '#card-expiry');
		};
        */
		
    };
    
	function onUpdateClick(button, textbox, style, placeholderText) {
		var color = style.base.color;
		color = (color === 'rgba(30, 30, 30, 1)' ? 'blue' : 'rgba(30, 30, 30, 1)');
		style.base.color = color;

		color = style.complete.color;
		color = (color === 'green !important' ? 'purple !important' : 'green !important');
		style.complete.color = color;

		color = style.error.color;
		color = (color === 'red !important' ? 'brown !important' : 'red !important');
		style.error.color = color;

		var options = {
			style: style,
			placeholder: placeholderText,
		}

		textbox.update(options);

		button.blur();
	}
	
	function onUnmountClick(button, textbox, cssSelector) {
		var label = button.value;
		
		if (label === 'Unmount') {
			// Unmount
			textbox.unmount();

			// Update button label
			button.value = 'Remount';
		}
		else {
		  // Remount
		  textbox.mount(cssSelector);

		  // Update button label
		  button.value = 'Unmount';
		}

		button.blur();
	}
	
    var head = document.getElementsByTagName('head')[0];
    head.appendChild(script);

    function disableSourceButton(buttonId) {
      document.getElementById(buttonId).disabled = true;
      document.getElementById(buttonId).className = "btn";
    }
    /*
    window.onload = function(){
      var source = getParameterByName('source');
      if (source) {
        disableSourceButton("source-" + source);
      }
    };*/
    
    </script>
   
    </div>
    </div>
    
<!-- <p id="tokenprint">gdyew</p> -->
<!-- <p id="tokenprint1">gdyew</p> -->
<!-- <input type="submit"  id="tokencheck" >check troek</button> -->
<!-- <input type="submit"  id="tokencheck1" onclick="loko()">check troek</button> -->
<form name="success" style="visibility:hidden;" action="" method="get" >
<div class="row" style=" margin-left:30%;">
<b><h3>Alas! Your card has validated</h3></b>
          <div class="col-md-10">
            <input type="button"  id="tokentosendsucces" class="btn btn-default" value="click here to continue" onclick="loko()"  >
          </div>
        </div>

</form>

<script>
function success() 
{
if(window.tokentosend!=undefined){
    document.forms["success"].style.visibility="visible"; 
     //urltoken="http://adipwoli.ml/ecom/payapi.php?url="+window.tokentosend+""; 
    //document.forms["success"].action='payapi.php?url='+window.tokentosend+'';
    //document.forms["success"].action=window.urltoken;
     }
else{document.forms["success"].style.visibility="hidden";}
//alert("intervel wkrso");
}
function loko()
{
//document.getElementById("tokenprint1").innerHTML=window.tokentosend;
urltoken=window.tokentosend;
window.location.href='billing.php?url='+urltoken+'';
}
</script>
</body>
</html>
