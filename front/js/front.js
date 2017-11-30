$(function () {

		  $("#social").select2({
		   templateResult: formatState

		  });

      $("#fisher").hover(function(){
        $('.fisherstore').show();
        $('.mystore').hide();
      });

      $("#my").hover(function(){
        $('.fisherstore').hide();
        $('.mystore').show();
      });


		 function formatState (state) {
		  if (!state.id) { return state.text; }
		  var $state = $(
		   '<span ><img sytle="display: inline-block;" src="img/' + state.text + '.jpg" style="width:30px; float:right;    box-shadow: 1px 1px 1px #000;" /> ' + state.text + '</span>'
		  );
		  return $state;
		 }

     function setCookie(cvalue) {
        var date_variable = new Date();
        date_variable.setTime(date_variable.getTime() + (30*24*60*60*1000));
        var expires = "expires="+ date_variable.toUTCString();
        document.cookie = "country=" + cvalue + ";" + expires + ";path=/";

    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkCookie() {
        var preferedCountry = getCookie("country");
        if (preferedCountry == 'my') {
          window.location = "http://my.asiaebuy.com";
        }
        else if(preferedCountry == 'fisher'){
          window.location = "http://asiaebuy.com/fisher";
        }
        else{
          //do nothing
        }
        // if (preferedCountry != "") {
        //    window.location = "https://easyparcel."+preferedCountry;
        // }
    }

      

});