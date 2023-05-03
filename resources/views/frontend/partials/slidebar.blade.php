<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-productsr-->

            @foreach ($category as $key => $item)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{ $item->slug }}">

                                <span class="badge pull-right">
                                    @if ($item->getChild->count())
                                        <i class="fa fa-plus"></i>
                                    @endif
                                </span>
                                {{ $item->name }}
                            </a>
                        </h4>
                    </div>
                    <div id="{{ $item->slug }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach ($item->getChild as $item)
                                    <li><a href="#">{{ $item->name }} </a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!--/category-products-->
        <div class="shipping text-center">
            <!--shipping-->
            <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
        </div>
        <!--/shipping-->

    </div>
</div>
