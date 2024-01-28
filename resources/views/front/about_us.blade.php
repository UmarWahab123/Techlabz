@extends('front.layouts.header')


@section('css')
   <style>
    p {
        margin-bottom: 0;
    }
   </style>
@endsection
@section('content')

<div class="main-content-area mb-3">
    <!-- Section: inner-header -->
    <section class="page-title divider layer-overlay overlay-dark-8 section-typo-light bg-img-center">
        <div class="container pt-90 pb-90">
            <!-- Section Content -->
            <div class="section-content common-header-section">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="title common-head-style  mb-5 mt-5">About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog -->
    <section>
        <div class="container pb-60 mb-4">
            <div class="section-content mt-5 ">
                <div class="row">
                    <div class="col-sm-12">
                        <article class="post-single">
                            <div class="entry-content">
                                <?php echo @$setting->about_us; ?>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script-bottom')

     
@endsection