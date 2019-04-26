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
				font-size: 13px;
				padding: 10px 5px;
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
		<h4>All Projects' Report</h4>
		<table>
			<thead>
			    <tr>
			        <th style="width: 5%"></th>
			        <th style="width: 25%;">Project Subject</th>
			        <th style="width: 40%;">Project Description</th>
			        <th style="width: 12%">Created by</th>
			        <th style="width: 12%">Start date</th>
			        <th style="width: 12%">Due date</th>
			    </tr>
			</thead>
			<tbody>
			    <?php $no = 1; $i=0; $po = []; ?>
			    @foreach($allProjects as $value)
			        @if(!in_array($value->project_code, $po))
			            <?php $po[$no] = $value->project_code ?>
			            <tr class="gradeA" id="{{ $value->id }}">
			                <td id="no">{{ $no++ }}</td>
			                <td>{{ ucfirst($value->name) }}</td>
			                <td>{{ ucfirst($value->description) }}</td>
			                <td>{{ ucfirst($value->user['name']) }}</td>
			                <td>{{ date("F d, Y", strtotime($value->start_date)) }}</td>
			                <td>{{ date("F d, Y", strtotime($value->end_date)) }}</td>
			            </tr>
			        @endif
			    @endforeach
			</tbody>
		</table>
	</body>
</html>