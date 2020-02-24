@foreach($subCat as $sub)
    @if ($cat->id == $sub->cat_id)
        <li class="subcatdropdown">
            <a href="" class="subcatdropdown-toggle">{{ $sub->sub_category1 }}</a>
            <ul class="subcatdropdown-menu">
                @foreach($subCat2 as $sub2)
                    @if ($sub2->cat_id == $cat->id && $sub2->sub_catid == $sub->id)
                        <li><a href="">{{ $sub2->sub_category2 }}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endif
@endforeach