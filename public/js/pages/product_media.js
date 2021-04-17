<script>
    jQuery(document).ready(function () {
    var [{!!$type!!}]=jQuery('input[name="{!!$type!!}"]').fileuploader();
    window["{!!$type!!}_api"] = jQuery.fileuploader.getInstance({!!$type!!});});
</script>
