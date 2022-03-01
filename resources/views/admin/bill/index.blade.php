@extends('layouts.app')
@section('title', 'Bills')
@section('content')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <style>
        .add-div-error{
            color:red;
        }
        .edit-div-error{
            color:red;
        }
        .suggesstion-box{

            position: absolute;
            background: #ddd;
            width: 15%;
            z-index: 999;
        }

    </style>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                   {{-- <div class="card-header ">
                        <div class="row">
                            <h4 class="card-title col-md-6 mr-0">--}}{{--Bills--}}{{--</h4>
                            <div class="col-md-6">
                                <a type="button" class="btn btn-secondary btn-round add-product-row float-right" id="add-product-row" href="javascript:void(0)">Add More</a>
                            </div>
                        </div>
                    </div>--}}
                    <form id="bill-form" method="post" action="{{url('bill/create')}}" autocomplete="off">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="card">
                                {{--<div class="card-header">
                                    <h6 class="card-title">Products Record List</h6>
                                </div>--}}
                                <div class="card-body">
                                    <div class="row">
                                    <div class="form-group mobile col-sm-3">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control mobile-number" placeholder="" name="mobile" id="mobile"/>
                                        <div class="add-div-error mobile"></div>
                                    </div>

                                    <div class="form-group name col-sm-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="" name="name" id="name"/>
                                        <div class="add-div-error name"></div>
                                    </div>

                                    <div class="form-group address col-sm-6 select-wizard">
                                        <label>Address</label>
                                        <input class="form-control" name="address" id="address" type="text"/>
                                        <div class="add-div-error address"></div>
                                    </div>
                                    </div>
                                    <table id="datatable" class="table table-hover custom_border" cellspacing="0" width="100%">
                                        <thead class="table-secondary">
                                        <tr>
                                            <th style="font-size:11px; width:5%" class="text-center">S.No</th>
                                            <th style="font-size:11px; width:15%" class="">Product Name</th>
                                            <th style="font-size:11px; width:10%" class="">Quantity</th>
                                            <th style="font-size:11px; width:15%" class="">Packet Per Box</th>
                                            <th style="font-size:11px; width:15%" class="">Item Per Packet</th>
                                            <th style="font-size:11px; width:15%" class="">Unit Price</th>
                                            <th style="font-size:11px; width:15%" class="">Price</th>
                                            <th style="font-size:11px" class="disabled-sorting text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        {{--@php $i=1; @endphp
                                       --}}{{-- @foreach($products as $product)--}}{{--
                                            <tr class="table-row" id="bill-row_1">
                                                <td class="w-1"><input type="number" class="form-control" placeholder="" min="1" max="1000000" value="{{$i++}}"/></td>
                                                <td class=""><input type="text" class="form-control" placeholder="" name="product_name[]" value=""/></td>
                                                <td class=""><input class="form-control" name="item_quantity" id="item_quantity" type="number" min="1" max="1000000"/></td>
                                                <td class=""><input class="form-control" name="packet_per_box" id="packet_per_box" type="number" min="1" max="1000000"/></td>
                                                <td class=""><input class="form-control" name="item_price_supplier" id="item_price_supplier" type="number" min="1" max="1000000"/></td>
                                                <td class=""><input class="form-control" name="item_unit_price" id="item_unit_price" type="number" min="1" max="1000000"/></td>
                                                <td class=""><input class="form-control" name="item_price" id="item_price" type="number" min="1" max="1000000"/></td>
                                                </td>

                                                <td class="w2 text-center links">
                                                    <a class="dropdown-item add-product-row" data-id="--}}{{--{{$product->id}}--}}{{--" href="javascript:void(0)"><i class="fa fa-plus btn-info"></i></a>


                                                </td>
                                            </tr>--}}
                                            {{--@endforeach--}}

                                        </tbody>


                                    </table>
                                    <table id="" class="table table-hovers" cellspacing="0" width="100%">

                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                        <th style="font-size:11px; width:5%" class="text-center"></th>
                                        <th style="font-size:11px; width:15%" class=""></th>
                                        <th style="font-size:11px; width:10%" class=""></th>
                                        <th style="font-size:11px; width:15%" class=""></th>
                                        <th style="font-size:11px; width:15%" class=""></th>
                                        <th style="font-size:11px; width:15%" class=""></th>

                                        <th style="font-size:11px; width:15%" class="">Total Price
                                            <input type='number' readonly name="total_price"
                                                   class="form-control w-100 total_price"
                                                   value='0'/>
                                        </th>
                                        <th style="font-size:11px; width:15%" class=""></th>

                                        </tfoot>


                                    </table>



                                </div><!-- end content-->
                                 <div class="card-footer">
                                     <div class="pull-right">

                                         <input type='submit'
                                                class='btn btn-finish  btn-secondary btn-fill btn-rose btn-wd btn-round  edit-admission-btn-save-exit-submit'
                                                name='finish' value='Submit'/>
                                     </div>
                                 </div>
                            </div><!--  end card  -->
                        </div> <!-- end col-md-12 -->
                    </div> <!-- end row -->
                    </form>
                </div>

            </div>

        </div>

    </div>

    {{--<div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-sm">
            <form id="product-form" action="{{url('product/create')}}" enctype="multipart/form-data" method="Post">
                @csrf
                <input type="hidden" name="id" id="edit-product-id">
                --}}{{--<input type="hidden" name="user_id" id="edit-user_id">--}}{{--
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
--}}

@endsection

@section('front_script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="{{asset('js/core/jspdf.min.js')}}"></script>
    <script src="{{asset('js/core/jspdf-autotable.js')}}"></script>
    <script src="{{asset('js/demo.js')}}"></script>

    <script src="{{asset('js/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('js/custom/bill.js')}}"></script>
@endsection