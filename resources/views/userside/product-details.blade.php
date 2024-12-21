@extends('userside.userside_source.userside_template') 

@section('content')
<br><br>
<div class="container">
    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
        <div class="row">
            <!-- قسم الصور -->
    <div class="col-md-6 col-lg-7 p-b-30">
    <div class="p-l-25 p-r-30 p-lr-0-lg">
        <div class="wrap-slick3 flex-sb flex-w">
            <div class="wrap-slick3-dots"></div>
            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
            <div class="slick3 gallery-lb">
                @foreach($product->images as $image)
                <div class="item-slick3" data-thumb="{{ asset('storage/' . $image->path) }}">
                    <div class="wrap-pic-w pos-relative">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}">
                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('storage/' . $image->path) }}">
                            <i class="fa fa-expand"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



            <!-- قسم التفاصيل -->
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ $product->name }}
                    </h4>
                    <span class="mtext-106 cl2">
                       ${{ number_format($product->price, 2) }}
                    </span>
                    <p class="stext-102 cl3 p-t-23">
                        {{ $product->description }}
                    </p>
                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contactModal">
                    Connect
                </button>
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <br><br><br><br><br>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contact Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p><strong>Phone:</strong> {{  $product->user->phone_number }}</p>
                <p><strong>Email:</strong> {{ $product->user->email }}</p>
                <p><strong>Name:</strong> {{ $product->user->First_name }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
