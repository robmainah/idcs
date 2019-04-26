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
				font-size: 13px;
			}
			th {
				padding: 10px;
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
		<h4>Employees Total Size of Files Report</h4>
		<table >
            <thead>
                <tr>
                	<th style="width: 5%"></th>
                    <th>Employee Name</th>
                    <th>Total file Size</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach($employees as $employee)
                    <tr>
                    	<td>{{ $no }}</td>
                        <td>{{ ucfirst($employee->name) }}</td>
                        <td>{{ number_format($employee->files_total / 1000000, 3) }} MB</td>
                    </tr>
                    <?php echo $no++; ?>
                @endforeach
            </tbody>
        </table>
	</body>
</html>