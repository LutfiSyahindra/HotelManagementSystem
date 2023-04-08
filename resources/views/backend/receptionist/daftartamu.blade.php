@extends('backend.layout.main')
@push('style-alt')
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
<!-- End plugin css for this page -->
@endpush
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Receptionist</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Tamu</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Daftar Tamu</h6>
                {{-- <button type="button" class="btn btn-primary btn-icon-text" style="margin-bottom: 10px"
                    data-bs-toggle="modal" id="createNewRoom" data-bs-target="#ajaxModal">
                    <i class="btn-icon-prepend" data-feather="file-plus"></i>
                    Tambah Data
                </button> --}}
                <div class="table-responsive">
                    <table id="dataTable" class="table" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Tamu</th>
                                {{-- <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>No-Tlp</th> --}}
                                <th>Kamar</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                {{-- <th>Total Harga</th> --}}
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert" style="display: none;"></div>
                <form id="fasilitasForm" name="fasilitasForm" class="form-sample">
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3">
                        <label for="fasilitas" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter fasilitas">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ket" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="nik" name="nik"
                                placeholder="Enter Description">
                                </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ket" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="jk" name="jk"
                                placeholder="Enter Description">
                                </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter Price">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-3 control-label" for="img">Image</label>
                        <div class="col-md-9">
                            <div id="gambar">
                                <input type="file" id="img" name="img" class="form-control"
                                    placeholder="Masukkan Foto Profil Pelatih">
                            </div>
                            <img id="image_preview" src="" style="margin-top: 1px" height="250px" width="250px" alt="">
                        </div>
                    </div>
                    <div class="modal-footer" id="button">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="saveBtn" value="create" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
@push('script-alt')
<!-- Plugin js for this page -->
<script src="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- End plugin js for this page -->

<!-- Plugin js for this page -->
<script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
<!-- End custom js for this page -->

<!-- Custom js for this page -->
<script src="{{ asset('backend/assets/js/sweet-alert.js') }}"></script>
<!-- End custom js for this page -->
@endpush

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Rendering Table

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('daftartamu.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'Nama Tamu',
                    name: 'Nama Tamu'
                },
                // {
                //     data: 'NIK',
                //     name: 'NIK'
                // },
                // {
                //     data: 'Jenis Kelamin',
                //     name: 'Jenis Kelamin'
                // },
                // {
                //     data: 'No-Telp',
                //     name: 'No-Telp'
                // },
                {
                    data: 'kamar',
                    name: 'kamar'
                },
                {
                    data: 'Check-in',
                    name: 'Check-in'
                },
                {
                    data: 'Check-out',
                    name: 'Check-out'
                },
                // {
                //     data: 'harga',
                //     name: 'harga'
                // },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
       
       $('body').on('click', '.edit-tamu', function() {
        // document.getElementById('pass').style.visibility = 'hidden';
        var id = $(this).data('id');
        $.get("{{ route('daftartamu.index') }}" + '/' + id + '/edit', function(
        data) {
        console.log(data)
        $('#modelHeading').html("EDIT DATA KARYAWAN");
        $('#saveBtn').val("edit-user");
        $('#ajaxModal').modal('show');
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#password').val(data.password);
        $('#role').val(data.roles);
        })
        });

        // Arsipkan Data
       // Arsipkan Data
        $('body').on('click', '#delete-tamu', function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-2'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'me-2',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                })
                .then((result) => {
                    if (result.value) {
                        var id = $(this).data("id");
                        $.ajax({
                            type: "DELETE",
                            url: 'daftartamu/' + id,
                            data: id,
                            success: function(response) {
                                swalWithBootstrapButtons.fire(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        table.draw();
                                    });
                            }
                        });
                    } else {
                        Swal.fire("Cancel!", "Perintah dibatalkan!", "error");
                    }
                });
        });
    });
</script>