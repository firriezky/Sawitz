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

                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner">
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
                    <h4 class="card-title">Manage Harga</h4>
                    <a href="#" class="btn btn-info btn-border btn-round m-3" data-toggle="modal"
                    data-target="#addUser"> <span class="btn-label"> <i
                             class="fa fa-plus"></i></span> Input Harga Baru
                    </a>

                    <table id="datatables" class="table table-responsive">
                        <thead class="thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>Harga CPO</th>
                            <th>Margin</th>
                            <th>Dibuat Pada Tanggal</th>
                            <th>Diupdate Pada</th>
                        </tr>
                        </thead>
                        <tbody>

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Belum Ada Pengguna</strong>
                            </div>
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
                        <h5 class="modal-title">Tambah Harga Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

@endsection
