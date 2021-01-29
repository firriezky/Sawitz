@extends('layouts.template')


@section('script')

    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});
            $('#datatables').DataTable({
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });
        });

    </script>
@endsection

@section('main')

<!-- Modal Add User-->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{url('user/register')}}" method="post">
                    @csrf
                    <input type="hidden" name="redirectTo" value="admin/user/manage">
                    <div class="form-group">
                      <label for="">Nama Pengguna : </label>
                      <input type="text" placeholder="Nama Pengguna" value="{{old('nama_pengguna')}}"
                        class="form-control @error('nama_pengguna') is-invalid   @enderror"
                        name="nama_pengguna" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted"></small>
                    </div>

                   <div class="form-group">
                     <label for="">Jenis Kelamin</label>
                     <select class="form-control" name="gender" id="">
                       <option value="1">Laki-Laki</option>
                       <option value="2">Perempuan</option>
                     </select>
                   </div>

                   <div class="form-group">
                    <label for="">Email Pengguna : </label>
                    <input type="email" placeholder="Email Pengguna" value="{{old('email')}}"
                      class="form-control @error('email') is-invalid   @enderror"
                      name="email" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted"></small>
                  </div>

                  <div class="form-group">
                    <label for="">Tanggal Lahir : </label>
                    <input type="date"
                      class="form-control @error('tanggal_lahir') is-invalid   @enderror"
                      name="tanggal_lahir" id="" aria-describedby="helpId" value="{{old('tanggal_lahir')}}" >
                  </div>

                  <div class="form-group">
                    <label for="">Kontak Pengguna : </label>
                    <input type="text" placeholder="Kontak Pengguna" value="{{old('contact')}}"
                      class="form-control @error('contact') is-invalid   @enderror"
                      name="contact" id="" aria-describedby="helpId" >
                    <small id="helpId" class="form-text text-muted"></small>
                  </div>

                  <div class="form-group">
                    <label for="">Tipe Pengguna</label>
                    <select class="form-control" name="role" id="">
                      <option value="3">Customer</option>
                      <option value="1">Admin</option>
                      <option value="3">Staff</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="">Status</label>
                    <select class="form-control" name="status" id="">
                      <option value="1">Aktif</option>
                      <option value="2">Suspended</option>
                      <option value="3">Blokir</option>
                    </select>
                  </div>



                  <div class="form-group">
                    <label for="">Password Akun</label>
                    <input type="text"
                    class="form-control @error('password') is-invalid @enderror" name="password" id="" placeholder="Password Akun">
                  </div>


                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

    <div class="container">




        <div class="panel-header">
            <div class="page-inner border-bottom pb-0 mb-3">
                <div class="d-flex align-items-left flex-column">
                    <h2 class="pb-2 fw-bold">Manage User</h2>
                    <div class="nav-scroller d-flex">
                        <div class="nav nav-line nav-color-info d-flex align-items-center justify-contents-center">
                            <a class="nav-link active" href="#">Manage Pengguna</a>
                        </div>
                        <div class="d-flex d-md-inline ml-md-auto py-2 py-md-0">

                            <a href="#" class="btn btn-info btn-border btn-round" data-toggle="modal" data-target="#addUser"> <span class="btn-label"> <i
                                        class="fa fa-plus"></i></span> Tambah Pengguna Baru</a>
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
                                        <p class="card-category">UserCount</p>
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
                                        <p class="card-category">Admin</p>
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
                                        <p class="card-category">Staff</p>
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
        </div>


<script>
    //message with toastr
    @if(session()-> has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif(session()-> has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
    </script>

    @endsection
