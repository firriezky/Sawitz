@extends('layouts.template')

@section('head')
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection

@section('script')

    <script>
        // This will create a single gallery from all elements that have class "gallery-item"

    </script>



    <script>
        $(document).ready(function () {

            $('#datatables').DataTable({
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var select = $(
                            '<select class="form-control"><option value=""></option></select>'
                        )
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });

            $('#image_preview').magnificPopup({
                delegate: 'a',
                type: 'image',
                removalDelay: 300,
                gallery:{
                    enabled:true,
                },
                mainClass: 'mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                    opener: function(openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                }
            });


            $("#selectuser").select2({
                width: '100%',
                maximumSelectionLength: 1,
                placeholder: {
                    id: 'null', // the value of the option
                    text: 'Ketik Nama User Untuk Mencari'
                }
            });

            $('form').ajaxForm(function () {
                alert("Uploaded SuccessFully");
            });

        });

    </script>
@endsection

@section('main')



    <div class="container">
        <div class="panel-header">
            <div class="page-inner border-bottom pb-0 mb-3">
                <div class="d-flex align-items-left flex-column">
                    <h4 class="card-title">Request Penjualan Masuk</h4>
                    <div class="nav-scroller d-flex">
                        <div class="nav nav-line nav-color-info d-flex align-items-center justify-contents-center">
                            <a class="nav-link active" href="#">Manage Pengguna</a>
                        </div>
                        <div class="d-flex d-md-inline ml-md-auto py-2 py-md-0">

                            <a href="#" class="btn btn-info btn-border btn-round" data-toggle="modal"
                               data-target="#addUser"> <span class="btn-label"> <i
                                        class="fa fa-plus"></i></span> Tambah Permintaan Jual
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-chart-pie text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Total Request</p>
                                        <h4 class="card-title">{{$userCount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-coins text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Request Selesai</p>
                                        <h4 class="card-title">{{$userAdmin}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-error text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Order Dibatalkan</p>
                                        <h4 class="card-title">{{$userStaff}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-error text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Sedang Diproses</p>
                                        <h4 class="card-title">{{$userStaff}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-error text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Sedang Diproses</p>
                                        <h4 class="card-title">{{$userStaff}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-twitter text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Customer</p>
                                        <h4 class="card-title">{{$userCust}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if ($errors->any())

                <div class="alert alert-primary alert-dismissible fade show mx-2 my-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <script>
                            toastr.error('{{ session('success') }}', '{{ session('error ') }}');
                        </script>
                        <li>{{ $error }}</li>
                    @endforeach
                </div>

            @endif
            <div>

                @if(session() -> has('success'))
                    <div class="alert alert-primary alert-dismissible fade show mx-2 my-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{Session::get( 'success' )}}</strong>
                    </div>

                @elseif(session() -> has('error'))

                    <div class="alert alert-primary alert-dismissible fade show mx-2 my-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{Session::get( 'error' )}}</strong>
                    </div>

                @endif
            </div>


        </div>

        <div class="container">


            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h4 class="card-title">Daftar Pengguna</h4>
                    <table id="datatables" class="table table-responsive">
                        <thead class="thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Foto</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($user as $item)

                            @php
                                $roleText="";
                                if ($item->role==1) {
                                    $roleText="Admin";
                                }
                                if ($item->role==2) {
                                    $roleText="Staff";
                                }
                                if ($item->role==3) {
                                    $roleText="User";
                                }
                            @endphp

                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $roleText}}</td>
                                <td>{{ $item->contact }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->date_birth }}</td>
                                <td>{{ $item->profile_url }}</td>
                            </tr>
                        @empty
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Belum Ada Pengguna</strong>
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h4 class="card-title">Daftar Pengguna</h4>
                    <table id="datatables" class="table table-responsive">
                        <thead class="thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Foto</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($user as $item)

                            @php
                                $roleText="";
                                if ($item->role==1) {
                                    $roleText="Admin";
                                }
                                if ($item->role==2) {
                                    $roleText="Staff";
                                }
                                if ($item->role==3) {
                                    $roleText="User";
                                }
                            @endphp

                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $roleText}}</td>
                                <td>{{ $item->contact }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->date_birth }}</td>
                                <td>{{ $item->profile_url }}</td>
                            </tr>
                        @empty
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Belum Ada Pengguna</strong>
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <script>
            //message with toastr
            @if(session()-> has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
            @elseif(session()-> has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
            @endif
        </script>


        <!-- Modal Add Request Sell-->
        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Permintaan Jual</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('user/register')}}" method="post">
                            @csrf
                            <input type="hidden" name="redirectTo" value="admin/sell-request/manage">
                            <div class="form-group">
                                <label for="">Pembeli</label>
                                <div class="select2-input">
                                    <select id="selectuser" name="user" class="form-control" multiple="multiple">
                                        @forelse ($user as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <form action="upload.php" class="dropzone">
                                <div class="fallback">
                                    <input id="upload_file" name="upload_file[]" type="file"
                                           onchange="previewImage();"
                                           multiple/>
                                </div>
                            </form>

                            <button type="button" name="" id="" class="btn btn-primary btn-lg btn-block"
                                    onclick="clearPreview('image_preview');"
                            >Test</button>

                            <div id="image_preview" class="row">

                            </div>


                            <script>

                                const clearPreview = (elementID) =>{
                                    let div = document.getElementById(elementID);
                                    while(div.firstChild) {
                                        div.removeChild(div.firstChild);
                                    }
                                    document.getElementById("upload_file").innerHTML="";
                                    alert('Testing');
                                }

                                const previewImage = () =>{
                                    let total_file = document.getElementById("upload_file").files.length;
                                    for (var i = 0; i < total_file; i++) {
                                        $('#image_preview').append(
                                            "<a href='" + URL.createObjectURL(event.target.files[i]) + "' class='col-6 col-md-3 mb-4'>"
                                            +"<img src='" + URL.createObjectURL(event.target.files[i]) + "' class='img-fluid'></a>");
                                    }
                                }
                            </script>



                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

@endsection
