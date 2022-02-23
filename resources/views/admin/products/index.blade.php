@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <style>
        .add-div-error{
            color:red;
        }
        .edit-div-error{
            color:red;
        }
        .sweet-alert div.form-group {
            display: none !important;
        }
    </style>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">


                        <div class="row">
                            <h4 class="card-title col-md-6 mr-0">Products</h4>
                            <div class="col-md-6">
                                <a type="button" class="btn btn-secondary btn-round  float-right" id="add-product-btn" href="javascript:void(0)">Add Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">


                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title">Products Record List</h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatable" data-id="datatable" class="table table-hover custom_border" cellspacing="0" width="100%">
                                        <thead class="table-secondary">
                                        <tr>
                                            <th style="font-size:11px" class="w1 text-center">S.No</th>
                                            <th style="font-size:11px" class="">Name</th>
                                            <th style="font-size:11px" class="">Packet Per Box</th>
                                            <th style="font-size:11px" class="">Item Per Packet</th>
                                            <th style="font-size:11px" class="">Item Price Supplier</th>
                                            <th style="font-size:11px" class="">Item Price Retailer</th>
                                            <th style="font-size:11px" class="">Status</th>
                                            <th style="font-size:11px" class="disabled-sorting text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @php $i=1; @endphp
                                        @foreach($products as $product)
                                            <tr>
                                                <td class="w1 text-center">{{$i++}}</td>
                                                <td class="">{{$product->prod_name}}</td>
                                                <td class="">{{$product->packet_per_box}}</td>
                                                <td class="">{{$product->item_per_packet}}</td>
                                                <td class="">{{$product->item_price_supplier}}</td>
                                                <td class="">{{$product->item_price_retail}}</td>
                                                <td class="">{{$product->prod_status}}</td>

                                                <td class="w2 text-center">
                                                    <div class="col">
                                                        <div class="dropdown  text-center">
                                                            <button style="" class="dropdown-toggle btn-round  btn-sm btn text-info btn-link btn-cus-weight" type="button" id="dropdownMenuButton"
                                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Manage
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                                                                <div class="dropdown-header">Manage user</div>

                                                                <a class="dropdown-item show-product" data-id="{{$product->id}}" href="javascript:void(0)">Show</a>
                                                                <a class="dropdown-item edit-product" data-id="{{$product->id}}" href="javascript:void(0)">Edit</a>
                                                                <a class="dropdown-item delete-product" data-id="{{$product->id}}" href="javascript:void(0)">Delete</a>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div><!-- end content-->
                            </div><!--  end card  -->
                        </div> <!-- end col-md-12 -->
                    </div> <!-- end row -->

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-sm">
            <form id="product-form" action="{{url('product/create')}}" enctype="multipart/form-data" method="Post">
                @csrf
                <input type="hidden" name="id" id="edit-product-id">
                {{--<input type="hidden" name="user_id" id="edit-user_id">--}}
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-remove"></i>
                        </button>
                        <h5 class="title title-up" id="modal-title">Add Product
                        </h5>
                    </div>
                    <div class="modal-body row">
                        <div class="col-sm-12" id="form_add">
                            <div class="row">

                                <div class="form-group product_name col-sm-4">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" placeholder="" name="product_name" id="product_name"/>

                                </div>

                                <div class="form-group packet_per_box col-sm-4 select-wizard">
                                    <label>Packet Per box</label>
                                    <input class="form-control" name="packet_per_box" id="packet_per_box" type="number" min="1" max="1000000"/>

                                </div>
                                <div class="form-group item_per_packet col-sm-4 select-wizard">
                                    <label>Item Per Packet</label>
                                    <input class="form-control" name="item_per_packet" id="item_per_packet" type="number" min="1" max="1000000"/>

                                </div>
                                <div class="form-group item_price_supplier col-sm-4 select-wizard">
                                    <label>Item Price Supplier</label>
                                    <input class="form-control" name="item_price_supplier" id="item_price_supplier" type="number" min="1" max="1000000"/>

                                </div>
                                <div class="form-group item_price_retailer col-sm-4 select-wizard">
                                    <label>Item Price Retailer</label>
                                    <input class="form-control" name="item_price_retailer" id="item_price_retailer" type="number" min="1" max="1000000"/>

                                </div>

                                <div class="form-check form-group  product_status col-sm-4 checkbox-general mt-3 mt-4">
                                    <label class="form-check-label">
                                        <input class="form-check-input"  type="checkbox" name="product_status" value="Inactive" id="product_status">
                                        <span class="form-check-sign"></span>
                                        Check if Product is inactive
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="">
                            <button type="submit" class="btn btn-round btn-success btn-link add-btn">Save</button>
                        </div>
                        <div class="divider"></div>
                        <div class="">
                            <button type="button" class="btn btn-round btn-danger btn-link" data-dismiss="modal">Cancel</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="show-product-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-sm">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-remove"></i>
                    </button>
                    <h5 class="title title-up" id="modal-title">View Product </h5>
                </div>
                <div class="modal-body row">
                    <div class="col-sm-12">
                        <div class="row">

                            <div class="form-group name col-sm-4">
                                <label>Product Name</label>
                                <P id="show-product-name"></P>

                            </div>

                            <div class="form-group mobile col-sm-4">
                                <label>Packet Per box</label>
                                <P id="show-packet-per-box"></P>

                            </div>
                            <div class="form-group mobile col-sm-4">
                                <label>Item Per Packet</label>
                                <P id="show-item-per-packet"></P>

                            </div>
                            <div class="form-group current_date col-sm-4 select-wizard">
                                <label>Item Price Supplier</label>
                                <P id="show-item-price-supplier"></P>

                            </div>
                            <div class="form-group address col-sm-8 select-wizard">
                                <label>Item Price Retailer</label>
                                <P id="show-item-price-retailer"></P>
                            </div>

                            <div class="form-group total_amount col-sm-4">
                                <label>Product Status</label>
                                <P id="show-product-status"></P>
                            </div>
                            <div class="form-group total_amount col-sm-4">
                                <label>Date</label>
                                <P id="show-product-date"></P>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="">
                        <button type="button" class="btn btn-round btn-danger btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('front_script')

    <script src="{{asset('js/core/jspdf.min.js')}}"></script>
    <script src="{{asset('js/core/jspdf-autotable.js')}}"></script>
    <script src="{{asset('js/demo.js')}}"></script>

    <script src="{{asset('js/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('js/custom/product.js')}}"></script>
@endsection