<div class="modal-content" style="width:700px;">
    <div class="modal-header">    
      	<button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body" style="max-height:600px; overflow:auto; overflow-x:hidden">
        <form method="POST" action="{{ route('delivery.update') }}" enctype="multipart/form-data">
        @csrf 
        <div class="row">
        @foreach($response->data as $res)   
        	<input type="hidden"  class="form-control" name="deliveryid[]" value="{{ $res->id }}"/>
            <div class="col-sm-6" style="margin:0; padding:0 3px;">
            	<div class="col-sm-12">Consignment ID: {{ $res->order->consignment_id }}</div>
            	<div class="row" style="padding:5px; border:1px solid #ccc; margin:20px 5px; border-radius:10px;">                    	
                        	<div class="col-sm-12">
                            	<div class="row" style="margin-bottom:5px;">
                                    <div class="col-sm-5" style="margin:0; padding:0"><label>Status</label></div>
                                    <div class="col-sm-7">
                                        <select name="order_status[{{ $res->id }}]" class="form-control">
                                            <option value="{{ $actions }}">{{ $actions }}</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Accepted">Accepted</option>
                                            <option value="In Transit">In Transit</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Returned">Returned</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                        		</div>
                        	</div>
                            <div class="col-sm-12">
                              <div class="row" style="margin-bottom:5px;">
                                 <div class="col-sm-5" style="margin:0; padding:0"><label>Received Amount</label></div>
                                 <div class="col-sm-7"><input type="number"  class="form-control" name="received_amount[{{ $res->id }}]" placeholder="Received Amount" /></div>
                              </div>
                            </div>
                         <div class="col-sm-12">
                    	 <div class="row" style="margin-bottom:5px;">
                             <div class="col-sm-5" style="margin:0; padding:0"><label>Delivery Charge</label></div>
                             <div class="col-sm-7"><input type="number"  class="form-control" name="delivery_charge[{{ $res->id }}]" id="delivery_charge" /></div>
                          </div>
                    </div>
                    <div class="col-sm-12">
                   		<div class="row" style="margin-bottom:5px;">
                    	 <div class="col-sm-5" style="margin:0; padding:0"><label>COD Charge</label></div>
                         <div class="col-sm-7"><input type="number"  class="form-control" name="cod_charge[{{ $res->id }}]" id="cod_charge" /></div>
                    </div>
                    </div>
                    <div class="col-sm-12">
                    	<div class="row" style="margin-bottom:5px;">
                    	 <div class="col-sm-5" style="margin:0; padding:0"><label>Delivery Date</label></div>
                         <div class="col-sm-7"><input type="date"  class="form-control" name="delivery_date[{{ $res->id }}]" id="delivery_date" /></div>
                    </div>
                    </div>
                </div>
            </div> 
        @endforeach
        </div>
	 <div class="col-sm-12"><input type="submit" name="submitbtn" value="Submit" class="btn btn-success" /></div>
</form>
    </div>            
</div>
        


