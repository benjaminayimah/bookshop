<script>
    let token = '{{ Session::token() }}';
    let ctIdel = '{{ route('cart.del') }}';
    let getitimg = '{{ route('get.item.imgs') }}';
    let getimg = '{{ route('get.bookImgs', ['']) }}';
    let postSess = '{{ route('post.session') }}';
    let postQnty = '{{ route('post.cartQtty') }}';
    let postwish = '{{ route('post.wishlist') }}';
    let postSearch = '{{ route('get.searchparam') }}';
    let getId = '{{ route('get.item.detail', ['']) }}';
    let getCat = '{{ route('get.bookfromCategory', ['', '']) }}';
    let postnewsLss = '{{ route('post.newsLtoken') }}'

</script>