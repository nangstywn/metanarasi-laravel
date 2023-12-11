<script>
    var hostUrl = "{{ asset('assets/admin/') }}";
</script>
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->

<script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/admin/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/modals/upgrade-plan.js') }}"></script>
<!--begin::Page Custom Javascript(modal)-->
<script src="{{ asset('assets/admin/js/custom/modals/new-address.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/modals/upgrade-plan.js') }}"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
