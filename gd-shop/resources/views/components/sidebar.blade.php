<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        @foreach($categories as $category)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if($category->categoryChild->count())
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$category->id}}">
                            <span class="badge pull-right">

                                <i class="fa fa-plus"></i>

                            </span>
                            {{$category->name}}
                        </a>
                        @else
{{--                            <a href="{{route('category.product', ['slug'=>$categoryChild->slug, 'id'=>$categoryChild->id])}}">--}}
{{--                            <span class="badge pull-right">--}}
{{--                            </span>--}}
{{--                                {{$category->name}}--}}
{{--                            </a>--}}
                        @endif
                    </h4>
                </div>

                <div id="{{$category->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($category->categoryChild as $categoryChild)
                            <li>
                                <a href="{{route('category.product', ['slug'=>$categoryChild->slug, 'id'=>$categoryChild->id])}}">
                                    {{$categoryChild-> name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--/category-products-->


</div>
