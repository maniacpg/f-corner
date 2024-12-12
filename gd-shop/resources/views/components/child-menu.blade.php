@if($categoryParent->categoryChild->count())
    <ul role="menu" class="sub-menu">
        @foreach($categoryParent->categoryChild as $categoryChild)
            <li><a href="shop.html">{{$categoryChild->name}}</a></li>
            @if($categoryParent->categoryChild->count())
                @include('components.child-menu', ['categoryParent'=>$categoryChild])
            @endif
        @endforeach
    </ul>
@endif
