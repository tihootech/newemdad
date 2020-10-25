<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
	<div class="app-sidebar__user justify-content-center">
		<div class="text-center">
			<p class="app-sidebar__user-name">{{user('name')}}</p>
			<p class="app-sidebar__user-designation"> دسترسی : {{user('access')}}</p>
		</div>
	</div>
	<ul class="app-menu">
		<li>
			<a class="app-menu__item @if(rn() == 'home') active @endif" href="{{route('home')}}">
				<i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">داشبورد</span>
			</a>
		</li>

		@master
			<li>
				<a class="app-menu__item @if(rn() == 'expert.index') active @endif" href="{{route('expert.index')}}">
					<i class="app-menu__icon fa fa-user-secret"></i><span class="app-menu__label">  مسئولین شهرستان ها </span>
				</a>
			</li>
		@endmaster

		@admins
			<li>
				<a class="app-menu__item @if(rn() == 'user.index') active @endif" href="{{route('user.index')}}">
					<i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"> مدیریت حساب های کاربری </span>
				</a>
			</li>

			<li>
				<a class="app-menu__item @if(rn() == 'organ.index') active @endif" href="{{route('organ.index')}}">
					<i class="app-menu__icon fa fa-list"></i><span class="app-menu__label"> لیست کارفرمایان </span>
				</a>
			</li>

			@php
				$hrefs = [route('madadjus', 'job'), route('madadjus', 'loan'), route('madadjus', 'insurance')];
			@endphp
			<li class="treeview @if(expanded($hrefs)) is-expanded @endif">
				<a class="app-menu__item" href="#" data-toggle="treeview">
					<i class="app-menu__icon fa fa-users"></i>
					<span class="app-menu__label"> لیست مددجویان </span>
					<i class="treeview-indicator fa fa-angle-left"></i>
				</a>
				<ul class="treeview-menu">
					<li>
						<a class="treeview-item @if(active($hrefs[0])) active @endif" href="{{$hrefs[0]}}">
							<i class="icon fa fa-circle-o"></i> جویای شغل
						</a>
					</li>
					<li>
						<a class="treeview-item @if(active($hrefs[1])) active @endif" href="{{$hrefs[1]}}">
							<i class="icon fa fa-circle-o"></i> متقاضی وام
						</a>
					</li>
					<li>
						<a class="treeview-item @if(active($hrefs[2])) active @endif" href="{{$hrefs[2]}}">
							<i class="icon fa fa-circle-o"></i> بیمه خویش فرمائی و کارفرمائی
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a class="app-menu__item @if(rn() == 'rahgiri') active @endif" href="{{route('rahgiri')}}">
					<i class="app-menu__icon fa fa-code"></i><span class="app-menu__label"> کدرهگیری و جستجو </span>
				</a>
			</li>
		@endadmins

		@organ
			<li>
				<a class="app-menu__item @if(rn() == 'solicit.create') active @endif" href="{{route('solicit.create')}}">
					<i class="app-menu__icon fa fa-address-book-o"></i><span class="app-menu__label"> درخواست مددجو </span>
				</a>
			</li>
		@endorgan

		@php
			$route = is('master') ? 'notification.create' : 'notification.index';
		@endphp
		<li>
			<a class="app-menu__item @if(rn() == $route) active @endif" href="{{route($route)}}">
				<i class="app-menu__icon fa fa-bullhorn"></i><span class="app-menu__label"> اطلاع رسانی </span>
			</a>
		</li>

	</ul>
</aside>
