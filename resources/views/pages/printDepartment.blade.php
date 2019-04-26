<html>
	<head>
		<title>IDCS</title>
		<style type="text/css">
			table {
				width: 100%;
				font-family: Helvetica, Arial, Sans-serif;
				/*border: 1px solid black;*/
				border-collapse: collapse;
			}
			td {
				padding: 5px;
				border: 1px solid black;
				font-size: 13px;
			}
			th {
				padding: 5px;
				border: 1px solid black;
				background-color: #54bbc8cc;
			}
			.st {
				padding: 10px;
			}
			table tr:nth-of-type(2n+2)
			{
				background-color: #e6e6e6;
			}
		</style>
	</head>

	<body>
		<h2 style="margin-left: 20px;text-align: center;">JOCHAM HOSPITAL</h2>
		<table>
			<thead>
			    <tr>
			        <th style="width: 2%" class="st"></th>
			        <th>Department name</th>
			        <th style="width: 20%;">H.O.D</th>
			        <th style="width: 35%">Description</th>
			        <th style="width: 11%">No. of Employees</th>
			    </tr>
			</thead>
			<tbody>
			    <?php $no = 1; ?>
			    @foreach($departments as $value)
			        <tr id="{{ $value->id }}">
			            <td class="st">{{ $no++ }}</td>
			            <!-- <td>{//{ $value->depart_id }}</td> -->
			            <td>{{ ucfirst($value->name) }}</td>
			            <td>{{ ucfirst($value->hod->name) }}</td>
			            <td>{{ $value->description }}</td>
			            <td style="text-align: center;">{{ $value->employee_count }}</td>
			        </tr>
			    @endforeach
			</tbody>
		</table>
	</body>
</html>