<script>
    $(".select2_search_tags").select2({
        dir: 'rtl',
        language: 'fa',
        theme: 'bootstrap',
        minimumInputLength: 2,
        ajax: {
            url: baseUrl + '/panel/ajax/search/tags',
            dataType: 'json'
        }
    });
</script>
