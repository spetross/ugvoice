<script type="text/javascript">
    var baseUrl = '<?= Request::getBaseUrl() ?>';
    var pageUrl = '<?= Request::url() ?>'
    var siteName = 'UgVoice';
    var maxPostImage = 8;
    var updateSpeed = 30;
    var isLoggedIn = <?= Auth::check() ? 'true' : 'false' ?>;
</script>