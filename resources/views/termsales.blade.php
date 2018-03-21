<!DOCTYPE html>
<html>
    <head>
        <style>
            html, body{
                width: 100%;
            }

            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            table {
                width: 60%;
                margin: 0 auto;
            }

            th, td {
                padding: 5px;
            }
        </style>
    </head>

	<body>
        <h1> Term Details </h1>

        <br>

        <p> Collector: {{$term_items[0]-> cfname}} {{$term_items[0]-> cmname}}. {{$term_items[0]-> clname}} </p>
        <p> Peddling Start: {{$term_items[0] -> start_date}} </p>
        <p> Peddling End: {{$term_items[0] -> end_date}} </p>
        <p> Collecting End: {{$term_items[0] -> finish_date}} </p>
        <p> Location: {{$term_items[0] -> location}} </p>

        <table>
            <caption>Term Peddlers</caption>
            <tr>
                <th>ID</th>
                <th>Worker Name</th>
                <th>Worker Position</th>
                <th>Contact Number</th>
            </tr>
            @foreach($workers as $worker)
            <tr>
                <td> 
                    {{$worker -> worker_id }}
                </td>
                <td> 
                    {{$worker -> fname}} {{$worker -> mname}}. {{$worker -> lname}}
                </td>

                <td>
                    <?php if($worker -> worker_type == 0) echo 'Collector';
                      elseif ($worker -> worker_type == 1) echo 'Leader';
                      else echo 'Member'; ?>
                </td>
                <td>
                    {{$worker -> cnum }}
                </td>
            </tr>
            @endforeach
        </table>

		<div class="termitems">
            <h2> Term Items </h2>
            <p> Stock-Out DateTime: {{$term_items[0] -> ti_date}} </p>
            <p> Handler: {{$term_items[0]-> hfname}} {{$term_items[0]-> hmname}}. {{$term_items[0]-> hlname}} </p>

            <p>Total Item Types:{{$total_items}} </p>
            <p>Total Stocked-Out Items: {{$total_quantity}}</p>
            <p>Total Sold Items: {{$total_sales}}</p>
            <p>Total Returned Items: {{$total_returns}}</p>
            <p>Total Damaged Items: {{$total_damages}}</p>
			<table>
                <caption>Term Items</caption>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Supplier Name</th>
                    <th>Original Qty</th>
                    <th>Returned Qty</th>
                    <th>Damaged Qty</th>
                    <th>Sold Qty</th>
                    <th>Price</th>
                </tr>
                @foreach($term_items as $term_item)
                <tr>
                    <td> 
                        {{$term_item -> ti_id }}
                    </td>
                    <td> 
                        {{$term_item -> inventory_name }}
                    </td>

                    <td>
                        {{$term_item -> supplier_name }}
                    </td>
                    <td>
                        {{$term_item -> ti_original }}
                    </td>
                    <td>
                        {{$term_item -> ti_returned }}
                    </td>
                    <td>
                        {{$term_item -> ti_udamaged + $term_item -> ti_rdamaged}}
                    </td>
                    <td>
                        {{$term_item -> ti_original - ($term_item -> ti_rdamaged  + $term_item -> ti_udamaged + $term_item -> ti_returned)}}
                    </td>
                    <td>
                        PHP {{$term_item -> inventory_price + ($term_item -> inventory_price * 0.25)}}
                    </td>
                </tr>
                @endforeach
            </table>
		</div>

        <div class="termsales">
            <h2> Term Sales </h2>

            <?php
                echo '<p> Total Sales: PHP'; 
                    $total_sale = 0;
                    foreach($term_items as $term_item) 
                        $total_sale += ($term_item->ti_original -($term_item->ti_udamaged +$term_item->ti_rdamaged + $term_item->ti_returned)) * ($term_item -> inventory_price + ($term_item -> inventory_price * 0.25)); 
                echo "$total_sale </p>
                <p> Total Revenue: PHP " .($total_sale * 0.25) ."</p> 
                <p> Total Expense: PHP $total_expense </p>
                <p> Total Collectable: PHP " .($total_sale + $total_expense);
            ?> 
            
            
            

            <table>
                <caption>Term Expenses</caption>
                <tr>
                    <th>ID</th>
                    <th>Expense Name</th>
                    <th>Expense Amount</th>
                </tr>
                @foreach($expenses as $expense)
                <tr>
                    <td> 
                        {{$expense -> expense_id }}
                    </td>
                    <td> 
                        {{$expense -> expense_name }}
                    </td>

                    <td>
                        PHP {{$expense -> expense_amt }}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
	</body>
</html>