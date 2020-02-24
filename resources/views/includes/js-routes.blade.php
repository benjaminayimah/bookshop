<script>
    var token = '{{ Session::token() }}';
    var EditUrl = '{{ route('edit.category') }}';
    var loadSubcat = '{{ route('load.subcat') }}';
    var delURL = '{{ route('del.cat') }}';
    var fetchOpt = '{{ route('fetch.Opt') }}';
    var fetchOpt2 = '{{ route('fetch.sub2') }}';
    var fetchCate = '{{ route('fetch.cate') }}';
    var upLimg = '{{ route('upLimg') }}';
    var delbkURL = '{{ route('delbk.bk') }}';
    var getPreview = '{{ route('get.preview') }}';
    var loadSubcate2 = '{{ route('load.subcate2') }}';
    var editSub1Url = '{{ route('get.editsub1') }}';
    var editSub1Url2 = '{{ route('get.editsub2') }}';
    var delsub1URL = '{{ route('del.sub1') }}';
    var delsub2URL = '{{ route('del.sub2') }}';
    var getimg = '{{ route('get.bookImgs', ['']) }}'
</script>