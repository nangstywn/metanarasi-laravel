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
                <h5 class="modal-title">Add Tag</h5>
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
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="nim">Tag</label>
                        <input type="text" name="tag" class="form-control " placeholder="Input Tag"
                            id="name" value="{{ old('tag') }}">
                        <span class="text-danger fs-15 ps-2" id="tagError"></span>
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
    $(function() { // let all dom elements are loaded
        $('.tambah').on('hide.bs.modal', function(e) {
            $("#tagError").hide()
        });
    });
</script>
