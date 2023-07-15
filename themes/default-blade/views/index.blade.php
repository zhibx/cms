@extends('cms::layouts.frontend')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <aside class="wrapper__list__article ">
                        <h4 class="border_section">{{ $title }}</h4>

                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-md-6">
                                    {{ get_template_part($post, 'content') }}
                                </div>
                            @endforeach
                        </div>
                    </aside>
                </div>

                <div class="col-md-4">
                    <div class="sidebar-sticky">
                        {{ dynamic_sidebar('sidebar') }}
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
            <!-- Pagination -->
            <div class="pagination-area">
                <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                    {{--{{ paginate_links($post, 'theme::components.pagination') }}--}}
                </div>
            </div>
        </div>
    </section>
@endsection
