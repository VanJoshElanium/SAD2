<!DOCTYPE html>
<html>
<head>
	<style>

		body{
			font-family: 'raleway';
	    	src: url(/fonts/Raleway-Regular.ttf);
		}

		table {
		    border-collapse: collapse;
		    width: 100%;
		}

		td, th {
		    border: 1px solid #000000;
		    text-align: left;
		    padding: 8px;
		}

	</style>
</head>

<body>
	<p style="text-align: center;">PRINCE &amp; PRINCESS ENTERPRISE</p>
	<p style="text-align: center;"> 669, Diamond 1 M. Mirafuentes St., Tagum City, Davao del Norte </p>
	<hr>

	<p style> Stocked In At: {{$sidatas[0]->si_date}} </p>
	<table>
	  <tr>
	  	<th>#</th>
	    <th>Item Name</th>
	    <th>Item Supplier</th>
	    <th>Item Quantity</th>
	    <th>Item Price</th>
	  </tr>

	  @foreach($sidatas as $s)
	        <tr>
	            <td> 
	                {{ $x++ }}
	            </td>

	            <td> 
	                {{$s -> inventory_name}}
	            </td>

	            <td>
	                {{$s -> supplier_name}}
	            </td>
	          	<td>
	            	{{$s -> si_qty}}
	            </td>
	            <td>
	                PHP {{$s -> inventory_price}}
	               
	            </td>
	        </tr>
        @endforeach
	</table>

</body>
</html>