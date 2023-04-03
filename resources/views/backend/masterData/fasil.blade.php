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
            <li class="breadcrumb-item active" aria-current="page">Fasilitas</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Fasilitas</h6>
                    <button type="button" class="btn btn-primary btn-icon-text" style="margin-bottom: 10px"
                        data-bs-toggle="modal" id="createNewFasilitas" data-bs-target="#ajaxModal">
                        <i class="btn-icon-prepend" data-feather="file-plus"></i>
                        Tambah Data
                    </button>
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Fasilitas</th>
                                    {{-- <th>Deskripsi</th>
                                    <th>Gambar</th> --}}
                                    <th>Harga</th>
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
    <div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
                            <label for="fasilitas" class="col-sm-3 col-form-label">Fasilitas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fasilitas" name="fasilitas"
                                    placeholder="Enter fasilitas">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ket" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="ket" name="ket"
                                placeholder="Enter Deskripsi">
                                </textarea>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                        <label for="img" class="col-sm-3 col-form-label">Gambar</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="img" name="img"
                                placeholder="Enter Image">
                        </div>
                    </div> --}}
                        <div class="row mb-3">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="harga" name="harga"
                                    placeholder="Enter Harga">
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
            ajax: "{{ route('service.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'fasilitas',
                    name: 'fasilitas'
                },
                {
                    data: 'ket',
                    name: 'ket'
                },
                {
                    data: 'img',
                    name: 'img'
                },
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
        $('#createNewFasilitas').click(function() {
            $('#saveBtn').val("create-pelatih");
            // $('#pelatih_id').val('');
            $('#roomForm').trigger("reset");
            $('#modelHeading').html("TAMBAH DATA FASILITAS BARU");
            $('#ajaxModel').modal('show');
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
            var fasilitas = $('#fasilitas').val();
            var ket = $('#ket').val();
            var harga = $('#harga').val();
            var id = $('#id').val();

            var formData = new FormData();
            formData.append('img', img.files[0]);
            formData.append('fasilitas', fasilitas);
            formData.append('ket', ket);
            formData.append('harga', harga);
            formData.append('id', id);;
            $.ajax({
                url: "{{ route('service.store') }}",
                // method: 'post',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                type: "POST",
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
                        $('#fasilitasForm').trigger("reset");
                        $('#saveBtn').html('SIMPAN');
                        $('#ajaxModal').modal('hide');
                        table.draw();
                    }
                }
            });
        });
        // Edit Data Fasilitas
        $('body').on('click', '.edit-fasilitas', function() {
            document.getElementById('gambar').style.visibility = '';
            document.getElementById('button').style.visibility = '';
            var id = $(this).data('id');
            $.get("{{ route('service.index') }}" + '/' + id + '/edit', function(
                data) {
                $('#modelHeading').html("EDIT DATA FASILITAS");
                $('#saveBtn').val("edit-fasilitas");
                $('#ajaxModal').modal('show');
                $('#id').val(data.id).attr('disabled',false);
                $('#fasilitas').val(data.fasilitas).attr('disabled',false);
                $('#ket').val(data.ket).attr('disabled',false);
                $('#harga').val(data.harga).attr('disabled',false);
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
        // Detail Data Fasilitas
        $('body').on('click', '.detail-fasilitas', function() {
            document.getElementById('gambar').style.visibility = 'hidden';
            document.getElementById('button').style.visibility = 'hidden';
            var id = $(this).data('id');
            $.get("{{ route('service.index') }}" + '/' + id + '/edit', function(
                data) {
                $('#modelHeading').html("DETAIL DATA FASILITAS");
                $('#ajaxModal').modal('show');
                $('#id').val(data.id);
                $('#fasilitas').val(data.fasilitas).attr('disabled',true);
                $('#ket').val(data.ket).attr('disabled',true);
                $('#harga').val(data.harga).attr('disabled',true);
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
        $('body').on('click', '#delete-fasilitas', function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-2'
                },
                buttonsStyling: false,
            })
            if()            
            swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'me-2',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                })
                .then((result) => {
                    if (result.value) {
                        var id = $(this).data("id");
                        $.ajax({
                            type: "DELETE",
                            url: 'service/' + id,
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
