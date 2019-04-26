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
		<h4>Employees File's Report</h4>
		<table>
			<thead>
			    <tr>
			        <th></th>
			        <th>Name</th>
			        <th>Size</th>
			        <th>Last modified</th>
			        <th>Type</th>
			    </tr>
			</thead>
			<tbody>
			    <?php $no = 1; ?>
			    @foreach($files as $file)
			    <tr id="{{ $file->id }}">
			        <!--<td id="td_one" class="fil_sel">-->
			        <td id="fil_td" class="fil_sel">
			        	{{$no}}
			        </td>
			        <td><i class="fa fa-file"></i> {{ $file->name }}</td>
			        <td>{{ number_format($file->size / 1000,1)}} Kb</td>
			        <td>{{ date("F d, Y", intval($file->last_modified)) }}</td>
			        <td>{{ $file->type }} </td>
			    </tr>
			    	<?php $no++ ?>
			    @endforeach
			</tbody>
		</table>
	</body>
</html>