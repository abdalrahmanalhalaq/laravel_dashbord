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
                    <form method="POST" action="{{ route('response.update'  , $order->id) }}">
                        @method('put')
                        @csrf

                        <div class="card-body">

                            <div class="form-group">
                                <label for="Response">Response</label>
                                <textarea type="" class="form-control" name="Response" id="Response"
                                value="{{old('Response')}}"    placeholder="Enter Response" ></textarea>
                            </div>  {{--  عدم حذف البيانات المرسلة من الانبوت في حال حدوث خطأ ,,- {{old('password')}} --}}
                            <div class="form-group">
                                <label>select your type Status</label>
                                <select class="custom-select" name="status" id="status">
                                          <option value="closed" >Closed</option>
                                          <option value="Open">Open</option>
                                    </select>
                              </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Submit</button>
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
