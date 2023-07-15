@extends('parentAdmin')
@section('style')
    <style>
        .style-delete {
            background-color: transparent;
            border: 0;
            color: #FF0000;
        }
        .style-del_edi {
            display: flex;
            flex-direction: row;
            gap: 5px;
            color: 007bff;

        }
    </style>
@endsection
@section('content2')
<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Orders Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning" >
                        <h3 class="card-title">Data Of Orders</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>title</th>
                                    <th>message</th>
                                    <th>order type</th>
                                    <th>student_university_id</th>
                                    <th>student_name</th>
                                    <th>student_email</th>
                                    <th>urgent</th>
                                    <th>Response</th>
                                    <th>status</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item) {{-- لفلي على الاريي وحط كل صف في متغير الايتم --}}
                                <tr>
                                    <td >            {{-- getting the positon  (index) of an object in foreach --}}
                                        @if ($item->id)
                                        <span style="color: rebeccapurple">{{$loop->index + 1}}</span>
                                        @endif
                                    </td>
                                    <td><img class="img-circle img-bordered-sm" height="50px" width="50px"
                                        src="{{Storage::url($item->image)}}" alt="user image"></td>
        {{-- php artisan storage:link ==> او لازم اخليه مكشوف في الببلك.. عمل شورت كت لملف الببلك اللي جوا الستورج --}}
                                    <td>{{$item->title}}</td>
                                    <td>
                                        @if  ( !is_null( $item->message))
                                            <span style="font-weight:700" >{{$item->message}}</span>
                                        @else
                                            <span style=" color: red;font-weight:700" >no Address</span>
                                         @endif
                                    </td>
                                    <td>
                                        {{$item->order}}
                                    </td>
                                    <td>{{$item->student_university_id}}</td>
                                    <td>{{$item->student_name}}</td>
                                    <td>{{$item->student_email}}</td>

                                    <td>
                                            {{$item->urgent}}
                                    </td>
                                    <td>
                                            {{$item->response}}
                                    </td>
                                    <td>
                                            {{$item->status}}
                                    </td>
                                    <td class="style-del_edi"> {{-- يعني انا بدي اياه يوديني على الواجهة الفلانية ويحولي شوية بيانات للواجهة بغرض استعمالها --}}
                                        <a  href="{{ route('response.edit' , $item->id) }}"><button class="btn-warning">Respons</button></a>

                                        <form method="POST" action="{{route('orders.destroy', $item->id )}}">
                                            @csrf
                                            @method('DELETE')
                                            <button  onclick="return confirm('Are you sure you want to delete this item?');" class="style-delete" type="submit">delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
