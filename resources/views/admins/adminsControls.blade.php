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
              <h1 class="m-0">Admins Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">admins page</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div style="background-color:#29534e ;color:white;" class="card-header " >
                        <h3 class="card-title">Data Of Admins</h3>

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
                                <tr >
                                    <th>ID</th>
                                    <th>image</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>role</th>

                                    <th>Actins</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Admin as $item) {{-- لفلي على الاريي وحط كل صف في متغير الايتم --}}
                                <tr >
                                    <td >            {{-- getting the positon  (index) of an object in foreach --}}
                                        @if ($item->id)
                                        <span style="color: rebeccapurple">{{$loop->index + 1}}</span>
                                        @endif
                                    </td>
                                    <td><img class="img-circle img-bordered-sm" height="50px" width="50px"
                                        src="{{Storage::url($item->image)}}" alt="user image"></td>
        {{-- php artisan storage:link ==> او لازم اخليه مكشوف في الببلك.. عمل شورت كت لملف الببلك اللي جوا الستورج --}}
                                    <td>{{$item->name}}</td>
                                    <td>
                                        @if  ( !is_null( $item->email))
                                            <span style="font-weight:700" >{{$item->email}}</span>
                                        @else
                                            <span style=" color: red;font-weight:700" >no email</span>
                                         @endif
                                    </td>
                                    <td>
                                        @if  ( $item->administrator == 'Yes')
                                            <span style="font-weight:700 ; color: rgb(255, 34, 34);" >Administrator</span>
                                        @else
                                            <span style=" color: rgb(47, 89, 255);font-weight:700" >Admin</span>
                                         @endif
                                    </td>

                                 @if (  auth('admin')->user()->administrator   == 'Yes' )

                                    <td class="style-del_edi"> {{-- يعني انا بدي اياه يوديني على الواجهة الفلانية ويحولي شوية بيانات للواجهة بغرض استعمالها --}}

                                            <a class="btn btn-primary" href="{{ route('admins.edit' , $item->id) }}">edit</a>

                                            <form method="POST" action="{{route('admins.destroy', $item->id )}}">
                                                @csrf
                                                @method('DELETE')
                                                <button  onclick="return confirm('Are you sure you want to delete this item?');" class=" btn btn-warning" type="submit">delete</button>
                                            </form>

                                    </td>




                                    @elseif ( $item->email == auth('admin')->user()->email)
                                        <td    style="background-color: rgba(67, 64, 64, 0.144)" class="style-del_edi"> {{-- يعني انا بدي اياه يوديني على الواجهة الفلانية ويحولي شوية بيانات للواجهة بغرض استعمالها --}}

                                           <a class="btn btn-primary" href="{{ route('admins.edit' , $item->id) }}" >edit</a> <small style="text-align:center;line-height: 3">you</small>

                                        </td>
                                    @endif
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
