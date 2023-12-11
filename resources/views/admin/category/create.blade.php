<style>
    .content {
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
    }

    .modal-body .row {
        display: flex;
        flex-wrap: wrap;
    }

    .modal-body .row>div {
        margin-top: 10px;
    }
</style>
<div class="modal fade tambah" tabindex="-1" id="tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <form action="" method="POST" id="submit">
                @csrf
                <div class="modal-body pt-5">
                    <div class="form-group">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="nim">Category</label>
                        <input type="text" name="category" class="form-control " placeholder="Input Category"
                            value="{{ old('category') }}">
                        <span class="text-danger error-message category""></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger submit" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#tambah").on('hide.bs.modal', function() {
        alert('The modal is about to be hidden!');
    });
    $('#submit').on('submit', function(e) {
        e.preventDefault()
        $('.text-danger').html('')
        // $('.submit-create').attr('disabled', true);
        let url = "{{ route('admin.category.store') }}"

        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                $('.text-danger').html('')
                toastr.options.timeOut = 1000;
                toastr.success(data.message);
                window.location = "{{ route('admin.category.index') }}"
                // return true;
            },
            error: function(err) {
                if (err.status == 422) {
                    var keys = Object.keys(err.responseJSON.errors);
                    keys.forEach(function(val, key) {
                        console.log(val);
                        $(`[class*="text-danger error-message ${val}"]`).text(err
                            .responseJSON.errors[val])
                    });
                    toastr["error"](err.responseJSON.message);
                    $(".submit").attr("disabled", false);
                }
                if (err.status == 500) {
                    toastr["error"](err.responseJSON.message);
                    $(".submit").attr("disabled", false);
                }
                if (err.status == 403) {
                    toastr["error"](err.responseJSON.message);
                    $(".submit").attr("disabled", false);
                }


            }
        });
    });
</script>
