@extends('layout_user')
@section('user_content')

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Contact Us</h5>
            <h1 class="mb-5">Liên hệ với chúng tôi</h1>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="row gy-4">
                    <div class="col-md-4">
                        <h5 class="section-title ff-secondary fw-normal text-start text-primary">Email</h5>
                        <p><i class="fa fa-envelope-open text-primary me-2"></i>thanhhieu090701@gmail.com</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="section-title ff-secondary fw-normal text-start text-primary">Phone</h5>
                        <p><i class="fa fa-phone text-primary me-2"></i>0914549857</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="section-title ff-secondary fw-normal text-start text-primary">Technical</h5>
                        <p><i class="fa fa-home text-primary me-2"></i>Đường 3/2, quận Ninh Kiều, thành phố Cần Thơ </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.1s" style="height: 500px">
                {{-- <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe> --}}


                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.8414543770923!2d105.76804037481064!3d10.029938972519307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBD4bqnbiBUaMah!5e0!3m2!1svi!2s!4v1702317930231!5m2!1svi!2s" width="100%" height="450" style="min-height: 350px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
    
        </div>
    </div>
</div>
@endsection
