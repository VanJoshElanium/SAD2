
<!DOCTYPE html>
<html>
<head>
    <style>
        table, p {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            width: 100%;
        }    
    #items {
        border-collapse: collapse;
        
    }

    #items td, #items th {
        border: 1px solid #ddd;
        }
    #items td, #items th:nth-child(n+2) {
        padding: 3px 70px 3px 3px;
    }

    #items tr:nth-child(even){background-color: #f2f2f2;}   
    #items tr:nth-last-child(1){border: none;}   

    #items tr:hover {background-color: #ddd;}

    #items th {
        padding-top: 12px;
        padding-bottom: 12px;
        padding-left: 20%px; 
        text-align: left;
        color: black;
        font-s
    }
    </style>
</head>
	<body>
        <table>
            <tbody>
                <tr>
                    <td><p> Collector: {{$term_items[0]-> cfname}} {{$term_items[0]-> cmname}}. {{$term_items[0]-> clname}} </p></td>
                    <td style="padding-left:200px;"><p> Date Started: {{$term_items[0] -> start_date}} </p></td>
                </tr>
                <tr>
                    <td><p> Location: {{$term_items[0] -> location}} </p></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <p style="font-size: 10px;"><i>Note: This is the list of items approved by the owner that are going to be sold on the location stated above.</i></p>
        <hr>
        <center><h3>Peddling Item List</h3></center>
		<div id="items">
			<table>
                <tr>
                    <th>No</th>
                    <th style="margin-right:50%;">Item</th>
                    <th>Supplier</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Checker</th>
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
                        {{$term_item -> inventory_price + ($term_item -> inventory_price * 0.25)}}
                       
                    </td>
                    <td> {{$term_item -> ti_original }}
                        
                    </td>
                    <td>
                    <center>____</center>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td align="right">Total:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </table>
            
            <br>

		</div>
            <table>
                <tbody>
                <tr>
                    <td><p>Handler:_____________________________</p></td>
                    <td align="right"><p>Date handled:________________</p></td>
                </tr>
                </tbody>
            </table>
	</body>
</html>
