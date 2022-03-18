<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
	<!--begin::Menu Container-->
	<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
		<!--begin::Menu Nav-->
		<ul class="menu-nav">

			<li>
				<div class="text-center mb-10">
					<div class="symbol symbol-60 symbol-circle">
						{{-- <div class="symbol-label" style="background-image:url('{{ url('assets/media/users/fotoPerfil.jpg') }}')"> --}}
							<div class="symbol-label" style="background-image:url('{{ url('assets/media/logo.png') }}')">
						</div>
						<i class="symbol-badge symbol-badge-bottom bg-success"></i>
					</div>
					@auth
					<h4 class="font-weight-bold my-2 text-success">{{ Auth::user()->name }}</h4>
					<div class="text-light mb-2">{{ Auth::user()->perfil->nombre }}</div>

					<br />
					<a href="{{ route('logout') }}"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
						class="label label-light-danger label-inline font-weight-bold label-lg">Salir</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
					@endauth
				</div>
			</li> 
			
			<li class="menu-section">
				<h4 class="menu-text">MENU ADMINISTRACION</h4>
				<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
			</li>
			@php
				$estado = "Visible";
				$user_id = Auth::user()->id;
				$menus = App\MenuUsers::where('user_id',$user_id)
										->where('estado',$estado)	
										->get();
				// dd($menus->count());						
			@endphp
			@foreach ($menus as $m)
			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				@if($m->menu)
					@if ($m->menu->direccion == '#' && $m->estado == 'Visible')
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="menu-icon"><i class="{{ $m->menu->icono }}"></i></span>
							<span class="menu-text">{{ $m->menu->nombre }}</span>
							<i class="menu-arrow"></i>
						</a>
						@php
							$menuPadre = $m->menu_id;
							// echo $id;
							// $menuPadre =$m->menu->id;
							$menusHijos = App\Menu::where('padre',$menuPadre)->get();
							// foreach($menusHijos as $mh){
							// 	echo $mh->menuUser->estado."<br>";
							// }
						@endphp
						<div class="menu-submenu">
							<i class="menu-arrow"></i>
							<ul class="menu-subnav">
								<li class="menu-item menu-item-parent" aria-haspopup="true">
									<span class="menu-link">
										<span class="menu-text">{{ $m->menu->nombre }}</span>
									</span>
								</li>
								@foreach ($menusHijos as $mh)
									@php
										$estado = App\menuUsers::where('user_id',$user_id)
															->where('menu_id',$mh->id)
															->first();
															// dd($estado);
									@endphp
									@if ($estado)
										@if($estado->estado == "Visible")
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ url($mh->direccion) }}" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">{{ $mh->nombre }}</span>
												</a>
											</li>	
										@endif
									@endif
								@endforeach
							</ul>
						</div>
					@endif
				@endif
			</li>
			{{-- @php
				$contador++;
			@endphp --}}
			@endforeach

			{{-- 
			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="menu-icon"><i class="fas fa-dog"></i></span>
					<span class="menu-text">Ejemplares</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">Ejemplares</span>
							</span>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Ejemplar/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Listado Ejemplares</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Ejemplar/formulario/0') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Nuevo Ejemplar</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Ejemplar/formularioCamada') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Nueva Camada</span>
							</a>
						</li>		
					</ul>
				</div>
			</li>
			 --}}
		
			{{-- <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="menu-icon"><i class="fas fa-users"></i></span>
					<span class="menu-text">Usuarios</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">Usuarios</span>
							</span>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('User/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Listado</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('User/listadoPropietario') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Propietario</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('User/listaPermisos') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Permisos de Menu</span>
							</a>
						</li>						
					</ul>
				</div>
			</li> --}}

			{{-- <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Book-open.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
							viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path
									d="M5.5,4 L9.5,4 C10.3284271,4 11,4.67157288 11,5.5 L11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M14.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,17.5 C13,16.6715729 13.6715729,16 14.5,16 Z"
									fill="#000000" />
								<path
									d="M5.5,10 L9.5,10 C10.3284271,10 11,10.6715729 11,11.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,12.5 C20,13.3284271 19.3284271,14 18.5,14 L14.5,14 C13.6715729,14 13,13.3284271 13,12.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z"
									fill="#000000" opacity="0.3" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
					<span class="menu-text">Administracion</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">Administracion</span>
							</span>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Raza/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Razas</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('CategoriasPista/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Categorias Pistas</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Examen/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Examenes</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Grupo/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Grupos</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Evento/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Eventos</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Pista/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Pistas</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('TiposUsuario/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Tipos Usuarios</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Titulo/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Titulos</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Sucursal/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Sucursales</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Perfil/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Perfiles</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Criadero/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Criaderos</span>
							</a>
						</li>
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('Alquiler/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Alquileres</span>
							</a>
						</li>
					</ul>
				</div>
			</li> --}}
		</ul>
		<!--end::Menu Nav-->
	</div>
	<!--end::Menu Container-->
</div>