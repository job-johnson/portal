<?php 

function template($fetchOrders){
?>    
    <h1>Add Rates Paypal Payments </h1>

<table class="wp-list-table widefat fixed striped posts">
	<thead>
	<tr>
		<th scope="col" id="name"><a href="#"><span>Name</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="email" ><a href="#"><span>Email</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="item" ><a href="#"><span>Item</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="subttotal" ><a href="#"><span>Sub Total</span><span class="sorting-indicator"></span></a></th>
               <th scope="col" id="tax" ><a href="#"><span>Tax</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="grand-total" ><a href="#"><span>Grand Total</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="status"><a href="#"><span>Status</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="txn-id"><a href="#"><span>Transaction Id</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="date"><a href="#"><span>Date</span><span class="sorting-indicator"></span></a></th>
        </tr>
	</thead>

	<tbody id="the-list">
             <?php
             foreach($fetchOrders as $orders):
        ?>
				<tr id="order-id-<?php echo ($orders->id == '' ? $orders->id:0);?>" class="">

                                   
                                    <td class="name" data-colname="name"><strong><?php echo ($orders->first_name != '' ? ucfirst($orders->first_name):'').' '.($orders->last_name != '' ? $orders->last_name:'');?> <span class="post-state"><?php echo ($orders->payer_status != '' ? '-'.$orders->payer_status:'None');?> </span></strong></td>
                        <td class="email" data-colname="email"><?php echo ($orders->email != '' ? $orders->email:'') ?></td>
                        <td class="item" data-colname="item"><?php echo ($orders->product_name != '' ? $orders->product_name:'') ?></td>
                        <td class="subttotal" data-colname="sub-total"><?php echo ($orders->currency != '' ? ucfirst($orders->currency):'NA').' '.($orders->sub_total != '' ? $orders->sub_total:'NA') ?></td>
                        <td class="tax" data-colname="tax"><?php echo ($orders->currency != '' ? ucfirst($orders->currency):'NA').' '.($orders->tax_amount != '' ? $orders->tax_amount:'NA') ?></td>
                        <td class="grand-total" data-colname="g-total"><?php echo ($orders->currency != '' ? ucfirst($orders->currency):'NA').' '.($orders->grand_total != '' ? $orders->grand_total:'NA') ?></td>
                        <td class="status" data-colname="status"><?php echo ($orders->payment_status != '' ? ucfirst($orders->payment_status):'NA') ?></td>
                        <td class="txn-id" data-colname="txn_id"><?php echo ($orders->txn_id != '' ? ucfirst($orders->txn_id):'0') ?></td>
                        <td class="date" data-colname="date"><?php echo ($orders->time != '' ? ucfirst($orders->time):'NA') ?></td>
                        			
                        
                                </tr><?php endforeach;?>
		</tbody>

	<tfoot>
	<tr>
		<th scope="col" id="name"><a href="#"><span>Name</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="email" ><a href="#"><span>Email</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="item" ><a href="#"><span>Item</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="subttotal" ><a href="#"><span>Sub Total</span><span class="sorting-indicator"></span></a></th>
               <th scope="col" id="tax" ><a href="#"><span>Tax</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="grand-total" ><a href="#"><span>Grand Total</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="status"><a href="#"><span>Status</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="txn-id"><a href="#"><span>Transaction Id</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="date"><a href="#"><span>Date</span><span class="sorting-indicator"></span></a></th>
        </tr>
	</tfoot>

</table>
                    

  <?php  } ?>
