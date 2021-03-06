@extends('layouts.admin')

@section('titulo-seccion')
    <span>
        Productos
    </span>
    <a href="" class="btn btn-primary btn-circle btn-modal-create" data-toggle="modal" data-target="#createMdl">
        <i class="fas fa-plus"></i>
    </a>
@endsection

@section('contenido')

    @include('products.modals.create')
    @include('products.modals.edit')
    @include('products.modals.delete')

    <div class="card well">
        <div class="card-body">
            <table id="dt-products" class="table table-striped table-bordered dts" style="width:100%">
                <thead>
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Precio Unitario</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Costo total</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="text-center">
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>${{$product->unit_price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td><span class="badge badge-success">${{$product->total_cost}}</span></td>
                        <td>
                            <a href="" class="edit-el-form" data-toggle="modal" data-target="#editMdl"
                               onclick="editProduct({{$product}})"
                            >
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="" class="delete-el-form" data-toggle="modal" data-target="#deleteMdl"
                               onclick="deleteProduct({{$product}})">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('/libs/datatables/dataTables.min.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('/libs/datatables/dataTables.min.js')}}"></script>
    <script src="{{asset('/libs/datatables/dataTables.bs4.min.js')}}"></script>

    <script>

        $(document).ready(function () {
            $("input[name='unit_price'], input[name='quantity']").on('keyup', function () {
                calcularPrecio();
            });
        });

        function calcularPrecio() {
            let unitPrice = $("input[name='unit_price']");
            let quantity = $("input[name='quantity']");

            if (unitPrice.val() && quantity.val()) {
                $("input[name='total_cost']").val(unitPrice.val() * quantity.val())
            }
        }


        function editProduct(product) {
            $("#editProductFrm").attr('action', `/products/${product.id}`);

            $('#editProductFrm #name').val(product.name);
            $('#editProductFrm #description').val(product.description);
            $('#editProductFrm #unit_price').val(product.unit_price);
            $('#editProductFrm #quantity').val(product.quantity);
            $('#editProductFrm #total_cost').val(product.total_cost);
        }

        function deleteProduct(product) {
            $("#deleteProductFrm").attr('action', `/products/${product.id}`);
            $('#deleteProductFrm #productName').text(product.name);
        }

    </script>

    @if(!$errors->isEmpty())
        @if($errors->has('post'))
            <script>
                $(function () {
                    $('#createMdl').removeClass('zoomIn');
                    $('#createMdl').addClass('shake');
                    $('#createMdl').modal('show');
                });
            </script>
        @else
            <script>
                $(function () {
                    $('#createProductFrm').trigger('reset');
                    $('#editMdl').removeClass('zoomIn');
                    $('#editMdl').addClass('shake');
                    $('#editMdl').modal('show');
                });
            </script>
        @endif
    @endif
@endpush
