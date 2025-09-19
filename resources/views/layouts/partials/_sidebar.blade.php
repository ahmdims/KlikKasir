<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
	data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
	data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
	<!--begin::Wrapper-->
	<div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper">
		<div class="hover-scroll-y my-5 my-lg-2 mx-4" data-kt-scroll="true"
			data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
			data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper"
			data-kt-scroll-offset="5px">
			<!--begin::Sidebar menu-->
			<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
				class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-3 mb-5">
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
					<!--begin:Menu link-->
					<span class="menu-link">
						<span class="menu-icon">
							<i class="ki-outline ki-home-2 fs-2"></i>
						</span>
						<span class="menu-title">Dashboards</span>
						<span class="menu-arrow"></span>
					</span>
					<!--end:Menu link-->
					<!--begin:Menu sub-->
					<div class="menu-sub menu-sub-accordion">
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}"
								href="{{ route('dashboard') }}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Default</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
					</div>
					<!--end:Menu sub-->
				</div>
				<!--end:Menu item-->

				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
					<!--begin:Menu link-->
					<span class="menu-link">
						<span class="menu-icon">
							<i class="ki-outline ki-shield-tick fs-2"></i>
						</span>
						<span class="menu-title">User Management</span>
						<span class="menu-arrow"></span>
					</span>
					<!--end:Menu link-->
					<!--begin:Menu sub-->
					<div class="menu-sub menu-sub-accordion">
						@can('manage_roles')
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link {{ request()->routeIs('roles.*') ? 'active' : '' }}"
									href="{{ route('roles.index') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Roles</span>
								</a>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
						@endcan

						@can('manage_users')
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
									href="{{ route('users.index') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Users</span>
								</a>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
						@endcan

						@can('manage_permissions')
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}"
									href="{{ route('permissions.index') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Permissions</span>
								</a>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
						@endcan
					</div>
					<!--end:Menu sub-->
				</div>
				<!--end:Menu item-->
			</div>
			<!--end::Sidebar menu-->
		</div>
	</div>
	<!--end::Wrapper-->
</div>
<!--end::Sidebar-->