@php
$baseUrl = config('app.baseUrl');
@endphp
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        @foreach($sliders as $key => $slider)
                            <div class="item {{$key == 0 ? 'active' : ''}}">
                                <div class="row no-gutters">
{{--                                    <div class="col-md-6 text-container">--}}
{{--                                        <div class="text-overlay">--}}
{{--                                            <h1><span>Family</span> Corner</h1>--}}
{{--                                            <h2>{{$slider->name}}</h2>--}}
{{--                                            <p>{{$slider->description}}</p>--}}
{{--                                            <button type="button" class="btn btn-default get">Get it now</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-12 image-container"">
                                        <img src="{{$baseUrl . $slider->image_path}}" class="img-responsive" alt=""/>
                                    </div>
                                </div>
                            </div>
                    <style>
                        /* Container chứa ảnh và văn bản */
                        .item {
                            position: relative;
                            width: 100%;
                            height: 50vh; /* Full chiều cao màn hình */
                        }

                        .image-container {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            overflow: hidden;
                        }

                        .image-container img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover; /* Đảm bảo ảnh luôn phủ đầy container */
                        }

                        /* Text overlay nằm trong ảnh */
                        .text-container {
                            position: absolute;
                            top: 50%; /* Căn giữa theo chiều dọc */
                            left: 20px; /* Khoảng cách từ bên trái */
                            transform: translateY(-50%); /* Căn chỉnh chính xác vị trí theo chiều dọc */
                            z-index: 10; /* Đảm bảo văn bản nằm trên ảnh */
                            color: white; /* Màu chữ */
                            padding: 20px;
                            max-width: 50%; /* Để đảm bảo chữ không vượt quá chiều rộng ảnh */
                            background-color: rgba(0, 0, 0, 0.4); /* Nền mờ cho văn bản dễ đọc */
                            border-radius: 10px;
                        }

                        .text-overlay h1, .text-overlay h2, .text-overlay p {
                            margin: 0;
                            padding: 0;
                        }

                        .text-overlay h1 {
                            font-size: 3rem;
                            font-weight: bold;
                        }

                        .text-overlay h2 {
                            font-size: 2rem;
                            margin-top: 1rem;
                        }

                        .text-overlay p {
                            font-size: 1.2rem;
                            margin-top: 1rem;
                        }

                        .btn.get {
                            margin-top: 2rem;
                            padding: 10px 20px;
                            font-size: 1.2rem;
                        }



                    </style>

                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section><!--/slider-->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Khởi động carousel
        $('#slider-carousel').carousel({
            interval: 5000, // Thay đổi slide mỗi 5 giây
            pause: "hover"  // Dừng khi di chuột vào carousel
        });

        // Thêm sự kiện cho các nút điều khiển
        $('.left.control-carousel').click(function() {
            $('#slider-carousel').carousel('prev');
        });

        $('.right.control-carousel').click(function() {
            $('#slider-carousel').carousel('next');
        });
    });
</script>
