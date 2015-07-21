<script type="text/javascript">
    var baseUrl = '{{ Request::getBaseUrl() }}';
    var pageUrl = '{{ Request::url() }}';
    window.isLoggedIn = '{{ Auth::check() }}';
</script>