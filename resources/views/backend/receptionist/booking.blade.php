@extends('backend.layout.main')
@push('style-alt')
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/dropzone/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/dropify/dist/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/pickr/themes/classic.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/select2/select2.min.css/') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css/') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/dropzone/dropzone.min.css/') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/dropify/dist/dropify.min.css/') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/pickr/themes/classic.min.css/') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/font-awesome/css/font-awesome.min.css/') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.css/') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
<!-- End plugin css for this page -->

@endpush
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Receptionist</a></li>
        <li class="breadcrumb-item active" aria-current="page">Booking</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form id="gusetForm" name="guestForm" class="form-sample">
                    @csrf
                    <h6 class="card-title">Guest Booking</h6>
                    <p class="text-muted mb-3">Read the <a href="https://github.com/RobinHerbots/Inputmask"
                            target="_blank">
                            Official Inputmask Documentation </a>for a full list of instructions and other options.</p>
                    <div class="row mb-3">
                        <input type="hidden" name="id" id="id">
                        <div class="col">
                            <label class="form-label">Room</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" id="room_id" name="room_id"
                                    value="{{ $room->id }}" disabled> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <div class="input-group flatpickr" id="hargar">
                                <input type="number" class="form-control" id="hargarr" name="hargarr"
                                    value="{{$room->harga}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Check-In</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Select date" data-input
                                    id="check_in" name="check_in">
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Check-Out</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Select date" data-input
                                    id="check_out" name="check_out">
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Enter NIK">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">TTL</label>
                            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Enter TTL">
                        </div>
                        <div class="col-md-6">
                            <label for="ageSelect" class="form-label">Gender</label>
                            <select class="form-select" name="jk" id="jk">
                                <option selected disabled>Select your gender</option>
                                <option>Laki-Laki</option>
                                <option>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Telp</label>
                            <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="Enter Phone">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Enter address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Fasilitas Tambahan</label>
                            <select class="js-example-basic-multiple form-control" multiple="multiple" data-width="100%"
                                id="fasilitas_id" name="fasilitas_id[]">
                                @foreach ($fasilitas as $f)
                                <option value="{{ $f->harga }}">{{ $f->fasilitas }} |
                                    Rp.{{ number_format($f->harga)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" onkeyup="sum();" id="coba" name="coba"
                                placeholder="Enter address">
                        </div>
                    </div> --}}
                    <button type="submit" id="saveBtn" value="create" class="btn btn-primary" style="float: right">Add
                        Booking</button>
                </form>
                {{-- @dd(request()->session()->get('gus')) --}}
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
@push('script-alt')
<script src="{{ asset ('backend/assets/vendors/core/core.js') }}"></script>
<!-- Plugin js for this page -->
{{-- <script src="{{ asset('backend/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/typeahead.js') }}/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/dropify/dist/dropify.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/pickr/pickr.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script> --}}
<!-- End plugin js for this page -->

<!-- Plugin js for this page -->
{{-- <script src="{{ asset('backend/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/typeahead.js') }}/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/dropify/dist/dropify.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/pickr/pickr.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script> --}}
<script src="{{ asset ('backend/assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/select2.js') }}"></script>
<!-- End plugin js for this page -->

{{--
<!-- Custom js for this page -->
{{-- <script src="{{ asset('backend/assets/js/form-validation.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('backend/assets/js/inputmask.js') }}"></script>
<script src="{{ asset('backend/assets/js/select2.js') }}"></script>
<script src="{{ asset('backend/assets/js/typeahead.js') }}"></script>
<script src="{{ asset('backend/assets/js/tags-input.js') }}"></script>
<script src="{{ asset('backend/assets/js/dropzone.js') }}"></script>
<script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
<script src="{{ asset('backend/assets/js/pickr.js') }}"></script>
<script src="{{ asset('backend/assets/js/flatpickr.js') }}"></script>
<script src="{{ asset('backend/assets/js/form-validation.js/') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap-maxlength.js/') }}"></script>
<script src="{{ asset('backend/assets/js/inputmask.js/') }}"></script>
<script src="{{ asset('backend/assets/js/typeahead.js/') }}"></script>
<script src="{{ asset('backend/assets/js/tags-input.js/') }}"></script>
<script src="{{ asset('backend/assets/js/dropzone.js/') }}"></script>
<script src="{{ asset('backend/assets/js/dropify.js/') }}"></script>
<script src="{{ asset('backend/assets/js/pickr.js/') }}"></script>
<script src="{{ asset('backend/assets/js/flatpickr.js/') }}"></script> --}}
<!-- End custom js for this page --> --}}


<!-- Custom js for this page -->
<script src="{{ asset('backend/assets/js/sweet-alert.js') }}"></script>
<!-- End custom js for this page -->
@endpush

<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
})
</script>


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Create New Pelanggan.
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');
            var formData = $('#guestForm').serialize();
            $.ajax({
                url: "{{ route('booking.create') }}",
                // method: 'post',
                data: {
                    id: $('#id').val(),
                    room_id: $('#room_id').val(),
                    name: $('#name').val(),
                    nik: $('#nik').val(),
                    ttl: $('#ttl').val(),
                    jk: $('#jk').val(),
                    address: $('#address').val(),
                    no_tlp: $('#no_tlp').val(),
                    check_in: $('#check_in').val(),
                    check_out: $('#check_out').val(),
                    fasilitas_id: $('#fasilitas_id').val(),
                    hargarr: $('#hargarr').val(),
                    email: $('#email').val(),
                },
                // data: $('#supplierForm').serialize(),
                type: "GET",
                dataType: 'json',
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
                        $('#guestForm').trigger("reset");
                        $('#saveBtn').html('SIMPAN');
                          window.location = '{{ url('/trans') }}';
                    }
                }
            });
        });
    });
</script>