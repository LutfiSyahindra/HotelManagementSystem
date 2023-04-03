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
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kamar</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Kamar</h6>
                    <button type="button" class="btn btn-primary btn-icon-text" style="margin-bottom: 10px"
                        data-bs-toggle="modal" id="createNewRoom" data-bs-target="#ajaxModal">
                        <i class="btn-icon-prepend" data-feather="file-plus"></i>
                        Tambah Data
                    </button>
                    <div class="table-responsive">
                        <table id="dataTable" class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Room</th>
                                    {{-- <th>Image</th>
                                    <th>Description</th> --}}
                                    <th>Price</th>
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
                    <form id="roomForm" name="roomForm" class="form-sample">
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-3">
                            <label for="room" class="col-sm-3 col-form-label">Room</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="room" name="room"
                                    placeholder="Enter Room">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="deskripsi" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Enter Description">
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="harga" class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="harga" name="harga"
                                    placeholder="Enter Price">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 control-label" for="img">Image</label>
                            <div class="col-md-9">
                                <div id="gambar">
                                    <input type="file" id="img" name="img" class="form-control"
                                        placeholder="Masukkan Foto Profil Pelatih">
                                </div>
                                <img id="image_preview" src="" style="margin-top: 1px" height="250px" width="250px"
                                    alt="">
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
            ajax: "{{ route('room.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'room',
                    name: 'room'
                },
                // {
                //     data: 'img',
                //     name: 'img'
                // },
                // {
                //     data: 'deskripsi',
                //     name: 'deskripsi'
                // },
                {
                    data: 'harga',
                    name: 'harga'
                },
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
        // Create New Pelanggan.
        $('#createNewRoom').click(function() {
            document.getElementById('button').style.visibility = '';
            document.getElementById('gambar').style.visibility = '';

            $('#saveBtn').val("create-pelatih");
            // $('#pelatih_id').val('');
            $('#roomForm').trigger("reset");
            $('#modelHeading').html("TAMBAH DATA ROOM BARU");
            $('#image_preview').attr('src', '');
            $('#ajaxModel').modal('show');
            $('#id').attr('disabled', false).val('');
            $('#room').attr('disabled', false);
            $('#deskripsi').attr('disabled', false);
            $('#harga').attr('disabled', false);

        });
        $('#img').change(function() {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

            // var img_path = $(this)[0].result;

            // var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCaser();

            // alert(extension)
        })
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');
            var img = document.getElementById('img');
            var room = $('#room').val();
            var deskripsi = $('#deskripsi').val();
            var harga = $('#harga').val();
            var id = $('#id').val();

            var formData = new FormData();
            formData.append('img', img.files[0]);
            formData.append('room', room);
            formData.append('deskripsi', deskripsi);
            formData.append('harga', harga);
            formData.append('id', id);
            $.ajax({
                url: "{{ route('room.store') }}",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                type: "POST",
                // data: $('#supplierForm').serialize(),
                success: function(response) {
                    console.log(response)
                    if (response.errors) {
                        $('.alert-danger').html('');
                        $.each(response.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append(
                                '<li>' + value +
                                '</li>');
                        });
                        $('#saveBtn').html('SIMPAN');
                    } else {
                        $('.alert-danger').hide();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });

                        Toast.fire({
                            icon: 'success',
                            title: 'Success Add Data'
                        })
                        $('#roomForm').trigger("reset");
                        $('#saveBtn').html('SIMPAN');
                        $('#ajaxModal').modal('hide');
                        table.draw();
                        $('#image_preview').attr('src', '');
                    }
                }
            });
        });
        // Edit Data Room
        $('body').on('click', '.edit-room', function() {
            document.getElementById('gambar').style.visibility = '';
            document.getElementById('button').style.visibility = '';
            var id = $(this).data('id');
            $.get("{{ route('room.index') }}" + '/' + id + '/edit', function(
                data) {
                $('#modelHeading').html("EDIT DATA ROOM");
                $('#saveBtn').val("edit-room");
                $('#ajaxModal').modal('show');
                $('#id').val(data.id).attr('disabled', false);
                $('#room').val(data.room).attr('disabled', false);
                $('#deskripsi').val(data.deskripsi).attr('disabled', false);
                $('#harga').val(data.harga).attr('disabled', false);
                if (data.img) {
                    var url = `backend/assets/images/room/${data.img}`;
                    $('#image_preview').attr('src', url);
                    // $("#avatar").html(
                    //     `<img src="storage/uploads/img/${data.img_pelatih}" width="100" class="img-fluid img-thumbnail">`
                    // );
                    console.log(data);
                }
            })
        });
        // Detail Data Room
        $('body').on('click', '.show-room', function() {
            document.getElementById('gambar').style.visibility = 'hidden';
            document.getElementById('button').style.visibility = 'hidden';
            var id = $(this).data('id');
            $.get("{{ route('room.index') }}" + '/' + id + '/edit', function(
                data) {
                $('#modelHeading').html("DETAIL DATA ROOM");
                $('#ajaxModal').modal('show');
                $('#id').val(data.id);
                $('#room').val(data.room).attr('disabled', true);
                $('#deskripsi').val(data.deskripsi).attr('disabled', true);
                $('#harga').val(data.harga).
                attr('disabled', true);
                if (data.img) {
                    var url = `backend/assets/images/room/${data.img}`;
                    $('#image_preview').attr('src', url);
                    // $("#avatar").html(
                    //     `<img src="storage/uploads/img/${data.img_pelatih}" width="100" class="img-fluid img-thumbnail">`
                    // );
                    console.log(data);
                }
            })
        });

        // Arsipkan Data
        $('body').on('click', '#delete-room', function() {
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
                            url: 'room/' + id,
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
