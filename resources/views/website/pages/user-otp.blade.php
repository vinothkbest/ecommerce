@extends('website.templates.main')
@section('contents')
@include('website.templates.nav-bar')
	<section>
	    <div class="reg-page mt-3">
	        <div class="prof-box col-12 col-sm-11 col-md-10 col-lg-9">

	    		<form method="post"
	                  class="det-enq-form"
	                  id="verify-otp" action="{{ route('user.form.auth') }}">
	                  @csrf
	                <div class="row">
	                    <div class="col-12 pl-0">
	                        <h3 class="reg-tit">OTP Verify</h3>
	                        <div class="row">
	                            <label id="time-expire"></label>
	                            {{-- <input type="hidden" id="check-expire"
	                                   name="expire" value=""> --}}
	                            <input type="hidden" name="mobile"
	                                       class="contact-enq"
	                                       value="{{ $latest_user->mobile ?? ''}}">
	                            <div class="input-group">
	                            	 <label><i class="fa fa-lock"></i> OTP</label>
	                                <input type="text" class="contact-enq"
	                                       placeholder="Enter OTP" name="otp"
	                                       pattern="[0-9]{4}"
	                                       title="otp must be a 4 digit number">
	                                <input type="hidden" name="type"
	                                       id="current-user" value="">
	                            </div>
	                            <button class="submit-btn"
	                                    onClick="verifyUser()"
	                                    id="verify-button"
	                                    type="submit">Submit</button>
	                            <button class="submit-btn ml-3"
	                                    onClick="otpResend()" type="submit"
	                                    id="resend-button"
	                                    >Resend OTP</button>
	                        </div>
	                    </div>
	                </div>
	            </form>
	        </div>
	    </div>
	</section>
@endsection
@section("after_js")
<script>
	var otp_created_time = new Date("{{ $latest_user->otp_created_at ?? '' }}");
		otp_created_time.setSeconds(otp_created_time.getSeconds()+60);
		//console.log(otp_created_time.getSeconds())

	var setcount = setInterval(function() {

		  var current_time = new Date();
		    
		  var distance = otp_created_time - current_time;
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		    
		  if(seconds<10 && seconds > 0){
	            jQuery("#time-expire").text("00:0"+seconds);
	            jQuery("#resend-button").attr('disabled', true);
	        	jQuery("#verify-button").attr('disabled', false);
	        }
	      else if(seconds <= 59 && seconds >= 10){
	        jQuery("#time-expire").text("00:"+seconds);
	        jQuery("#time-expire").css({'color':'green'});
	        jQuery("#resend-button").attr('disabled', true);
	        jQuery("#verify-button").attr('disabled', false);
	     }

		 if (distance <= 0) {
		    clearInterval(setcount);
	        jQuery("#time-expire").text("expired");
	        jQuery("#time-expire").css({'color':'red'});
	        jQuery("#resend-button").attr('disabled', false);
	        jQuery("#verify-button").attr('disabled', true);

		  }
	}, 1000);

function otpResend(){
	jQuery("#current-user").val("otp_resend");
	
}
function verifyUser(){
	jQuery("#current-user").val("otp_verify");
}
</script>
@endsection

