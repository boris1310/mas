@extends('layouts.app')

@section('content')
<div class="container-lg">


                <div id="app">

                    <div id="successBlock"
                         style="display: none; height: 10em; position: fixed; top: auto; z-index: 999; border:1px solid black;"
                         class="mx-auto w-75 alert alert-success">
                        <h1 class="text-center">Заказ добавлен</h1>
                    </div>
                    <div id="errorBlock"
                         style="display: none; height: 10em; position: fixed; top: auto; z-index: 999; border: 1px solid black; "
                         class="mx-auto w-75 alert alert-danger">
                        <h1 class="text-center">Ошибка добавления!</h1>
                    </div>

                    <add-cart :flag="flagRequired">
                        <div class="spinner-border text-primary mx-auto" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </add-cart>



                </div>


</div>
@endsection

