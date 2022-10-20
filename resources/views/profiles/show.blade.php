@extends('layouts.master')
@section('title')
	الملف الشخصي
@endsection
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"></h4> @yield('title')<span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <a href="{{ url('home') }}">لوحة التحكم</a></span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<!-- Col -->
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
											<img alt="" src="{{URL::asset('assets/img') . './' . $user->profile->avatar;}}">
											{{-- <a class="" href="JavaScript:void(0);"></a> --}}
											<a class="fas fa-camera profile-edit modal-effect" data-effect="effect-scale" data-toggle="modal" href="#avatarmodal"></a>
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{$user->name;}}</h5>
												<p class="main-profile-name-text">{{$user->email;}}</p>
											</div>
										</div>
										<h6>السيرة الذاتية</h6>
										<div class="main-profile-bio">
											{{$user->profile->bio}}<a href="">More</a>
										</div><!-- main-profile-bio -->
										{{-- <hr class="mg-y-30"> --}}

									</div><!-- main-profile-overview -->
								</div>
							</div>
						</div>
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="main-content-label tx-13 mg-b-25">
									التواصل
								</div>
								<div class="main-profile-contact-list">
									<div class="media">
										<div class="media-icon bg-primary-transparent text-primary">
											<i class="icon ion-md-phone-portrait"></i>
										</div>
										<div class="media-body">
											<span>التلفون</span>
											<div>
												<a href="tel:{{$user->profile->phone}}">{{$user->profile->phone}}</a>
											</div>
										</div>
									</div>
									<div class="media">
										<div class="media-icon bg-success-transparent text-success">
											<i class="icon ion-logo-slack"></i>
										</div>
										<div class="media-body">
											<span>الموقع</span>
											<div>
												<a href="{{$user->profile->website}}" target="_blank" rel="noopener noreferrer">{{$user->profile->website}}</a>
											</div>
										</div>
									</div>
									<div class="media">
										<div class="media-icon bg-info-transparent text-info">
											<i class="icon ion-md-locate"></i>
										</div>
										<div class="media-body">
											<span>العنوان الحالى</span>
											<div>
												{{$user->profile->address}}
											</div>
										</div>
									</div>
								</div><!-- main-profile-contact-list -->
							</div>
						</div>
					</div>

					<!-- Col -->
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
									{{-- If there any errors --}}
								@if ($errors->any())
									@foreach ( $errors->all() as $error )
										<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: flex; justify-content: center;">
											<strong>{{ $error }}</strong>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									@endforeach
								@endif
								{{-- If there any Add --}}
								@if (session()->has('Update'))
									<div class="alert alert-success alert-dismissible fade show" role="alert" style="display: flex; justify-content: center;">
										<strong>{{ session()->get('Update') }}</strong>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								@endif
								{{-- If there any Add --}}
								@if (session()->has('Error'))
									<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: flex; justify-content: center;">
										<strong>{{ session()->get('Error') }}</strong>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								@endif
								{{-- Main Settings --}}
								<div class="mb-4 main-content-label">المعلومات الشخصية</div>
								<form id="info" class="form-horizontal" action="{{ url('profile/infoUpdate/' . auth()->user()->id) }}" method="POST">
									{{ method_field('put')}}
									@csrf	
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="name">اسم المستخدم</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="name"  placeholder="اسم المستخدم" value="{{$user->name}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="email">الإيميل<i> (required)</i></label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  name="email"  placeholder="الإيميل" value="{{$user->email}}">
											</div>
										</div>
									</div>
									<div class="form-group text-left">
										<button type="submit" form="info" class="btn btn-primary waves-effect waves-light">تحديث المعلومات الشخصية</button>
									</div>
								</form>
							</div>

							{{-- Profile Settings --}}
							<div class="card-body">
								<div class="mb-4 main-content-label">الملف الشخصي</div>
								<form id="profile" class="form-horizontal" action="{{ url('profile/'.  auth()->user()->id ) }}" method="POST">
                                    {{ method_field('put')}}
									@csrf						
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="first_name">الأسم الأول</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="first_name"  placeholder="الأسم الأول" value="{{$user->profile->first_name}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="last_name">الأسم الأخير</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="last_name"  placeholder="الأسم الأخير" value="{{$user->profile->last_name}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="designation">المنصب</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="designation"  placeholder="السيرة الذاتية" value="{{$user->profile->designation}}">
											</div>
										</div>
									</div>
									<div class="mb-4 main-content-label">معلومات التواصل</div>
									
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="website">الموقع</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="website"  placeholder="الموقع" value="{{$user->profile->website}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="phone">التلفون</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="phone"  placeholder="التلفون" value="{{$user->profile->phone}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="address">العنوان</label>
											</div>
											<div class="col-md-9">
												<textarea class="form-control"  name="address" rows="2"  placeholder="العنوان">{{$user->profile->address}}</textarea>
											</div>
										</div>
									</div>
									<div class="mb-4 main-content-label">معلومات عن نفسك</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="bio">السيرة الذاتية</label>
											</div>
											<div class="col-md-9">
												<textarea class="form-control" name="bio" rows="4" placeholder="" value="">{{$user->profile->bio}}</textarea>
											</div>
										</div>
									</div>
									<div class="form-group text-left">
										<button type="submit" form="profile" class="btn btn-primary waves-effect waves-light">تحديث الملف الشخصى</button>
									</div>
								</form>
							</div>

							{{-- Change Password --}}
							<div class="card-body">
								<div class="mb-4 main-content-label">كلمة المرور</div>
								<form id="password" class="form-horizontal" action="{{ url('profile/passUpdate/' . auth()->user()->id) }}" method="POST">
                                    {{ method_field('put')}}
									@csrf						
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="currentPass">كلمة المرور الحالية</label>
											</div>
											<div class="col-md-9">
												<input type="password" class="form-control" name="currentPass"  placeholder="كلمة المرور الحالية" required>
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col">
												<label class="form-label" for="password">كلمة المرور الجديد</label>
											</div>
											<div class="col">
												<input type="password" class="form-control" name="password"  placeholder="كلمة المرور الجديد" required>
											</div>
											<div class="col">
												<label class="form-label" for="password_confirmation">أعد إدخال كلمة المرور</label>
											</div>
											<div class="col">
												<input type="password" class="form-control" name="password_confirmation"  placeholder="أعد إدخال كلمة المرور" required>
											</div>
										</div>
									</div>
									<div class="form-group text-left">
										<button type="submit" form="password" class="btn btn-primary waves-effect waves-light">تحديث كلمة المرور</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /Col -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

		<div class="modal" id="avatarmodal">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">تغير الصورة الشخصية</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<form action="" method="P"></form>
					<div class="modal-body">
						<input type="hidden" name="id">
						<input type="file" name="avatar" id="avatar">
					</div>
					<div class="modal-footer">
						<button class="btn ripple btn-primary" type="button">حفظ</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
					</div>
				</div>
			</div>
		</div>
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection
