@extends('website.templates.main')
@section('contents')
@include('website.templates.nav-bar')
<section>
    <div class="reg-page mt-3">
        <div class="prof-box col-12 col-sm-11 col-md-10 col-lg-9">

            @if($form == "register")

                <form method="post"
                      class="det-enq-form mb-4 user-form"
                      id="register-form" action="{{ route("user.form.register") }}">
                    @csrf
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h3 class="reg-tit">Registration</h3>
                            <div class="row">
                                <div class="input-group">
                                    <label for="user name">
                                        <i class="fas fa-user-alt"></i>
                                        Name</label>
                                    <input type="text" name="name"
                                    class="contact-enq"
                                    placeholder="Enter Name"
                                    pattern="[a-zA-Z]+(\s{0,1}[a-zA-Z]+)"
                                    title="user name must be alphabets or space" 
                                    autocomplete="off"
                                    value="{{ old('name') }}"
                                    required>
                                </div>
                                <div class="input-group">
                                    <label for="user email">
                                        <i class="fa fa-envelope"></i>
                                        Email</label>
                                    <input type="email" name="email" class="contact-enq"
                                           placeholder="Enter Email"
                                           onInput="check()"
                                           autocomplete="off"
                                           title="valid user email"
                                           value="{{ old('email') }}"
                                           id="user_email" required>
                                    <div class="user-email-div"></div>
                                </div>
                                <div class="input-group">
                                    <label for="number">
                                        <i class="fas fa-mobile-alt"></i>
                                        Mobile</label>
                                    <input type="text" name="mobile"
                                            class="contact-enq"
                                            placeholder="Enter Mobile Number"
                                            autocomplete="off"
                                            onInput="check()"
                                            pattern="[0-9]{10}"
                                            value="{{ old('mobile') }}"
                                            title="user mobile number must be 10 digit number" 
                                            id="user_mobile" required>
                                    <div class="user-mobile-div"></div>
                                </div>
                                <div class="input-group">
                                    <label for="">
                                        <i class="fas fa-key"></i>
                                        Password</label>
                                    <input type="password" name="password" id="password"
                                            class="contact-enq" placeholder="Enter Password"
                                            pattern=".{6,}"
                                            title="user password 6 chars or more"
                                            autocomplete="off" required>
                                </div>
                                <button class="submit-btn" 
                                        id="user_register" type="submit">Submit</button>
                                <div class="clearfix"></div>
                                <a href="{{ route('user.form', ['login']) }}" class="login">
                                    Already have an Account?
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

            @elseif($form == "login")

                <form method="post"
                      class="det-enq-form user-form login"
                      id="login-form" action="{{ route("user.form.auth") }}">
                      @csrf
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h3 class="reg-tit">Login</h3>
                            <div class="row">
                                <div class="input-group">
                                    <label for="number">
                                        <i class="fas fa-mobile-alt"></i>
                                        Mobile Number</label>
                                    <input type="text" name="mobile"
                                           class="contact-enq"
                                           pattern="[0-9]{10}"
                                           title="user mobile number must be 10 digit number" 
                                           placeholder="Enter mobile Number"
                                           onInput="isLoginExist()"
                                           id="login-mobile" value="{{ old('mobile') }}" required>
                                    <label class="is_exist"
                                            style="color:red;font-size: 12px;font-weight: bold;"></label>
                                    <input type="hidden" name="type"
                                           id="current-user" value="login">
                                </div>
                                <div class="input-group">
                                    <label for="">
                                        <i class="fas fa-key"></i>
                                        Password</label>
                                    <input type="password" name="password"
                                            pattern=".{6,}"
                                            title="user password 6 chars or more"
                                            class="contact-enq" placeholder="Enter Password"
                                            required>
                                </div>
                                <button class="submit-btn login-btn" type="submit">Submit</button>
                                <div class="clearfix"></div>
                                <a href="{{ route('user.form', ['forgot']) }}" class="login" id="go-reset-pw">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            
            @elseif($form == "forgot")

                <form class="det-enq-form user-form reset-pw" 
                      id="pw-forgot-form" method="post" action="{{ route('user.forgot') }}">
                      @csrf
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h3 class="reg-tit">Forgot Password?</h3>
                            <div class="row">
                                <div class="input-group">
                                    <label for="number">
                                        <i class="fas fa-mobile-alt"></i>
                                        Enter Mobile</label>
                                    <input type="text" name="mobile"
                                           class="contact-enq"
                                           pattern="[0-9]{10}"
                                           title="user mobile number must be 10 digit number"
                                           id="password-mobile"
                                           onInput="isMobileExist()"
                                           placeholder="Enter Mobile Number" required>
                                    <label class="is_exist"
                                            style="color:red;font-size: 12px;font-weight: bold;"></label>
                                </div>
                                
                                    <button class="submit-btn reset-btn"
                                        type="submit">Send OTP</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</section>
@endsection

@section("after_js")
<script>

    function isLoginExist(){
        let login_mobile = jQuery('#login-mobile').val()
        if(login_mobile.length >= 10){
            let user = {
                mobile: login_mobile,
            }
            jQuery.ajax({
                method: "POST",
                headers: {'X-CSRF-TOKEN': jQuery('input[name="_token"]').val()},
                url:  "{{ route('user.exist') }}",
                data: user,
                cache: false,
                success : function(res){
                    console.log(res);
                    if(res == true){
                        jQuery(".is_exist").text("")
                        jQuery(".login-btn").attr('disabled', false);
                    }
                    else{
                        jQuery(".is_exist").text("Mobile number not available")
                        jQuery(".login-btn").attr('disabled', true);
                    }
                }
            });
        }
    }

    function isMobileExist(){
        let password_mobile = jQuery("#password-mobile").val()
        
        if(password_mobile.length >= 10){
            let user = {
                mobile: password_mobile,
            }
            jQuery.ajax({
                method: "POST",
                headers: {'X-CSRF-TOKEN': jQuery('input[name="_token"]').val()},
                url:  "{{ route('user.exist') }}",
                data: user,
                cache: false,
                success : function(res){
                    console.log(res);
                    if(res == true){
                        jQuery(".is_exist").text("")
                        jQuery(".reset-btn").attr('disabled', false);
                    }
                    else{
                        jQuery(".is_exist").text("Mobile number not available")
                        jQuery(".reset-btn").attr('disabled', true);
                    }
                }
            });
        }
    }

    function check(){
        let user = {
            email: jQuery("#user_email").val(),
            mobile: jQuery("#user_mobile").val()
        }

        jQuery.ajax({
            method: "POST",
            headers: {'X-CSRF-TOKEN': jQuery('input[name="_token"]').val()},
            url:  "{{ route('user.same') }}",
            data: user,
            cache: false,
            success : function(res){
                if(res == 3){
                    jQuery("#user_register").attr('disabled', true);
                    jQuery(".user-mobile-div").html("<label class='new-label-mobile' style='color:red;font-size: 12px;font-weight: bold;'>Mobile number alreary used</label>")
                    jQuery(".user-email-div").html("<label class='new-label-email' style='color:red;font-size: 12px;font-weight: bold;'>Email alreary used</label>")
                }
                else if(res == 2){
                    jQuery("#user_register").attr('disabled', true);
                    jQuery(".new-label-mobile").remove();
                    jQuery(".user-email-div").html("<label class='new-label-email' style='color:red;font-size: 12px;font-weight: bold;'>Email alreary used</label>")
                }
                else if(res == 1){
                    jQuery("#user_register").attr('disabled', true);
                    jQuery(".new-label-email").remove();
                    jQuery(".user-mobile-div").html("<label class='new-label-mobile' style='color:red;font-size: 12px;font-weight: bold;'>Mobile number alreary used</label>")
                }
                else{
                    jQuery("#user_register").attr('disabled', false);
                    jQuery(".new-label-mobile").remove();
                    jQuery(".new-label-email").remove();
                }
            }
        });

    }
</script>

@endsection