@extends('layouts.master')
@section('title')
	قائمة المصانع
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Font Awesome -->
    <link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <!--Internal  treeview -->
    <link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />
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
            <!-- row -->
            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#add" style="width: 117px;margin-bottom: 9px;">إضافة مصنع</a>
            <div class="row">
                {{-- If there any errors --}}
                @if ($errors->any())
                    @foreach ( $errors->all() as $error )
                        <div id="ui_notifIt" class="error" style="width: 400px; opacity: 1; left: 440px; top: 10px; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
                            <p>{{ $error }}</p> 
                            <span id="close" onclick="this.parentNode.remove(); return false;">x</span>
                        </div>
                    @endforeach
                @endif
                {{-- If There any factory add --}}
                @if (session()->has('Add'))
                    <div id="ui_notifIt" class="success" style="width: 400px; opacity: 1; left: 440px; top: 10px; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
                        <p>{{ session()->get('Add') }}</p> 
                        <span id="close" onclick="this.parentNode.remove(); return false;">x</span>
                    </div>
                @endif

                {{-- If There any factory edit --}}
                @if (session()->has('Edit'))
                    <div id="ui_notifIt" class="success" style="width: 400px; opacity: 1; left: 440px; top: 10px; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
                        <p>{{ session()->get('Edit') }}</p> 
                        <span id="close" onclick="this.parentNode.remove(); return false;">x</span>
                    </div>
                @endif

                {{-- Start Table --}}
                <div class="col-xl-12">
                    <div class="card mg-b-20">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">@yield('title')</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                            <p class="tx-12 tx-gray-500 mb-2">قائمة بجميع المصانع المُنتِجة ...</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-md-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0">المصنع</th>
                                            <th class="border-bottom-0">ملاحظات</th>
                                            <th class="border-bottom-0">أُنشئ بواسطه</th>
                                            <th class="border-bottom-0">العمليات</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i=0?>
                                        @foreach ($factories as $item)
                                            <?php $i++?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td>{{ $item->factory_name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->created_by }}</td>
                                                <td>
                                                    {{-- "Edit" passing factory_name , id , description to js to send them to backend --}}
                                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                        data-id="{{ $item->id }}" data-factory_name="{{ $item->factory_name }}"
                                                        data-description="{{ $item->description }}" data-toggle="modal"
                                                        href="#edit" title="تعديل"><i class="las la-pen"></i></a>

                                                    {{-- "Delet" passing factory_name , id to js to send them to backend --}}
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                        data-id="{{ $item->id }}" data-factory_name="{{ $item->factory_name }}"
                                                        data-toggle="modal" href="#delete" title="حذف"><i
                                                            class="las la-trash"></i></a>
                                                
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
            
            <!-- Modal effects -->
            {{-- Modal for add factory --}}
            <div class="modal" id="add">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">إضافة مصنع</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('factories.store') }}" method="post">
                                {{ csrf_field() }}
        
                                <div class="form-group">
                                    <label for="factory_name">اسم المصنع</label>
                                    <input type="text" class="form-control" id="factory_name" name="factory_name" required>
                                </div>
        
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ملاحظات</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
        
                                <div class="modal-footer">
                                    <button type="submit" class="btn ripple btn-primary">تاكيد</button>
                                    <button type="button" class="btn ripple btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End --}}

            {{-- Modal for Edit factory --}}
            <div class="modal" id="edit">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">إضافة مصنع</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="factories/update" method="POST">
                                {{ method_field('put')}}
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id"> {{-- we must make input hidden for passing id to js and then to FactoryContrllor --}}
                                <div class="form-group">
                                    <label for="factory_name">اسم المصنع</label>
                                    <input type="text" class="form-control" id="factory_name" name="factory_name" required>
                                </div>
        
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ملاحظات</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
        
                                <div class="modal-footer">
                                    <button type="submit" class="btn ripple btn-primary">تاكيد</button>
                                    <button type="button" class="btn ripple btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End --}}

            {{-- Modal for Edit factory --}}
            <div class="modal" id="delete">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">هل انتا منأكد من الحذف ؟</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="factories/destroy" method="POST">
                                {{ method_field('delete')}}
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id"> {{-- we must make input hidden for passing id to js and then to FactoryContrllor --}}
                                <div class="form-group">
                                    {{-- <label for="factory_name">اسم المصنع</label> --}}
                                    <input type="hidden" name="id" id="id" value="">
                                    <input type="text" class="form-control" id="factory_name" name="factory_name" readonly>
                                </div>
        
        
                                <div class="modal-footer">
                                    <button type="submit" class="btn ripple btn-primary">تاكيد</button>
                                    <button type="button" class="btn ripple btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End --}}

            <!-- End Modal effects-->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <!-- Internal Treeview js -->
    <script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

    {{-- Modal In error or adding factoy --}}
    @if (count($errors) > 0)
        <script>
            $( document ).ready(function() {
                $('#modaldemo5').modal('show');
                
            });
        </script>
    @endif
    @if (session()->has('Add'))
        <script>
            $( document ).ready(function() {
                $('#modaldemo4').modal('show');
            });
        </script>
    @endif
    {{-- End Modal --}}

    {{-- sending data to backend --}}
    <script>
        $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var factory_name = button.data('factory_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #factory_name').val(factory_name);
            modal.find('.modal-body #description').val(description);
        })
    </script>
    {{-- sending data to backend --}}
    <script>
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var factory_name = button.data('factory_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #factory_name').val(factory_name);
        })
    </script>
@endsection