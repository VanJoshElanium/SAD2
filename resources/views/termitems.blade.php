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
        <p> Collector: {{$term_items[0]-> cfname}} {{$term_items[0]-> cmname}}. {{$term_items[0]-> clname}} </p>
        <p> Date Started: {{$term_items[0] -> start_date}} </p>
        <p> Location: {{$term_items[0] -> location}} </p>

        <p> Stock-Out DateTime: {{$term_items[0] -> ti_date}} </p>
        <p> Handler: {{$term_items[0]-> hfname}} {{$term_items[0]-> hmname}}. {{$term_items[0]-> hlname}} </p>

		<div class="termitems">
			<table>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Supplier Name</th>
                    <th>Original Qty</th>
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
                        PHP {{$term_item -> inventory_price + ($term_item -> inventory_price * 0.25)}}
                    </td>
                </tr>
                @endforeach
            </table>
		</div>
	</body>
</html>