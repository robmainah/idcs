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
				padding: 8px;
				border: 1px solid black;
				font-size: 12px;
			}
			th {
				padding: 8px;
				font-size: 12px;
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
		<h2 style="text-align: center;">JOCHAM HOSPITAL</h2>
		<h4 style="text-align: center;"> Employees Report</h4>
		<table class="table table-striped table-bordered table-hover tbl_employees" id="dataTables-example">
		    <thead>
		        <tr>
		            <th></th>
		            <th>Name</th>
		            <th>Phone No.</th>
		            <th>Email</th>
		            <th>position</th>
		            <th>Department</th>
		            <th>Status</th>
		        </tr>
		    </thead>
		    <tbody>
		    <?php $no = 1; ?>
		    @foreach($employee as $key => $value)
		        <tr id="employee{{$value->id}}">
		            <td>{{ $no++ }}</td>
		            <td>{{ ucfirst($value->name) }}</td>
		            <td>{{ $value->phoneNumber }}</td>
		            <td>{{ $value->email }}</td>
		            <td>{{ ucfirst($value->position['name']) }}</td>
		            <td>{{ ucfirst($value->mainDepartment->name) }}</td>
		            <td>
		                @if($value->status == 0)
		                    <span class="col-danger">Deactive</span>
		                @elseif($value->status == 1)
		                    <span class="col-success">Active</span>
		                @elseif($value->status == 2)
		                    <span class="col-warning">Pending</span>
		                @endif
		            </td>
		        </tr>
		    @endforeach
		    </tbody>
		</table>
	</body>
</html>