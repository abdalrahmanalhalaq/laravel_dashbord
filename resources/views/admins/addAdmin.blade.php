@extends('parentAdmin')

@section('content2')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">add admin</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
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
                                <label for="name">name</label>
                                <input type="name" class="form-control" name="name" id="name"
                                value="{{old('name')}}"    placeholder="Enter name">
                            </div>  {{--  عدم حذف البيانات المرسلة من الانبوت في حال حدوث خطأ ,,- {{old('password')}} --}}

                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                value="{{old('email')}}"    placeholder="email">
                            </div>
                            <div class="form-group">
                                <label for="image">image input</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input"  name="image">
                                    <label class="custom-file-label" for="image">Choose image</label>
                                  </div>
                                </div>
                              </div>

                            <div class="form-group">
                                <label for="password">create your password</label>
                                <input type="password" class="form-control" name="password"
                                value="{{old('password')}}"    placeholder="password">
                            </div>

                            <div class="form-group">
                                <label>Administrator</label>
                                    <select class="custom-select" name="administrator" id="administrator">
                                          <option value="Yes">Yes</option>
                                          <option value="No">No</option>
                                    </select>
                              </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Add New Admin</button>
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
    <script>
        <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    </script>
    <script>
        $(function () {
          bsCustomFileInput.init();
        });
        </script>
@endsection
