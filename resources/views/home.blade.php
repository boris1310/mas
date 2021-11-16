@extends('layouts.app')

@section('content')
<div class="container-lg">


                <div id="app" >

                    <add-cart :flag="flagRequired">
                        <div class="spinner-border text-primary mx-auto" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </add-cart>

                </div>


</div>
@endsection
