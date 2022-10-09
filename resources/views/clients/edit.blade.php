@extends('layouts.master')
@section('title')
	تعديل بيانات العميل
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"><a href="{{ url()->current() }}">@yield('title')</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <a href="{{ url('home') }}">لوحة التحكم</a></span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				{{-- If there any errors --}}
				@if ($errors->any())
					@foreach ( $errors->all() as $error )
						<div id="ui_notifIt" class="error" style="width: 400px; opacity: 1; left: 440px; top: 10px; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
							<p>{{ $error }}</p> 
							<span id="close" onclick="this.parentNode.remove(); return false;">x</span>
						</div>
					@endforeach
				@endif
				{{-- If there any Edit --}}
				@if (session()->has('Edit'))
					<div class="alert alert-success alert-dismissible fade show" role="alert" style="display: flex; justify-content: center;">
						<strong>{{ session()->get('Edit') }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				<!-- row -->
				<div class="row">
					<div class="card-body" style="background: #fff;">
						<div class="main-content-label mg-b-5">
							@yield('title')
						</div>
                        <br>
						<form action="{{ route('clients.update', $client->id) }}" method="POST">
							{{ method_field('PUT') }}
							@csrf
							<div class="row row-sm">
								<div class="col-6">
									<div class="form-group mg-b-0">
										<label class="form-label" for="name">الأســـم : <span class="tx-danger">*</span></label>
										<input class="form-control" name="name" placeholder="إدخل الأســـم" required type="text" value="{{$client->name}}">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label class="form-label" for="email">الإيميل : <span class="tx-danger">*</span></label>
										<input class="form-control" name="email" placeholder="إدخل الإيميل"  required type="email" value="{{$client->email}}">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group mg-b-0">
										<label class="form-label" for="phone">التلفون : <span class="tx-danger">*</span></label>
										<input class="form-control" name="phone" placeholder="إدخل التلفون" required type="tel" value="{{$client->phone}}">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label class="form-label" for="balance">الرصيد : </label>
										<input class="form-control" name="balance" placeholder="إدخل الرصيد"  type="number" value="{{$client->balance}}">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label class="form-label" for="address">العنوان : </label>
										<textarea class="form-control" placeholder="يرجى إدخال عنوان العميل بالتفصيل"  rows="5" name="address">{{$client->address}}</textarea>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label class="form-label" for="country">البلد : </label>
										<input class="form-control" name="country" placeholder="إدخل البلد" type="text" value="{{$client->country}}">
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label class="form-label" for="city">المدينة :</label>
										<input class="form-control" name="city" placeholder="إدخل المدينة" type="text" value="{{$client->city}}">
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label class="form-label" for="state">المحافظة :</label>
										<input class="form-control" name="state" placeholder="إدخل المحافظة" type="text" value="{{$client->state}}">
									</div>
								</div>
								<div class="col-12"><button class="btn btn-main-primary pd-x-20 mg-t-10" type="submit">تعديل</button></div>
							</div>
						</form>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection