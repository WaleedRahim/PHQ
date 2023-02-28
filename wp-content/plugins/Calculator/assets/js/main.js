 

  jQuery(document).ready(function($) {
	jQuery('.button a').click(function() {
		var pxValue = jQuery('#pixel').val();
		var vwValue = parseFloat(pxValue);
    var remvalue=0;
    var remunit=0;
    $('.output').hide();
    $('.output1').hide();

     if(vwValue>=0 && vwValue<8 ){
       rem=8-vwValue;
       remunit=1;
       
    xwValue=("Your Total unit is 0");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
        xwValues=("The remainder minutes will be "+rem+" to bill the next unit "+remunit);
         jQuery('.output1 label').text(xwValues);
		jQuery('.output1').show();
       
    }
    else if(vwValue>=8 && vwValue<=22){
      rem=23-vwValue;
       remunit=2;
    xwValue=("Your Total unit is  1 ");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
      xwValues=("The remainder minutes will be "+rem+" to bill the next unit "+remunit);
         jQuery('.output1 label').text(xwValues);
		jQuery('.output1').show();
    }
     else if(vwValue>=23 && vwValue<=37){
       rem=38-vwValue;
       remunit=3;
    xwValue=("Your Total unit is  2 ");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
       xwValues=("The remainder minutes will be "+rem+" to bill the next unit "+remunit);
         jQuery('.output1 label').text(xwValues);
		jQuery('.output1').show();
    }
     else if(vwValue>=38 && vwValue<=52){
       rem=53-vwValue;
       remunit=4;
    xwValue=("Your Total unit is  3 ");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
       xwValues=("The remainder minutes will be "+rem+" to bill the next unit "+remunit);
         jQuery('.output1 label').text(xwValues);
		jQuery('.output1').show();
    }
     else if(vwValue>=53 && vwValue<=67){
       rem=68-vwValue;
       remunit=5;
    xwValue=("Your Total unit is  4 ");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
       xwValues=("The remainder minutes will be "+rem+" to bill the next unit "+remunit);
         jQuery('.output1 label').text(xwValues);
		jQuery('.output1').show();
    }
    else if(vwValue>=68 && vwValue<=82){
      rem=83-vwValue;
       remunit=6;
    xwValue=("Your Total unit is  5");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
        xwValues=("The remainder minutes will be "+rem+" to bill the next unit "+remunit);
         jQuery('.output1 label').text(xwValues);
		jQuery('.output1').show();
    }
    else if(vwValue>=83 && vwValue<=97){
      rem=98-vwValue;
       remunit=7;
    xwValue=("Your Total unit is  6");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
      xwValues=("The remainder minutes will be "+rem+" to bill the next unit "+remunit);
         jQuery('.output1 label').text(xwValues);
		jQuery('.output1').show();
    }
    else if(vwValue>=98 && vwValue<=112){
      rem=113-vwValue;
       remunit=8;
    xwValue=("Your Total unit is  7 ");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
        xwValues=("The remainder minutes will be "+rem+" to bill the next unit "+remunit);
         jQuery('.output1 label').text(xwValues);
		jQuery('.output1').show();
    }
    else if(vwValue>=113 && vwValue<=127){
        $('.output1').hide();
    xwValue=("Your Total unit is  8 ");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
    }
    else if(vwValue>=128){
      xwValue=("please enter number between 1 to 127 ");
  jQuery('.output label').text(xwValue);
		jQuery('.output').show();
      
    }
	});

});


       