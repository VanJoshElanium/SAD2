<!DOCTYPE html>
<html>
	<body>
		<div class="termitems">
			<table>
                <thead>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Supplier Name</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    @foreach($term_items as $term_item)
                    <tr>
                        <td> 
                            {{$term_item -> ti_id}}
                        </td>
                        <td> 
                            {{$term_item -> inventory_name}}
                        </td>

                        <td>
                            {{$term_item -> supplier_name}}
                        </td>
                        <td>
                            &#8369;{{$term_item -> inventory_price + ($term_item -> inventory_price * 0.25)}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
	</body>
</html>