<div class="text-center">

	<p class="text-secondary">
		<b>*</b>
		@if ($type == 1)
			این آیتم صرفا مختص مددجویان تحت پوششی است که مجوز راه اندازی شغلی را نداشته و یا تمایلی به دریافت تسهیلات ندارند و متقاضی اشتغال در دستگاه های اجرایی و یا کارگاه های تولیدی و خدماتی هستند.
		@elseif ($type == 2)
			این آیتم مختص مددجویان تحت پوششی است که دارای مجوز راه اندازی کسب و کار بوده ، قبلا از تسهیلات سازمان بهزیستی استفاده ننموده اند و یا نسبت به تسویه تسهیلات دریافتی اقدام نموده اند و در حال حاضر  جهت ایجاد و یا توسعه شغل خود نیازمند استفاده از تسهیلات سازمان بهزیستی هستند.
		@elseif ($type == 3)
			این آیتم مختص مددجویان تحت پوششی است که به صورت خویش فرمائی نسبت به بیمه پردازی اقدام نموده اند و یا در کارگاه های تولیدی مشغول به فعالیت هستند و کارفرما نسبت به بیمه پردازی ایشان اقدام نموده است.
		@endif
	</p>
	<p class="text-danger">
		<b>*</b>
		برای انجام این عملیات باید حتما حساب کاربری داشته باشید. شما میتوانید یا حساب کاربری جدید بسازید یا وارد حساب کاربری که قبلا ساختید بشوید
	</p>
	@auth
		<a href="{{route('signup', [$type, 2])}}" class="btn btn-danger btn-round m-1">
			ورود به عنوان {{user('name')}}
		</a>
	@endauth
	<a href="#user-pass-form" data-toggle="collapse" class="btn btn-warning btn-round m-1">
		@auth
			ورود با حساب کاربری جدید
		@else
			قبلا حساب کاربری ایجاد کردم
		@endauth
	</a>
	<a href="#new-acc-form" data-toggle="collapse" class="btn btn-primary btn-round m-1">
		ایجاد حساب کاربری و ثبت نام
	</a>

	<div id="collapseParent">
		<div class="collapse" data-parent="#collapseParent" id="user-pass-form">
			<hr>
			<form class="row justify-content-center" method="POST" action="{{route('wizard', [$type, $step])}}">
				@csrf
				@include('partials.input', ['type' => 'text', 'name'=>'username', 'col' => 3, 'required' => 1])
				@include('partials.input', ['type' => 'password', 'name'=>'password', 'col' => 3, 'required' => 1])
				<div class="w-100"></div>
				<button type="submit" class="btn btn-danger" name="acc_type" value="login">
					ورود به حساب کاربری
				</button>
			</form>
		</div>

		<div class="collapse" data-parent="#collapseParent" id="new-acc-form">
			<hr>
			<form class="row justify-content-center" method="POST" action="{{route('wizard', [$type, $step])}}">
				@csrf
				@include('partials.input', ['type' => 'text', 'name'=>'username', 'col' => 3, 'required' => 1, 'ac' => 'off'])
				@include('partials.input', ['type' => 'password', 'name'=>'password', 'col' => 3, 'required' => 1, 'ac' => 'off'])
				<div class="w-100"></div>
				<button type="submit" class="btn btn-danger" name="acc_type" value="register">
					ثبت نام
				</button>
			</form>
		</div>
	</div>

</div>
