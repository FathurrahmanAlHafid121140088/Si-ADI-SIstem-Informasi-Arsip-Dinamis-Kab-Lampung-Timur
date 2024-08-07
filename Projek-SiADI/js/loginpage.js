const loginpage = () => {
  return `
	<div class="container-form">
		<div class="screen">
			<div class="screen__content">
				<form class="login" id="loginform">
				<div class="login__title">Login
						</div>
					<div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<input type="text" class="login__input" id="contributor-username" placeholder="User name / Email">
					</div>
					<div class="login__field">
						<i class="login__icon fas fa-lock"></i>
						<input type="password" class="login__input" id="contributor-password" placeholder="Password">
					</div>
					<button class="button login__submit" type="submit" id="loginbutton">
						<span class="button__text">Log In Now</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>
					<div class="alt-action-login">Belum memiliki akun? <a href="#/register">Register</a></div>				
				</form>
			</div>
			<div class="screen__background">
				<span class="screen__background__shape screen__background__shape4"></span>
				<span class="screen__background__shape screen__background__shape3"></span>		
				<span class="screen__background__shape screen__background__shape2"></span>
				<span class="screen__background__shape screen__background__shape1"></span>
			</div>		
		</div>
	</div>
      `;
};

export default loginpage;
