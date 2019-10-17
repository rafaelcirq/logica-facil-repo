<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="margin-top: -5%">
    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            @yield('titulo') <small>@yield('subtitulo')</small>
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    @yield('conteudo')
                </div>
                @yield('datatable')
            </div>

        </div>
    </div>
</div>