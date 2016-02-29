@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center">

            <!-- Plans -->
            <section id="plans">
                <div class="container">
                    <div class="row">
                        <!-- item -->
                        <div class="col-md-6 col-sm-6 text-center">
                            <div class="panel panel-success panel-pricing">
                                <div class="panel-heading">
                                    <h1>Full</h1>
                                </div>
                                <div class="panel-body text-center">
                                    <p><strong>7.50 $</strong></p>
                                </div>
                            </div>
                        </div>
                        <!-- /item -->

                        <!-- item -->
                        <div class="col-md-6 col-sm-6 text-center">
                            <div class="panel panel-danger panel-pricing">
                                <div class="panel-heading">
                                    <h1>Reduced *</h1>
                                </div>
                                <div class="panel-body text-center">
                                    <p><strong>4.50 $</strong></p>
                                </div>
                            </div>
                        </div>
                        <!-- /item -->

                        <!-- item -->
                        <div class="col-md-6 col-sm-6 text-center">
                            <div class="panel panel-warning panel-pricing">
                                <div class="panel-heading">
                                    <h1>3D</h1>
                                </div>
                                <div class="panel-body text-center">
                                    <p><strong>10.00 $</strong></p>
                                </div>
                            </div>
                        </div>
                        <!-- /item -->

                        <!-- item -->
                        <div class="col-md-6 col-sm-6 text-center">
                            <div class="panel panel-info panel-pricing">
                                <div class="panel-heading">
                                    <h1>3D reduced *</h1>
                                </div>
                                <div class="panel-body text-center">
                                    <p><strong>7.00 $</strong></p>
                                </div>
                            </div>
                        </div>
                        <!-- /item -->
                    </div>
                    <div class="col-md-12 alert alert-link" style="font-style: italic;">* Soldiers, Over 65, Children 3-10 years old, Disabled people</div>
                </div>
            </section>
            <!-- /Plans -->
        </div>
    </div>
@endsection