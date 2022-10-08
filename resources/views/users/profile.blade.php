@extends('layouts.master')
@section('title')
	الملف الشخصي
@endsection
@section('css')
<!-- Internal Select2 css -->
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
											<img alt="" src="{{URL::asset('assets/img') . './' . auth()->user()->avatar;}}"><a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{auth()->user()->name;}}</h5>
												<p class="main-profile-name-text">{{auth()->user()->email;}}</p>
											</div>
										</div>
										<h6>السيرة الذاتية</h6>
										<div class="main-profile-bio">
											{{auth()->user()->bio}}<a href="">More</a>
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
												<a href="tel:{{auth()->user()->phone}}">{{auth()->user()->phone}}</a>
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
												<a href="https://{{auth()->user()->website}}" target="_blank" rel="noopener noreferrer">{{auth()->user()->website}}</a>
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
												{{auth()->user()->address}}
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
								<div class="mb-4 main-content-label">المعلومات الشخصية</div>
								<form id="profile" class="form-horizontal" action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
                                    {{ method_field('put')}}
									@csrf

									<div class="mb-4 main-content-label">عام</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="name">اسم المستخدم</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="name"  placeholder="اسم المستخدم" value="{{auth()->user()->name}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="first_name">الأسم الأول</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="first_name"  placeholder="الأسم الأول" value="{{auth()->user()->first_name}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="last_name">الأسم الأخير</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="last_name"  placeholder="الأسم الأخير" value="{{auth()->user()->last_name}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="designation">المنصب</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="designation"  placeholder="السيرة الذاتية" value="{{auth()->user()->designation}}">
											</div>
										</div>
									</div>
									<div class="mb-4 main-content-label">معلومات الاتصال</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="email">الإيميل<i> (required)</i></label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  name="email"  placeholder="الإيميل" value="{{auth()->user()->email}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="website">الموقع</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="website"  placeholder="الموقع" value="{{auth()->user()->website}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="phone">التلفون</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="phone"  placeholder="التلفون" value="{{auth()->user()->phone}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label" for="address">العنوان</label>
											</div>
											<div class="col-md-9">
												<textarea class="form-control"  name="address" rows="2"  placeholder="العنوان">{{auth()->user()->address}}</textarea>
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
												<textarea class="form-control" name="bio" rows="4" placeholder="" value="">{{auth()->user()->bio}}</textarea>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="card-footer text-left">
								<button type="submit" form="profile" class="btn btn-primary waves-effect waves-light">تحديث الملف الشخصى</button>
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
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection