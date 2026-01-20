
<style>
@import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Quicksand", sans-serif;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: #111;
  width: 100%;
  overflow: hidden;
}

/* Ring Container */
.ring {
  position: relative;
  width: 500px;
  height: 500px;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Glowing Animation */
.ring i {
  position: absolute;
  inset: 0;
  border: 2px solid #fff;
  transition: 0.5s;
}

.ring i:nth-child(1) {
  border-radius: 38% 62% 63% 37% / 41% 44% 56% 59%;
  animation: animate 6s linear infinite;
}
.ring i:nth-child(2) {
  border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
  animation: animate 4s linear infinite;
}
.ring i:nth-child(3) {
  border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
  animation: animate2 10s linear infinite;
}

.ring:hover i {
  border: 6px solid var(--clr);
  filter: drop-shadow(0 0 20px var(--clr));
}

/* Animation Keyframes */
@keyframes animate {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@keyframes animate2 {
  0% { transform: rotate(360deg); }
  100% { transform: rotate(0deg); }
}

/* Login Box */
.login {
  position: absolute;
  width: 320px;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  gap: 22px; /* More space between elements */
}

/* Heading */
.login h2 {
  font-size: 2em;
  color: #fff;
  margin-bottom: 10px;
}

/* Input Box */
.login .inputBx {
  position: relative;
  width: 100%;
}

/* Input Fields */
.login .inputBx input {
  position: relative;
  width: 100%;
  padding: 14px 22px; /* Better padding */
  margin-bottom: 15px; /* Extra space between inputs */
  background: rgba(255, 255, 255, 0.05);
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 40px;
  font-size: 1.1em;
  color: #fff;
  transition: all 0.3s ease-in-out;
  outline: none;
}

/* Focus Effect */
.login .inputBx input:focus {
  border-color: #ff357a;
  box-shadow: 0 0 15px rgba(255, 53, 122, 0.8);
}

/* Submit Button */
.login .inputBx input[type="submit"] {
  width: 100%;
  background: linear-gradient(45deg, #ff357a, #fff172);
  border: none;
  cursor: pointer;
  color: #000;
  font-weight: bold;
  letter-spacing: 1px;
  transition: all 0.3s ease-in-out;
}

/* Hover Effect on Submit */
.login .inputBx input[type="submit"]:hover {
  transform: scale(1.05);
  box-shadow: 0 0 15px rgba(255, 241, 114, 0.7);
}

/* Placeholder Style */
.login .inputBx input::placeholder {
  color: rgba(255, 255, 255, 0.65);
}

/* Links Section */
.login .links {
  position: relative;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 5px;
}

.login .links a {
  color: #fffdc1;
  text-decoration: none;
  font-size: 0.95em;
  transition: color 0.3s ease-in-out;
}

.login .links a:hover {
  color: #ff357a;
}

</style>
<!-- Ring Login Form Starts -->
<div class="ring">
    <i style="--clr:#88d98a;"></i>
    <i style="--clr:#e187a5;"></i>
    <i style="--clr:#cbca63;"></i>

    <div class="login">
        <h2>भवतः स्वागतम्</h2>

        @if(session('message'))
            <p class="alert alert-info">{{ session('message') }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Input -->
            <div class="inputBx">
                <input id="email" type="email" name="email" placeholder="{{ trans('global.login_email') }}"
                       value="{{ old('email', null) }}" required autofocus>
                @if($errors->has('email'))
                    <small style="color: red;">{{ $errors->first('email') }}</small>
                @endif
            </div>

            <!-- Password Input -->
            <div class="inputBx">
                <input id="password" type="password" name="password" placeholder="{{ trans('global.login_password') }}" required>
                @if($errors->has('password'))
                    <small style="color: red;">{{ $errors->first('password') }}</small>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="inputBx">
                <input type="submit" value="{{ trans('global.login') }}">
            </div>

            <!-- Remember Me & Links -->
            <div class="links" style="display:flex; justify-content:space-between; width:100%;">
                <label style="color:#fff;">
                    <input type="checkbox" name="remember" style="margin-right:5px;">
                    {{ trans('global.remember_me') }}
                </label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forget Password</a>
                @endif
            </div>

            <div class="links" style="margin-top:10px;">
                <a href="{{ route('register') }}">Signup</a>
            </div>
        </form>
    </div>
</div>
<!-- Ring Login Form Ends -->

