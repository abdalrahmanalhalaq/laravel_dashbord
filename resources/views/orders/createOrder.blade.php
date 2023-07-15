@extends('parent')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">add your order</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                    {{--form-data => تسمح بأن يكون الفاليو فايل او تكست--}}
                    {{-- url_incoded => تسمح بأن يكون الفاليو تكست--}}
                        @csrf
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> validation errors</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                              </div>
                            @endif
                            <div class="form-group">
                                <label for="title">title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                value="{{old('title')}}"    placeholder="Enter title">
                            </div>  {{--  عدم حذف البيانات المرسلة من الانبوت في حال حدوث خطأ ,,- {{old('password')}} --}}

                            <div class="form-group">
                                <label for="message">message</label>
                                <input type="message" class="form-control" name="message" id="message"
                                value="{{old('message')}}"    placeholder="message">
                            </div>
                            <div class="form-group">
                                <label>select your type order</label>
                                    <select class="custom-select" name="order" id="order">
                                          <option value="Complaint" >Complaint</option>
                                          <option value="Suggestion">Suggestion</option>
                                    </select>
                              </div>
                            <div class="form-group">
                                <label for="student_university_id">student university number</label>
                                <input type="number" class="form-control" name="student_university_id"
                                value="{{old('student_university_id')}}"    placeholder="student_university_id">
                            </div>
                            <div class="form-group">
                                <label for="student_name">student_name</label>
                                <input type="student_name" class="form-control" name="student_name"
                                value="{{old(' student_name')}}"    placeholder=" student_name">
                            </div>
                            <div class="form-group">
                                <label for="student_email">student_email</label>
                                <input type="email" class="form-control" name="student_email"
                                value="{{old('student_email')}}"    placeholder="student_email">
                            </div>
                            <div class="form-group">
                                <label for="image">File input</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input"  name="image">
                                    <label class="custom-file-label" for="image">Choose image</label>
                                  </div>

                                </div>
                              </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="urgent" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">true or false</label>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Add New Order</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
    <!-- bs-custom-file-input -->
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
          bsCustomFileInput.init();
        });
    </script>
@endsection
